<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    public function city()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'city_id');
    }

    public function price_category()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'price_category_id');
    }



}
