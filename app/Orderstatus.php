<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    protected $table = 'special_needs_status';

    protected $primaryKey = 'status_id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'fk_category_id', 'status_id');
    }

}
