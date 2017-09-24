<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $primaryKey = 'location_id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'fk_location', 'location_id');
    }
}
