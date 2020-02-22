<?php

namespace App\Exports;
use App\Models\stores;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\system_constants;
use App\Models\employees;
class storesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $stores[0] = [' الاسم بالعربي  ' ,'الاسم بالانجلزية', 'تيلفون', 'المدينة', 'المنطقة ', 'العنوان بالكامل', 'امين المخزن '];
        $i=1;
        foreach (stores::all() as $s) {

             $city=system_constants::find($s->city_id);
             $storekeeper=employees::find($s->storekeeper_id);

            //svae one row in array
            $stores[$i]=[$s->name_ar,$s->name_en, $s->tel ,$city->name_ar,$s->area ,$s->full_address ,$storekeeper->name_ar];
            ++$i;

        }

        return collect($stores);

    }
}
