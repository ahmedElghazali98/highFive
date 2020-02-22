<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class category_product extends Model
{
    //


    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************
    public function add(array $input){

        $category_product = new category_product();
        $category_product->name =$input['name'];

        $category_product->company_id=Auth::user()->company_id;
        $category_product->user_id=Auth::user()->id;

         $s =category_product::where('company_id',Auth::user()->company_id)->max('serial');

        $category_product->serial=$s+1;

        $saved=$category_product->save();

        return $saved;

    }

    //************************************************************************************************************
    //                                          get By id function
    //************************************************************************************************************

    public function getById($id){

        $item =category_product::findorfail($id);
        return $item;
    }

    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function updatecategory_product($id , array $input){

        $category_product =  category_product::find($id);
        $category_product->name =$input['name'];
        $updated= $category_product->update();

        return  $updated;
    }

     //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************

    public function deletecategory_product($id)
    {
        $category_product =  category_product::findorfail($id);

        $delete =$category_product->delete();

        return $delete;
    }
}
