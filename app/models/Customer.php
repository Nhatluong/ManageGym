<?php

namespace App\models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
}
