<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PackageTicket extends Model
{
    public function getList($keyWord, $softPrice = "")
    {
        $filters = ['name', 'price', 'description'];
        $query = $this->newQuery();

        $query->when($keyWord, function ($query) use ($keyWord, $filters) {
            $query->where(function ($query) use ($keyWord, $filters) {
                foreach ($filters as $filter) {
                    $query->orWhere($filter, 'like', '%'.$keyWord.'%');
                }
            });
        });

        $query->when($softPrice, function ($query) use ($softPrice) {
            $query->orderBy('price', $softPrice);
        });
        return $query->paginate(15);
    }
}
