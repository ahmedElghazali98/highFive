<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dismantling_product extends Model
{
    //

    public function item()
    {

        return $this->hasOne('App\Models\item', 'id', 'item_id');
    }
}
