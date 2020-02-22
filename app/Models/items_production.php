<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class items_production extends Model
{
    //

     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $items_production = new items_production();
        $items_production->item_id =$input['item_id'];
        $items_production->store_id =$input['store_id'];
        $items_production->quantity =$input['quantity'];
        $items_production->date =date('Y-m-d ' ,strtotime($input['date']));
        $items_production->company_id=Auth::user()->company_id;
        $items_production->user_id=Auth::user()->id;

        $s =items_production::where('company_id',Auth::user()->company_id)->max('serial');

        $items_production->serial=$s+1;

        $items_production->save();

        //save store item
        $input_store_item=[
            'item_id'=>$input['item_id'],
            'store_id'=>$input['store_id'],
            'quantity'=>$input['quantity'] ,
        ];

        // اضافة المنتج المركب للمخازن
        $store= new store_item();
        $saved_item=$store->add($input_store_item);


        //طرح من كميات الاصناف الفرعية المكونه لهذا المنتج
        $sub_item= subltems::where('items_id',$input['item_id'] )->get();
        foreach($sub_item as $s){
            //get item
            $item=item::find($s->sub_item_id);
            $input_subtract_quantities=[
                'store_id'=>$input['store_id'],
                'quantity'=>$s->quantity *-1  ,
                'item_id'=>$s->sub_item_id ,
            ];

            $saves_subtract_quantities=$store->add($input_subtract_quantities);


        }

         return true;
    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =items_production::findorfail($id);

        return $item;
    }


    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateItems_production($id , array $input){

        $items_production =  items_production::find($id);
        $items_production->name = $input['name'];
        $items_production->item_id =$input['item_id'];
        $items_production->store_id =$input['store_id'];
        $items_production->quantity =$input['quantity'];

        $updated= $items_production->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteItems_production($id)
    {

        $items_production =  items_production::find($id);
        if(count($items_production->taxes($id))>0){
         return false;
        }else{
            $delete =$items_production->delete();
            return $delete;
        }

    }





    public function store()
    {

        return $this->hasOne('App\Models\stores', 'id', 'store_id');
    }


    public function item()
    {

        return $this->hasOne('App\Models\item', 'id', 'item_id');
    }
}
