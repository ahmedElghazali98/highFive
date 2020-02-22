<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class items_internal_store_movements extends Model
{
    //

     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){
   //start DB transaction
   DB::beginTransaction();

   try{

        $items_internal_store_movements = new items_internal_store_movements();
        $items_internal_store_movements->movement_id =$input['movement_id'];
        $items_internal_store_movements->item_id =$input['item_id'];
        $items_internal_store_movements->quantity =$input['quantity'];

        $items_internal_store_movements->company_id=Auth::user()->company_id;
        $items_internal_store_movements->user_id=Auth::user()->id;

        $s =internal_store_movements::where('company_id',Auth::user()->company_id)->max('serial');

        $items_internal_store_movements->serial=$s+1;

        $saved=$items_internal_store_movements->save();


        DB::commit();
        return true;

     }
         catch (\Exception $e) {
             DB::rollback();
         }    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =internal_store_movements::findorfail($id);
        return $item;
    }


    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateinternal_store_movements($id , array $input){

        $internal_store_movements =  internal_store_movements::find($id);
        $internal_store_movements->name = $input['name'];
        $updated= $internal_store_movements->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteinternal_store_movements($id)
    {

        $internal_store_movements =  internal_store_movements::find($id);
        if(count($internal_store_movements->taxes($id))>0){
         return false;
        }else{
            $delete =$internal_store_movements->delete();
            return $delete;
        }

    }

}
