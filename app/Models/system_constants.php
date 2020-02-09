<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\models\categoty;
class system_constants extends Model
{
    //
    protected $table = 'system_constants';

    public function cities()
    {

        return $this->hasMany('App\Models\customer', 'city_id','id')->orderBy('id', 'asc');
    }

    public function units()
    {

        return $this->hasMany('App\Models\categoty', 'unit_id','id')->orderBy('id', 'asc');
    }

    public function type_category()
    {

        return $this->hasMany('App\Models\categoty', 'type_category_id ','id')->orderBy('id', 'asc');
    }

    public function manufacture_company()
    {

        return $this->hasMany('App\Models\categoty', 'manufacture_company_id  ','id')->orderBy('id', 'asc');
    }







}
