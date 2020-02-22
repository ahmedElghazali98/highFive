<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class employees extends Model
{
    //
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $employees = new employees();
        $employees->name_ar =$input['name_ar'];
        $employees->name_en =$input['name_en'];
        $employees->mobile =$input['mobile'];
        $employees->tel =$input['tel'];
        $employees->email =$input['email'];
        $employees->area =$input['area'];
        $employees->city_id =$input['city_id'];
        $employees->full_address =$input['full_address'];

        $employees->company_id=Auth::user()->company_id;
        $employees->user_id=Auth::user()->id;

         $s =employees::where('company_id',Auth::user()->company_id)->max('serial');

        $employees->serial=$s+1;

        $saved=$employees->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getByid($id){
        return  employees::findorfail($id);
      }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateemployees($id , array $input){

        $employees =  employees::find($id);
        $employees->name_ar =$input['name_ar'];
        $employees->name_en =$input['name_en'];
        $employees->mobile =$input['mobile'];
        $employees->tel =$input['tel'];
        $employees->email =$input['email'];
        $employees->area =$input['area'];
        $employees->city_id =$input['city_id'];
        $employees->full_address =$input['full_address'];


        $updated= $employees->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteemployees($id)
    {
        $employees =  employees::findorfail($id);

        $delete =$employees->delete();

        return $delete;
    }


}
