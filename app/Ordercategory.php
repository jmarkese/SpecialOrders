<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordercategory extends Model
{
    protected $table = 'product_category';

    protected $primaryKey = 'category_id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'fk_category_id', 'owner_id', 'notes_id');
    }

}
