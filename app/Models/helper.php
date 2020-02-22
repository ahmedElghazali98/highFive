<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class helper extends Model
{
    //

    //************************************************************************************************************
    //                                          get last serial function
    //************************************************************************************************************

     public function get_Last_Serial($tabel)
    {

        $laet_serial=DB::select('select serial from ' .$tabel .' where company_id = ' .Auth::user()->company_id )->orderBy('serial', 'desc')->first();

        if($laet_serial==null){
            $laet_serial=1;
        }

        return $laet_serial +1;
    }

}
