<?php

namespace App\Http\Controllers\Admin;
use App\Models\categoty as MyModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\system_constants;
use Illuminate\Support\Facades\Auth;
class categoryController extends AdminController
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

        if ($request->ajax()) {
            return view('admin.categoties.table-data', compact('data'))->render();
        }
        return view('admin.categoties.index', compact('data'));
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
            $safety_stocks=$request->get('safety_stocks');
            $pricing_price=$request->get('pricing_price');
            $final_price=$request->get('final_price');
            $wholesale_price=$request->get('wholesale_price');
            $cost_price=$request->get('cost_price');
            $manufacture_company_id=$request->get('manufacture_company_id');
            $unit_id=$request->get('unit_id');
            $size=$request->get('size');
            $type_category_id=$request->get('type_category_id');
            $barcode=$request->get('barcode');




            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'cost_price' => 'required',
                'safety_stocks' => 'required',
                'pricing_price' => 'required',
                'final_price' => 'required',
                'wholesale_price' => 'required',
                'link_img' => 'required',
                'wholesale_price'=>'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'name_en.required' => 'اسم التصنيف مطلوب  ',
                'cost_price.required' => 'سعر التكلفة   مطلوب  ',
                'safety_stocks.required' => 'مخزون الامان  مطلوب  ',
                'pricing_price.required' => 'سعر التسعيرة  مطلوب  ',
                'final_price.required' => 'السعر النهائي  مطلوب  ',
                'link_img.required' => 'رابط الصورة   مطلوب  ',
                'wholesale_price.required' => 'سعر الجملة    مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'name_en' => $name_en,
                    'link_img' => $link_img,
                    'safety_stocks' => $safety_stocks,
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
               $item->safety_stocks = $safety_stocks;
               $item->pricing_price = $pricing_price;
               $item->final_price = $final_price;
               $item->cost_price = $cost_price;
               $item->wholesale_price = $wholesale_price;
               $item->barcode = $barcode;

               $item->manufacture_company_id = $manufacture_company_id;
               $item->unit_id = $unit_id;
               $item->size= $size;
               $item->type_category_id = $type_category_id;

               //save company id
               $item->company_id = Auth::user()->company_id;


               if ($request->hasFile('img') != null) {
                $item->img = $input['imagename'];
                }



               $saved = $item->save();
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
    //                                          update function
    //************************************************************************************************************
    public function update(Request $request)
    {
        $hidden = $request->get('hidden');
        if ($hidden != 0) {
            $name_ar=$request->get('name_ar');
            $name_en=$request->get('name_en');
            $link_img=$request->get('link_img');
            $safety_stocks=$request->get('safety_stocks');
            $pricing_price=$request->get('pricing_price');
            $final_price=$request->get('final_price');
            $wholesale_price=$request->get('wholesale_price');
            $cost_price=$request->get('cost_price');
            $manufacture_company_id=$request->get('manufacture_company_id');
            $unit_id=$request->get('unit_id');
            $size=$request->get('size');
            $type_category_id=$request->get('type_category_id');
            $barcode=$request->get('barcode');



            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'cost_price' => 'required',
                'safety_stocks' => 'required',
                'pricing_price' => 'required',
                'final_price' => 'required',
                'wholesale_price' => 'required',
                'link_img' => 'required',
                'wholesale_price'=>'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'name_en.required' => 'اسم التصنيف مطلوب  ',
                'cost_price.required' => 'سعر التكلفة   مطلوب  ',
                'safety_stocks.required' => 'مخزون الامان  مطلوب  ',
                'pricing_price.required' => 'سعر التسعيرة  مطلوب  ',
                'final_price.required' => 'السعر النهائي  مطلوب  ',
                'link_img.required' => 'رابط الصورة   مطلوب  ',
                'wholesale_price.required' => 'سعر الجملة    مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'name_en' => $name_en,
                    'link_img' => $link_img,
                    'safety_stocks' => $safety_stocks,
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
               $item->safety_stocks = $safety_stocks;
               $item->pricing_price = $pricing_price;
               $item->final_price = $final_price;
               $item->cost_price = $cost_price;
               $item->wholesale_price = $wholesale_price;
               $item->barcode = $barcode;

               $item->manufacture_company_id = $manufacture_company_id;
               $item->unit_id = $unit_id;
               $item->size= $size;
               $item->type_category_id = $type_category_id;

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
}
