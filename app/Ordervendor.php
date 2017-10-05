<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordervendor extends Model
{
    protected $visible = [
        'id',
        'name',
        'short_name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
