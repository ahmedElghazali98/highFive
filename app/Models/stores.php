<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class stores extends Model
{
     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $stores = new stores();
        $stores->name_ar =$input['name_ar'];
        $stores->name_en =$input['name_en'];
        $stores->tel =$input['tel'];
        $stores->storekeeper_id =$input['storekeeper_id'];
        $stores->area =$input['area'];
        $stores->city_id =$input['city_id'];
        $stores->full_address =$input['full_address'];


        $stores->company_id=Auth::user()->company_id;
        $stores->user_id=Auth::user()->id;

         $s =stores::where('company_id',Auth::user()->company_id)->max('serial');

        $stores->serial=$s+1;

        $saved=$stores->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =stores::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateStores($id , array $input){

        $stores =  stores::find($id);
        $stores->name_ar =$input['name_ar'];
        $stores->name_en =$input['name_en'];
        $stores->storekeeper_id =$input['storekeeper_id'];
        $stores->area =$input['area'];
        $stores->city_id =$input['city_id'];
        $stores->full_address =$input['full_address'];



        $updated= $stores->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteStores($id)
    {
        $stores =  stores::findorfail($id);

        $delete =$stores->delete();

        return $delete;
    }



}
