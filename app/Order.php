<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'special_needs_orders';

    protected $primaryKey = 'order_id';

    protected $with = ['category', 'location', 'status', 'vendor', 'user'];

    public function category()
    {
        return $this->belongsTo(Ordercategory::class, 'fk_category_id', 'category_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'fk_location', 'location_id');
    }

    public function status()
    {
        return $this->belongsTo(Orderstatus::class, 'fk_status_id', 'status_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'fk_vendor_id', 'vendor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id_creator', 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Ordernote::class, 'fk_order_id', 'notes_id');
    }


}
