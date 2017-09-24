<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'product_vendors';

    protected $primaryKey = 'vendor_id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'fk_vendor_id', 'vendor_id');
    }
}
