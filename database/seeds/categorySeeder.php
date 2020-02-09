<?php

use Illuminate\Database\Seeder;
use App\Models\categoty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0 ;$i<50000;++$i){
        DB::table('categoties')->insert([
            'name_ar' => Str::random(10),
            'name_en' => Str::random(10),
            'link_img' => Str::random(10),
            'safety_stocks' =>'1',
            'pricing_price' =>'1',
            'final_price' =>'1',
            'cost_price' =>'1',
            'wholesale_price' =>'1',
            'barcode' =>'1',
            'manufacture_company_id' =>'53',
            'unit_id' =>'52',
            'type_category_id' =>'50',
            'size' => Str::random(10),


        ]);
        }



    }
}
