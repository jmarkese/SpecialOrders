<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $with = ['category', 'location', 'status', 'vendor', 'user', 'notes'];

    protected $visible = [
        'created_at',
        'part_num',
        'description',
        'qty',
        'customer_name',
        'customer_contact',
        'customer_deposit',
        'emlpoyee_name',
        'sales_invoice_num',
    ];

    public function category()
    {
        return $this->belongsTo(Ordercategory::class, 'ordercategory_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function status()
    {
        return $this->belongsTo(Orderstatus::class, 'orderstatus_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Ordervendor::class, 'ordervendor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Ordernote::class);
    }

}
