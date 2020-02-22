<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class store_item extends Model
{
    //
    protected $table='store_item';


    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){
        // //start DB transaction
        // DB::beginTransaction();
		//        try{

        $is_exist_store_item=store_item::where('store_id',$input['store_id'])->where('item_id',$input['item_id'])->first();

        if($is_exist_store_item==null){
            //not exist in database and must add new
        $store_item = new store_item();
        $store_item->store_id =$input['store_id'];
        $store_item->item_id =$input['item_id'];
        $store_item->quantity =$input['quantity'];

        $store_item->company_id=Auth::user()->company_id;
        $store_item->user_id=Auth::user()->id;

         $s =store_item::where('company_id',Auth::user()->company_id)->max('serial');

        $store_item->serial=$s+1;

        $saved=$store_item->save();

        return $saved;

    } else{
       // exist in database and only update  quantity

       $is_exist_store_item->quantity =   $is_exist_store_item->quantity + $input['quantity'];
       $is_exist_store_item->update();

    }
//   DB::commit();
//   return true;

//     }
//    catch (\Exception $e) {
//        DB::rollback();
//    }
//    return false;
return true;

    }



    //************************************************************************************************************
    //                                          movements function
    //************************************************************************************************************

    public function movements(array $input){


        $length=count($input['id_itemsArray']);
        for($i=0; $i<$length ;++$i){

            $from=store_item::where('store_id',$input['from_store_id'])->where('item_id',$input['id_itemsArray'][$i])->first();

            if($from !=null){
                $from->quantity=$from->quantity -  $input['quantitys'][$i];
                $from->update();

                $input=[
                    'store_id'=>$input['to_store_id'],
                    'item_id'=>$input['id_itemsArray'][$i],
                    'quantity'=>$input['quantitys'][$i],

                ];

                $store_item = new store_item();
                $store_item->add($input);

            }




        }
        return true;



}



    //************************************************************************************************************
    //                                          reverse movements function
    //************************************************************************************************************
   // use when Processing internal store movement
    public function reverse_movements(array $input){

        //The quantity is Subtract from the to_store
            $to=store_item::where('store_id',$input['to_store_id'])->where('item_id',$input['item_id'])->first();
            if($to !=null){
                $to->quantity=$to->quantity -  $input['quantity'];
                $to->update();
            }

            //The quantity is add from the to_store
            $from=store_item::where('store_id',$input['from_store_id'])->where('item_id',$input['item_id'])->first();
            if($from !=null){
                $from->quantity=$from->quantity +  $input['quantity'];
                $from->update();
            }





        return true;

}


    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =store_item::find($id);
        return $item;
    }


    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateStore_item($id , array $input){

        $store_item =  store_item::find($id);
        $store_item->min_quantity =$input['min_quantity'];
        $store_item->max_quantity =$input['max_quantity'];


        $updated= $store_item->update();

        return  $updated;
    }


     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteStore_item($id)
    {
        $store_item =  store_item::find($id);

        $delete =$store_item->delete();

        return $delete;
    }


    //************************************************************************************************************
    //                                          get item function
    //************************************************************************************************************

   public function item(){

      return $this->hasOne('App\Models\item', 'id', 'item_id');


   }

     //************************************************************************************************************
    //                                          get store function
    //************************************************************************************************************

    public function store(){

        return $this->hasOne('App\Models\stores', 'id', 'store_id');


    }


}

