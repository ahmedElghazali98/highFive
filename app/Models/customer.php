<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class customer extends Model
{

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $customer = new customer();
        $customer->name_ar =$input['name_ar'];
        $customer->name_en =$input['name_en'];
        $customer->mobile =$input['mobile'];
        $customer->tel =$input['tel'];
        $customer->email =$input['email'];
        $customer->area =$input['area'];
        $customer->city_id =$input['city_id'];
        $customer->full_address =$input['full_address'];
        $customer->price_category_id =$input['price_category_id'];
        $customer->delegate_id =$input['delegate_id'];

        $customer->company_id=Auth::user()->company_id;
        $customer->user_id=Auth::user()->id;

         $s =customer::where('company_id',Auth::user()->company_id)->max('serial');

        $customer->serial=$s+1;

        $saved=$customer->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =customer::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateCustomer($id , array $input){

        $customer =  customer::find($id);
        $customer->name_ar =$input['name_ar'];
        $customer->name_en =$input['name_en'];
        $customer->mobile =$input['mobile'];
        $customer->tel =$input['tel'];
        $customer->email =$input['email'];
        $customer->area =$input['area'];
        $customer->city_id =$input['city_id'];
        $customer->full_address =$input['full_address'];
        $customer->price_category_id =$input['price_category_id'];
        $customer->delegate_id =$input['delegate_id'];

        $updated= $customer->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteCustomer($id)
    {
        $customer =  customer::findorfail($id);

        $delete =$customer->delete();

        return $delete;
    }



    //************************************************************************************************************
    //                        get city of customer function
    //************************************************************************************************************

    public function city()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'city_id');
    }

        //************************************************************************************************************
    //                        get price_category of customer function
    //************************************************************************************************************


    public function price_category()
    {

        return $this->hasOne('App\Models\system_constants', 'id', 'price_category_id');
    }



}
