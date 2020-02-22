<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class store_item_transaction_log extends Model
{
    //

    protected $table='store_item_transaction_log';

    public function add(array $input){


        $store_item_transaction_log = new store_item_transaction_log();
        $store_item_transaction_log->store_id =$input['store_id'];
        $store_item_transaction_log->item_id =$input['item_id'];
        $store_item_transaction_log->transaction_id =$input['transaction_id'];
        $store_item_transaction_log->transaction_type =$input['transaction_type'];
        $store_item_transaction_log->quantity =$input['quantity'];
        $store_item_transaction_log->price =$input['price'];


        $store_item_transaction_log->company_id=Auth::user()->company_id;
        $store_item_transaction_log->user_id=Auth::user()->id;

         $s =store_item_transaction_log::where('company_id',Auth::user()->company_id)->max('serial');

        $store_item_transaction_log->serial=$s+1;

        $saved=$store_item_transaction_log->save();


        return $saved;


    }


}
