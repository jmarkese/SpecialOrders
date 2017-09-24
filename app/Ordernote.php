<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordernote extends Model
{
    protected $table = 'special_needs_notes';

    protected $primaryKey = 'notes_id';

    protected $with = ['order', 'user'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'fk_order_id', 'owner_id', 'notes_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'owner_id', 'notes_id');
    }

}
