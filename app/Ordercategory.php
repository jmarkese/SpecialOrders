<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordercategory extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}