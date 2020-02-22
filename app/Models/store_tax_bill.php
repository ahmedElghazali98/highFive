<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class store_tax_bill extends Model
{
    //
    protected $table='store_tax_bill';



    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $store_tax_bill = new store_tax_bill();
        $store_tax_bill->bill_id =$input['bill_id'];
        $store_tax_bill->tax_id =$input['tax_id'];
        $store_tax_bill->total =$input['total'];
        $store_tax_bill->tax_amount =$input['tax_amount'];

        $store_tax_bill->company_id=Auth::user()->company_id;
        $store_tax_bill->user_id=Auth::user()->id;

         $s =store_tax_bill::where('company_id',Auth::user()->company_id)->max('serial');

        $store_tax_bill->serial=$s+1;

        $store_tax_bill->save();

        return  true;

    }
}
