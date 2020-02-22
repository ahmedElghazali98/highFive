<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class store_bills_details extends Model
{
    //
    protected $table='store_bills_details';


    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        //start DB transaction
        DB::beginTransaction();
       try{
        $store_bills_details = new store_bills_details();
        $store_bills_details->bill_id =$input['bill_id'];
        $store_bills_details->item_id =$input['item_id'];
        $store_bills_details->quantity =$input['quantity'];
        $store_bills_details->price =$input['price'];
        $store_bills_details->tax_id =$input['tax_id'];


        $store_bills_details->company_id=Auth::user()->company_id;
        $store_bills_details->user_id=Auth::user()->id;

         $s =store_bills_details::where('company_id',Auth::user()->company_id)->max('serial');

        $store_bills_details->serial=$s+1;



        $store_bills_details->save();

          //------------------save the  store_tax_bill-------------------------------------------
          // get all tax of tax_category

         $t= new tax_category();
         $all_taxes=$t->taxes($input['tax_id']);
         $l= count($all_taxes);
         $quantity=$input['quantity'];
         $price=$input['price'];

        foreach($all_taxes as $t){

         $total= $price * $quantity;
         $tax_amount=$total * $t->rate;
         $input=[
            'bill_id'=>$store_bills_details->id,
            'tax_id'=>$t->id,
            'total'=>$total,
            'tax_amount'=>$tax_amount,

        ];

        //call function in model store_tax_bill to save input
        $store_tax_bill = new store_tax_bill();
        $status=$store_tax_bill->add($input);
        if(! $status){
            return false;
            }
    }

    DB::commit();
    return true;

 }
     catch (\Exception $e) {
         DB::rollback();
     }
     return false;
    }



    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function checkOFDataChange(array $input){
        //start DB transaction
        DB::beginTransaction();
		       try{
        $store_bills_details = store_bills_details::where('bill_id',$input['bill_id'])->get();
        $store_bill= store_bills::find($input['bill_id']);
        foreach($store_bills_details as $s){

            //يوجد تغير في القيم وسيتم التخزين في جدول المعالجات
            if( !($s->item_id==$input['item_id'] && $s->quantity==$input['quantity']  && $s->price==$input['price'])){
               $store_item_transaction_log = new store_item_transaction_log();

               $input=[
                'store_id'=>$store_bill->store_id,
                'item_id'=>$s->item_id,
                'transaction_id'=>$input['bill_id'],
                'transaction_type'=>$store_bill->type_id,
                'quantity'=>$s->quantity,
                'price'=>$s->price,

               ];
               $status=$store_item_transaction_log->add($input);
               if(! $status){
                return false;
                }


        }
    }


    DB::commit();
    return true;

 }
     catch (\Exception $e) {
         DB::rollback();
     }
     return false;

    }

      //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteStore_bills_details($id)
    {
        $store_bills_details =  store_bills_details::findorfail($id);

        $delete =$store_bills_details->delete();

        return $delete;
    }




}
