<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 9/23/17
 * Time: 10:59 PM
 */

namespace App\Traits;


trait IdAttribute
{

    public function getIdAttribute()
    {
        $id = $this->getKeyName();
        return $this->$id;
    }

}
