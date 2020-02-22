<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class cars extends Model
{
    //

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $cars = new cars();
        $cars->name_ar =$input['name_ar'];
        $cars->type_id =$input['type_id'];
        $cars->color_id =$input['color_id'];
        $cars->driver_id =$input['driver_id'];
        $cars->car_number  =$input['car_number'];
        $cars->manufacturing_year  =$input['manufacturing_year'];



        $cars->company_id=Auth::user()->company_id;
        $cars->user_id=Auth::user()->id;

         $s =cars::where('company_id',Auth::user()->company_id)->max('serial');

        $cars->serial=$s+1;

        $saved=$cars->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =cars::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateCars($id , array $input){

        $cars =  cars::findorfail($id);
        $cars->name_ar =$input['name_ar'];
        $cars->type_id =$input['type_id'];
        $cars->color_id =$input['color_id'];
        $cars->driver_id =$input['driver_id'];
        $cars->car_number  =$input['car_number'];
        $cars->manufacturing_year  =$input['manufacturing_year'];

        $updated= $cars->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteCars($id)
    {
        $cars =  cars::findorfail($id);

        $delete =$cars->delete();

        return $delete;
    }

  //************************************************************************************************************
    //                                          get all movement function
    //************************************************************************************************************


    public function movements()
    {

        return $this->hasMany('App\Models\internal_store_movements', 'car_id','id')->orderBy('id', 'asc');
    }



}
