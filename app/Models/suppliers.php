<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class suppliers extends Model
{
    //

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $suppliers = new suppliers();
        $suppliers->name_ar =$input['name_ar'];
        $suppliers->name_en =$input['name_en'];
        $suppliers->mobile =$input['mobile'];
        $suppliers->tel =$input['tel'];
        $suppliers->email =$input['email'];
        $suppliers->area =$input['area'];
        $suppliers->city_id =$input['city_id'];
        $suppliers->full_address =$input['full_address'];


        $suppliers->company_id=Auth::user()->company_id;
        $suppliers->user_id=Auth::user()->id;

         $s =suppliers::where('company_id',Auth::user()->company_id)->max('serial');

        $suppliers->serial=$s+1;

        $saved=$suppliers->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =suppliers::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateSuppliers($id , array $input){

        $suppliers =  suppliers::find($id);
        $suppliers->name_ar =$input['name_ar'];
        $suppliers->name_en =$input['name_en'];
        $suppliers->mobile =$input['mobile'];
        $suppliers->tel =$input['tel'];
        $suppliers->email =$input['email'];
        $suppliers->area =$input['area'];
        $suppliers->city_id =$input['city_id'];
        $suppliers->full_address =$input['full_address'];



        $updated= $suppliers->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteSuppliers($id)
    {
        $suppliers =  suppliers::findorfail($id);

        $delete =$suppliers->delete();

        return $delete;
    }


     //************************************************************************************************************
    //                        get city of supplier function
    //************************************************************************************************************

    public function city()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'city_id');
    }
}
