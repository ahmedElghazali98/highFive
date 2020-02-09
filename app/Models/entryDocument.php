<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class entryDocument extends Model
{
    //

    public function supplier()
    {

        return $this->hasOne('App\Models\suppliers', 'id', 'supplier_id');
    }

    public function allItems()
    {

        return $this->hasMany('App\Models\items_entry_documents', 'entry_document_id','id')->orderBy('id', 'asc');
    }



}
