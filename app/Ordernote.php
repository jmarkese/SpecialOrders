<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordernote extends Model
{
    protected $with = ['user'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
