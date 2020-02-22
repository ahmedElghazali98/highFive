<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class store_bills extends Model
{
    //
    protected $table='store_bills';

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        //start DB transaction
        DB::beginTransaction();

        try{
        //get format of bill number
        $format=system_variables::where('index','format_bill_no')->first();
        $s=explode( '-', $format->value);

        //date
        $now = new \DateTime();
        $date= $now->format($s[0]);

        //get count
        $count_store_bill =store_bills::where('company_id',Auth::user()->company_id)->get();
        $c= count($count_store_bill)+1;
        $length=strlen($s[2]);
        $number=str_pad($c, $length, '0', STR_PAD_LEFT);

        $num=$date .$s[1] . $number;

        $store_bills = new store_bills();
        $store_bills->store_id =$input['store_id'];
        $store_bills->bill_no =$num;

        $store_bills->statement =$input['statement'];
        $store_bills->type_id =$input['type_id'];
        $store_bills->discount =$input['discount'];
        $store_bills->supplier_id =$input['supplier_id'];

        $store_bills->company_id=Auth::user()->company_id;
        $store_bills->user_id=Auth::user()->id;

         $s =store_bills::where('company_id',Auth::user()->company_id)->max('serial');

        $store_bills->serial=$s+1;

        $saved=$store_bills->save();

       //save to detalis of bill


       $length=count($input['id_itemsArray']);

       //save the total of bill
       $totle_bill=0;
       $store_id=$input['store_id'];

       for($i=0; $i<$length ;$i++){

           $total=$input['quantity'][$i]  * $input['price'][$i];

           $totle_bill=$totle_bill+$total;


        //get item
        $items = new item();
        $item=$items->getById($input['id_itemsArray'][$i]);


        //get tax_id
        $tax_category = new tax_category();
       $tax_id =$tax_category->getById($item->tax_id);

        //save all input in array
           $input=[
               'bill_id'=>$store_bills->id,
               'item_id'=>$input['id_itemsArray'][$i],
               'quantity'=>$input['quantity'][$i],
               'price'=>$input['price'][$i],
               'tax_id'=>$tax_id->id,
           ];

           $store_bills_details= new store_bills_details();
           $status=$store_bills_details->add($input);
           if(! $status){
           return false;
           }


           //----------------------------------------save to store_item-----------------------------------

           $input=[
               'store_id'=>$store_id,
               'item_id'=>$input['item_id'],
               'quantity'=>$input['quantity'],
           ];

           $store_item= new store_item();
           $store_item->add($input);

       }//end for


       // update the total_price in store_bill
       $s=store_bills::find($store_bills->id);
       $s->total_price=$totle_bill;
       $s->update();

       DB::commit();
       return true;

    }
        catch (\Exception $e) {
            DB::rollback();
        }
        return false;

    }


    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =store_bills::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateStore_bills($id , array $input){

  //start DB transaction
  DB::beginTransaction();
          try{
        $store_bills =store_bills::findorfail($id);
        $store_bills->store_id =$input['store_id'];

        $store_bills->statement =$input['statement'];
        $store_bills->type_id =$input['type_id'];
        $store_bills->discount =$input['discount'];
        $store_bills->supplier_id =$input['supplier_id'];

        $store_bills->company_id=Auth::user()->company_id;
        $store_bills->user_id=Auth::user()->id;

         $s =store_bills::where('company_id',Auth::user()->company_id)->max('serial');

        $store_bills->serial=$s+1;

        $saved=$store_bills->update();

       //save to detalis of bill


       $length=count($input['id_itemsArray']);

       //save the total of bill
       $totle_bill=0;
       $store_id=$input['store_id'];

       for($i=0; $i<$length ;$i++){

           $total=$input['quantity'][$i]  * $input['price'][$i];

           $totle_bill=$totle_bill+$total;


        //get item
        $items = new item();
        $item=$items->getById($input['id_itemsArray'][$i]);


        //get tax_id
        $tax_category = new tax_category();
       $tax_id =$tax_category->getById($item->tax_id);

        //save all input in array
           $input_stort_details=[
                'store_id'=>$input['store_id'],
                'type_id'=>$input['type_id'],
                'bill_id'=>$store_bills->id,
               'item_id'=>$input['id_itemsArray'][$i],
               'quantity'=>$input['quantity'][$i],
               'price'=>$input['price'][$i],
               'tax_id'=>$tax_id->id,
           ];

           //check change data
           $store_bills_details= new store_bills_details();
         $status=  $store_bills_details->checkOFDataChange($input_stort_details);
           if(! $status){
            return false;
            }



           //----------------------------------------save to store_item-----------------------------------

           $store_d_to_get_old_quantity=store_bills_details::where('bill_id',$store_bills->id )->where('item_id',$input_stort_details['item_id'])->first();
          $new_quantity= $input_stort_details['quantity'] - $store_d_to_get_old_quantity->quantity;
        //   if($new_quantity<0){
        //       $new_quantity=$new_quantity *-1;
        //   }

           $input_stort_item=[
               'store_id'=>$store_id,
               'item_id'=>$input_stort_details['item_id'],
               'quantity'=>$new_quantity,

           ];

           $isUpdate=0;
           $store_item= new store_item();
           $status=$store_item->add($input_stort_item,$isUpdate);
           if(! $status){
            return false;
            }


         //---------------------------remove all data in table store bill detils and the add-----------------------------------

         $s_b_d =store_bills_details::where('bill_id',$store_bills->id)->get();
         foreach($s_b_d as $s){
             $s->deleteStore_bills_details($s->id);
         }

         //then add
        $status= $store_bills_details->add($input_stort_details);

         if(! $status){
            return false;
            }


       }//end for


       // update the total_price in store_bill
       $s=store_bills::find($store_bills->id);
       $s->total_price=$totle_bill;
       $s->update();

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

    public function deleteStore_bills($id)
    {
        $store_bills =  store_bills::findorfail($id);

        $delete =$store_bills->delete();

        return $delete;
    }


}
