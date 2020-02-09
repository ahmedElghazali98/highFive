<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    //

    public function city()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'city_id');
    }
}
