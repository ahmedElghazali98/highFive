<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\customer as MyModel;
use App\Models\system_constants;
use App\Models\employees;
use Illuminate\Support\Facades\Auth;


class customerController extends  AdminController
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
        $data['customers'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['customers'] = $data['customers']->where('email', $name)->orWhere('email', 'like', '%' .  $name . '%');
        }

        $data['customers'] = $data['customers']->paginate(8);

        //get system constants
        $data['price_categories']=system_constants::where('company_id',Auth::user()->company_id)->where('type','price_category')->where('status','1')->orderBy('id', 'desc')->get();
        $data['cities']=system_constants::where('company_id',Auth::user()->company_id)->where('type','city')->where('status','1')->orderBy('id', 'desc')->get();
        $data['employees']=employees::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return view('admin.customers.table-data', compact('data'))->render();
        }
        return view('admin.customers.index', compact('data'));
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
            $email=$request->get('email');
            $mobile=$request->get('mobile');
            $tel=$request->get('tel');
            $delegate_id=$request->get('delegate_id');
            $price_category_id=$request->get('price_category_id');
            $city_id=$request->get('city_id');
            $area=$request->get('area');
            $full_address=$request->get('full_address');




            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required',
                'tel' => 'required',
                'mobile' => 'required',
                'area' => 'required',
                'full_address' => 'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'name_en.required' => 'اسم التصنيف مطلوب  ',
                'email.required' => 'البريد الالكترونى  مطلوب  ',
                'tel.required' => 'الهاتف  مطلوب  ',
                'mobile.required' => 'الجوال  مطلوب  ',
                'area.required' => 'المنطقة  مطلوب  ',
                'full_address.required' => 'العنوان الكامل  مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'name_en' => $name_en,
                    'email' => $email,
                    'tel' => $tel,
                    'mobile' => $mobile,
                    'area' => $area,
                    'full_address' => $full_address,


                ],
                $rules,
                $messages
            );

            //cheack unique filed
            $unique_email= MyModel::where('company_id',Auth::user()->company_id)->where('email',$email)->orderBy('id', 'desc')->count();
            if($unique_email>0){
                return response()->json(['status' => false, 'data' =>  __('text.email_must_be_unique') ]);

            }

            $unique_tel= MyModel::where('company_id',Auth::user()->company_id)->where('tel',$tel)->orderBy('id', 'desc')->count();
            if($unique_tel>0){
                return response()->json(['status' => false, 'data' =>  __('text.tel_must_be_unique') ]);

            }

            $unique_moblie= MyModel::where('company_id',Auth::user()->company_id)->where('mobile',$mobile)->orderBy('id', 'desc')->count();
            if($unique_moblie>0){
                return response()->json(['status' => false, 'data' =>  __('text.mobile_must_be_unique') ]);

            }



            //cheack  validator and value in select
            if ($validator->fails() || $delegate_id==-1  ||$price_category_id==-1 ||  $city_id==-1) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

               //svae price category
               $item = new MyModel();
               $item->name_ar = $name_ar;
               $item->name_en = $name_en;
               $item->email = $email;
               $item->tel = $tel;
               $item->mobile = $mobile;
               $item->area = $area;
               $item->full_address = $full_address;

               $item->delegate_id = $delegate_id;
               $item->price_category_id = $price_category_id;
               $item->city_id = $city_id;

               //save company id
               $item->company_id=Auth::user()->company_id;



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
            $email=$request->get('email');
            $mobile=$request->get('mobile');
            $tel=$request->get('tel');
            $delegate_id=$request->get('delegate_id');
            $price_category_id=$request->get('price_category_id');
            $city_id=$request->get('city_id');
            $area=$request->get('area');
            $full_address=$request->get('full_address');




            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required',
                'tel' => 'required',
                'mobile' => 'required',
                'area' => 'required',
                'full_address' => 'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم التصنيف مطلوب  ',
                'name_en.required' => 'اسم التصنيف مطلوب  ',
                'email.required' => 'البريد الالكترونى  مطلوب  ',
                'tel.required' => 'الهاتف  مطلوب  ',
                'mobile.required' => 'الجوال  مطلوب  ',
                'area.required' => 'المنطقة  مطلوب  ',
                'full_address.required' => 'العنوان الكامل  مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'name_en' => $name_en,
                    'email' => $email,
                    'tel' => $tel,
                    'mobile' => $mobile,
                    'area' => $area,
                    'full_address' => $full_address,


                ],
                $rules,
                $messages
            );

            //cheack unique filed
            $unique_email= MyModel::where('company_id',Auth::user()->company_id)->where('email',$email)->where('id','!=',$hidden)->orderBy('id', 'desc')->count();
            if($unique_email>0){
                return response()->json(['status' => false, 'data' =>  __('text.email_must_be_unique') ]);

            }

            $unique_tel= MyModel::where('company_id',Auth::user()->company_id)->where('tel',$tel)->where('id','!=',$hidden)->orderBy('id', 'desc')->count();
            if($unique_tel>0){
                return response()->json(['status' => false, 'data' =>  __('text.tel_must_be_unique') ]);

            }

            $unique_moblie= MyModel::where('company_id',Auth::user()->company_id)->where('mobile',$mobile)->where('id','!=',$hidden)->orderBy('id', 'desc')->count();
            if($unique_moblie>0){
                return response()->json(['status' => false, 'data' =>  __('text.mobile_must_be_unique') ]);

            }


           //cheack  validator and value in select
           if ($validator->fails() || $delegate_id==-1  ||$price_category_id==-1 ||  $city_id==-1) {
            return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
             }


               //update customer
               $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();
               if($item==null){
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

               }
               $item->name_ar = $name_ar;
               $item->name_en = $name_en;
               $item->email = $email;
               $item->tel = $tel;
               $item->mobile = $mobile;
               $item->area = $area;
               $item->full_address = $full_address;

               $item->delegate_id = $delegate_id;
               $item->price_category_id = $price_category_id;
               $item->city_id = $city_id;

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
        $item = MyModel::find($id);
        if ($item != '') {

            $deleted = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
}
