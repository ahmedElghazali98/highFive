<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class item_production_log extends Model
{
    //

     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $item_production_log = new item_production_log();
        $item_production_log->item_production_id =$input['item_production_id'];
        $item_production_log->item_id =$input['item_id'];
        $item_production_log->store_id =$input['store_id'];
        $item_production_log->quantity =$input['quantity'];
        $item_production_log->date =date('Y-m-d ' ,strtotime($input['date']));
        $item_production_log->company_id=Auth::user()->company_id;
        $item_production_log->user_id=Auth::user()->id;

        $s =item_production_log::where('company_id',Auth::user()->company_id)->max('serial');

        $item_production_log->serial=$s+1;

        $saves=$item_production_log->save();

         return $saves;
    }

}
