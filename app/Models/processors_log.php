<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class processors_log extends Model
{
    //

    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add($filed ,$old_value , $new_value ,$user_id ,$movemoent_id){

        $p = new  processors_log();

        $p->filed_ar=$filed;
        $p->old_value=$old_value;
        $p->new_value=$new_value;
        $p->user_id=$user_id;
        $p->movemoent_id=$movemoent_id;
        $p->save();


    }

    //************************************************************************************************************
    //                                          check old value and new value function
    //************************************************************************************************************

    public  function ischange($old_value , $new_value)
    {
     return $old_value==$new_value;
    }
}
