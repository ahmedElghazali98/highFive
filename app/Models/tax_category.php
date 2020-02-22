<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tax_category extends Model
{
    //
    protected $table='tax_category';

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $tax_category = new tax_category();
        $tax_category->name =$input['name'];
        $tax_category->company_id=Auth::user()->company_id;
        $tax_category->user_id=Auth::user()->id;

        $s =tax_category::where('company_id',Auth::user()->company_id)->max('serial');

        $tax_category->serial=$s+1;

        $saved=$tax_category->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =tax_category::findorfail($id);
        return $item;
    }


    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updateTax_category($id , array $input){

        $tax_category =  tax_category::find($id);
        $tax_category->name = $input['name'];
        $updated= $tax_category->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deleteTax_category($id)
    {

        $tax_category =  tax_category::find($id);
        if(count($tax_category->taxes($id))>0){
         return false;
        }else{
            $delete =$tax_category->delete();
            return $delete;
        }

    }

      //************************************************************************************************************
    //                                          has many tax function
    //************************************************************************************************************

    public function taxes($id)
    {

        return taxes::Where('category_id',$id)->get();
    }



}
