<?php

namespace App\models;

use App\models\Dtos\CustomerDTO;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Customer extends Model
{

    public function packageTicket()
    {
        return $this->belongsTo(PackageTicket::class);
    }

    public function scopeSearch(Builder $builder, ?string $keyword)
    {
        $filters = ['name', 'number_phone', 'address', 'date_buy'];
        $builder->when($keyword, function ($query) use ($keyword, $filters) {
            $query->where(function ($query) use ($keyword, $filters) {
                foreach ($filters as $filter) {
                    $query->orWhere($filter, 'like', '%'.$keyword.'%');
                }
            });
        });
    }

    public function scopeGetByStatus(Builder $builder, ?int $status)
    {
        $builder->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        });
    }

    public function scopeGetByDateLeft(Builder $builder, $dateLeft)
    {
        $builder->when($dateLeft, function ($query) use ($dateLeft) {
            $query->whereRaw('datediff(date_end ,'."'".date('Y-m-d')."'".') = ?', [$dateLeft]);
        });
    }

    public function getList($keyword, $status = null, $dateLeft = null)
    {
        $query = $this->newQuery()->getByStatus($status)->search($keyword)->getByDateLeft($dateLeft)->with('packageTicket');

       return $query->paginate(15);
    }

    public function saveCustomer(Request $request, CustomerDTO $customerDTO, Customer $customer)
    {
        $data = $customerDTO->getFormRequest($request);
        $attribute = [
            'name' => $data['name'],
            'number_phone' => $data['number_phone'],
            'address' => $data['address'],
            'package_ticket_id' => $data['package_ticket_id'],
            'status' => $data['status'],
            'date_buy' => $data['date_buy'],
            'date_end' => $data['date_end']
        ];
        $customer->forceFill($attribute);
        try {
            $this->saveImage($customer, $data);

        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }
        $customer->save();
        $customer->refresh();
        return $customer;
    }

    public function saveImage(Customer &$customer, $data)
    {
        $disk = Storage::disk('customer');
        if ($customer->avatar && !$data['old_data']) {
            $disk->delete($customer->avatar);
            $customer->setAttribute('avatar', '');
        }
        if($data['avatar']) {
            $fileName = md5(microtime(true).uniqid()).'.jpg';
            $disk->put($fileName, Image::make($data['avatar'])->encode('jpg', 75));
            $customer->setAttribute('avatar', $fileName);
        }
    }
}
