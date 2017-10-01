<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordernote extends Model
{
    protected $visible = [
        'created_at',
        'user_id',
        'order_id',
        'content',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
