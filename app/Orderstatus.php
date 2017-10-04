<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    protected $visible = [
        'id',
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
