<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class internal_store_movements extends Model
{
    //
    use HasRoles;

     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        //start DB transaction
        DB::beginTransaction();

        try{
        $internal_store_movements = new internal_store_movements();
        $internal_store_movements->from_store_id =$input['from_store_id'];
        $internal_store_movements->to_store_id =$input['to_store_id'];
        $internal_store_movements->car_id =$input['car_id'];
        $internal_store_movements->emp_id =$input['emp_id'];
        $internal_store_movements->date =date('Y-m-d ' ,strtotime($input['emp_id']));


        $internal_store_movements->company_id=Auth::user()->company_id;
        $internal_store_movements->user_id=Auth::user()->id;

        $s =internal_store_movements::where('company_id',Auth::user()->company_id)->max('serial');

        $internal_store_movements->serial=$s+1;

        $saved_movemnet=$internal_store_movements->save();


        // save item
        $items_internal_store_movements = new items_internal_store_movements();

        $length=count($input['id_itemsArray']);
        for($i=0 ;$i<$length;++$i){
        $input_item=[
            'quantity'=>$input['quantitys'][$i],
            'movement_id'=>$internal_store_movements->id,
            'item_id'=>$input['id_itemsArray'][$i],
        ];
        $saved=$items_internal_store_movements->add($input_item);
        if(!$saved){
            return false;
        }

    }

    //store item

    $input_store_item=[
        'from_store_id' => $input['from_store_id'],
        'to_store_id' => $input['to_store_id'],
        'id_itemsArray'=>$input['id_itemsArray'],
        'quantitys'=>$input['quantitys'],
     ];

     $store_item= new store_item();
     $saved=$store_item->movements($input_store_item);
     if(!$saved){
         return false;
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




    public function from_store()
    {

        return $this->hasOne('App\Models\stores', 'id', 'from_store_id');
    }

    public function to_store()
    {

        return $this->hasOne('App\Models\stores', 'id', 'to_store_id');
    }
}
