<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class taxes extends Model
{
    //
    protected $table='taxes';

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $taxes = new taxes();
        $taxes->name =$input['name'];
        $taxes->category_id =$input['category_id'];
        $taxes->rate =$input['rate']/100;

        $taxes->company_id=Auth::user()->company_id;
        $taxes->user_id=Auth::user()->id;

         $s =taxes::where('company_id',Auth::user()->company_id)->max('serial');

        $taxes->serial=$s+1;

        $saved=$taxes->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =taxes::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateTaxes($id , array $input){

        $taxes =  taxes::find($id);
        $taxes->name =$input['name'];
        $taxes->category_id =$input['category_id'];
        $taxes->rate =$input['rate']/100;
        $updated= $taxes->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteTaxes($id)
    {
        $taxes =  taxes::findorfail($id);

        $delete =$taxes->delete();

        return $delete;
    }

}
