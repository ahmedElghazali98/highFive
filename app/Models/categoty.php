<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class categoty extends Model
{
    //


    public function unit()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'unit_id');
    }


    public function type_category()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'type_category_id');
    }

    public function manufacture_company()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'manufacture_company_id');
    }
}
