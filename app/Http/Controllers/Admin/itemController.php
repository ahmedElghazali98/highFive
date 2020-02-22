<?php

namespace App\Http\Controllers\Admin;
use App\Models\item as MyModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\system_constants;
use Illuminate\Support\Facades\Auth;
use App\Models\category_product;
use App\Models\item;
use App\Models\tax_category;
use App\Models\subltems;
class itemController extends AdminController
{
    //

    public function __construct()
    {

    }
    //************************************************************************************************************
    //                                          Index function
    //************************************************************************************************************
    public function index(Request $request)
    {
        //search using name
        $name  = $request->get('name');
        $data['categories'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['categories'] = $data['categories']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
        }

        $data['categories'] = $data['categories']->paginate(8);

        //get system constants
        $data['type_categories']=system_constants::where('company_id',Auth::user()->company_id)->where('type','type_category')->where('status','1')->orderBy('id', 'desc')->get();
        $data['manufacture_companies']=system_constants::where('company_id',Auth::user()->company_id)->where('type','manufacture_company')->where('status','1')->orderBy('id', 'desc')->get();
        $data['units']=system_constants::where('company_id',Auth::user()->company_id)->where('type','unit')->where('status','1')->orderBy('id', 'desc')->get();

        //get category_product
        $data['category_product']=category_product::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
        $data['tax_category']=tax_category::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();


        if ($request->ajax()) {
            return view('admin.items.table-data', compact('data'))->render();
        }
        return view('admin.items.index', compact('data'));
    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $name_ar=$request->get('name_ar');
            $name_en=$request->get('name_en');
            $link_img=$request->get('link_img');
            $minimum=$request->get('minimum');
            $pricing_price=$request->get('pricing_price');
            $final_price=$request->get('final_price');
            $wholesale_price=$request->get('wholesale_price');
            $cost_price=$request->get('cost_price');
            $manufacture_company_id=$request->get('manufacture_company_id');
            $unit_id=$request->get('unit_id');
            $size=$request->get('size');
            $type_category_id=$request->get('type_category_id');
            $barcode=$request->get('barcode');
            $category_product_id=$request->get('category_product_id');
            $tax_id=$request->get('tax_id');



            //data to sub ltem
            $id_itemsArray= explode(",",$request->get('id_items'));
            $quantitys= explode(",",$request->get('quantity'));

            $rules = [
                'name_ar' => 'required',
                'cost_price' => 'required',
                'minimum' => 'required',
                'pricing_price' => 'required',
                'final_price' => 'required',
                'wholesale_price' => 'required',
                'link_img' => 'required',
                'wholesale_price'=>'required',
                'img'  => 'size:max:2000',
                'tax_id'=>'required',


            ];


            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'cost_price.required' => 'سعر التكلفة   مطلوب  ',
                'minimum.required' => 'الحد الادنى   مطلوب  ',
                'pricing_price.required' => 'سعر التسعيرة  مطلوب  ',
                'final_price.required' => 'السعر النهائي  مطلوب  ',
                'link_img.required' => 'رابط الصورة   مطلوب  ',
                'wholesale_price.required' => 'سعر الجملة    مطلوب  ',
                'img.size'=> 'حجم الصورة كبير جدا',
                'tax_id.required' => ' تصنيف الضريبة مطلوب',



            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'link_img' => $link_img,
                    'minimum' => $minimum,
                    'pricing_price' => $pricing_price,
                    'final_price' => $final_price,
                    'wholesale_price' => $wholesale_price,
                    'cost_price' => $cost_price,
                    'barcode' => $barcode,
                    'tax_id'=>$tax_id


                ],
                $rules,
                $messages
            );



            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

            //upload img
            if ($request->hasFile('img') != null) {
                $image = $request->file('img');

                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = base_path() . '/uploads/';

                $image->move($destinationPath, $input['imagename']);
            }



               //svae category
               $item = new MyModel();
               $item->name_ar = $name_ar;
               $item->name_en = $name_en;
               $item->link_img = $link_img;
               $item->minimum = $minimum;
               $item->pricing_price = $pricing_price;
               $item->final_price = $final_price;
               $item->cost_price = $cost_price;
               $item->wholesale_price = $wholesale_price;
               $item->barcode = $barcode;

               $item->manufacture_company_id = $manufacture_company_id;
               $item->unit_id = $unit_id;
               $item->size= $size;
               $item->type_category_id = $type_category_id;
               $item->category_product_id = $category_product_id;

               $item->tax_id = $tax_id;

               //save company id
               $item->company_id = Auth::user()->company_id;


               if ($request->hasFile('img') != null) {
                $item->img = $input['imagename'];
                }



               $saved = $item->save();


               //save sub ltem
               if($type_category_id==71){
                $length = count($quantitys);
                for($i=0 ; $i<$length ;++$i){
                    $subitem= new subltems();
                    $subitem->items_id =$item->id;
                    $subitem->sub_item_id =$id_itemsArray[$i];
                    $subitem->quantity =$quantitys[$i];
                    $subitem->save();
                }

               }

               if (!$saved) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
               return response()->json(['status' => true, 'data' => __('text.add_successful')]);
            }else{
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

            }

        }

    //************************************************************************************************************
    //                                          edit function
    //************************************************************************************************************
       public function edit(Request $request)
       {
           $id = $request->get('id');
           $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
           if ($item != '') {
               return response()->json(['status' => true, 'data' => $item]);
           } else {
               return response()->json(['status' => false, 'data' => __('text.error_process')]);
           }
       }


    //************************************************************************************************************
    //                                          get item function
    //************************************************************************************************************
    public function getItem($id)
    {
        $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
        $units=system_constants::where('company_id',Auth::user()->company_id)->where('type','unit')->where('status','1')->orderBy('id', 'desc')->get();
        if ($item != '') {
            return response()->json(['status' => true, 'data' => $item , 'units'=>$units]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }



    //************************************************************************************************************
    //                                          update function
    //************************************************************************************************************
    public function update(Request $request)
    {
        $hidden = $request->get('hidden');
        if ($hidden != 0) {
            $name_ar=$request->get('name_ar');
            $name_en=$request->get('name_en');
            $link_img=$request->get('link_img');
            $minimum=$request->get('minimum');
            $pricing_price=$request->get('pricing_price');
            $final_price=$request->get('final_price');
            $wholesale_price=$request->get('wholesale_price');
            $cost_price=$request->get('cost_price');
            $manufacture_company_id=$request->get('manufacture_company_id');
            $unit_id=$request->get('unit_id');
            $size=$request->get('size');
            $type_category_id=$request->get('type_category_id');
            $barcode=$request->get('barcode');
            $category_product_id=$request->get('category_product_id');
            $tax_id=$request->get('tax_id');




            $rules = [
                'name_ar' => 'required',
                'cost_price' => 'required',
                'minimum' => 'required',
                'pricing_price' => 'required',
                'final_price' => 'required',
                'wholesale_price' => 'required',
                'link_img' => 'required',
                'wholesale_price'=>'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'cost_price.required' => 'سعر التكلفة   مطلوب  ',
                'minimum.required' => 'الحد الادنى   مطلوب  ',
                'pricing_price.required' => 'سعر التسعيرة  مطلوب  ',
                'final_price.required' => 'السعر النهائي  مطلوب  ',
                'link_img.required' => 'رابط الصورة   مطلوب  ',
                'wholesale_price.required' => 'سعر الجملة    مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'link_img' => $link_img,
                    'minimum' => $minimum,
                    'pricing_price' => $pricing_price,
                    'final_price' => $final_price,
                    'wholesale_price' => $wholesale_price,
                    'cost_price' => $cost_price,
                    'barcode' => $barcode,


                ],
                $rules,
                $messages
            );



            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

               //update category
               $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();
               if($item==null){
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

               }
               $item->name_ar = $name_ar;
               $item->name_en = $name_en;
               $item->link_img = $link_img;
               $item->minimum = $minimum;
               $item->pricing_price = $pricing_price;
               $item->final_price = $final_price;
               $item->cost_price = $cost_price;
               $item->wholesale_price = $wholesale_price;
               $item->barcode = $barcode;

               $item->tax_id = $tax_id;

               $item->manufacture_company_id = $manufacture_company_id;
               $item->unit_id = $unit_id;
               $item->size= $size;
               $item->type_category_id= $type_category_id;
               $item->category_product_id= $category_product_id;


                //upload img
            if ($request->hasFile('img') != null) {
                $image = $request->file('barcode');

                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = base_path() . '/uploads/';

                $image->move($destinationPath, $input['imagename']);
            }

            if ($request->hasFile('img') != null) {
                $item->img=  $input['imagename'] ;

            }
               $saved = $item->update();
               if (!$saved) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
               }
               return response()->json(['status' => true, 'data' => __('text.update_successful')]);
            }else{
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

            }
    }
    //************************************************************************************************************
    //                                          delete function
    //************************************************************************************************************
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
        if ($item != '') {

            $deleted = $item->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
     //************************************************************************************************************
    //                                          search Item function
    //************************************************************************************************************
    public function searchItem($id){

        $item = item::where('company_id',Auth::user()->company_id)->where('id',$id)->orderBy('id', 'desc')->first();
        $unit=system_constants::find($item->unit_id);

        $output=[
            'id'=>$item->id,
            'name_ar'=>$item->name_ar,
            'name_en'=>$item->name_en,
            'unit_ar'=>$unit->name_ar,
        ];
        if ($item != '') {
            return response()->json(['status' => true, 'data' => $output]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }

    }


    public function search(Request $request)
    {
        $search_str = "%" . str_replace(" ", "%", trim($request->name)) . "%";
        $items = item::where(function($query) use($search_str){
          $query->where('name_ar', 'LIKE', $search_str)->orWhere('name_en', 'LIKE', $search_str);
        })->where('company_id',Auth::user()->company_id)->limit(10)->get();
        $builder = "";
        foreach ($items as $item) {
            $builder .= '<li class="" data-id="' . $item->id . '">';
            $builder .= '<span>' . $item->name_ar . '/' . $item->name_en . ' </span>';
            $builder .= '</li>';
        }
        return $builder;
    }

    public function search_item_production(Request $request)
    {
        $search_str = "%" . str_replace(" ", "%", trim($request->name)) . "%";
        $items = item::where(function($query) use($search_str){
          $query->where('name_ar', 'LIKE', $search_str)->orWhere('name_en', 'LIKE', $search_str);
        })->where('company_id',Auth::user()->company_id)->where('type_category_id',71)->limit(10)->get();
        $builder = "";
        foreach ($items as $item) {
            $builder .= '<li class="" data-id="' . $item->id . '">';
            $builder .= '<span>' . $item->name_ar . '/' . $item->name_en . ' </span>';
            $builder .= '</li>';
        }
        return $builder;
    }





    public function search_using_barcode(Request $request)
    {
        $search_str = "%" . str_replace(" ", "%", trim($request->name)) . "%";
        $items = item::where(function($query) use($search_str){
          $query->where('barcode', 'LIKE', $search_str);
        })->where('company_id',Auth::user()->company_id)->limit(10)->get();
        $builder = "";
        foreach ($items as $item) {
            $builder .= '<li class="" data-id="' . $item->id . '">';
            $builder .= '<span>' . $item->name_ar . '/' . $item->barcode . ' </span>';
            $builder .= '</li>';
        }
        return $builder;
    }
}
