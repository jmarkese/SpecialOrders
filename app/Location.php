<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
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
