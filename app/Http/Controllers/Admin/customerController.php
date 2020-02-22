<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\customer as MyModel;
use App\Models\system_constants;
use App\Models\employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            $data['customers'] = $data['customers']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
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
                'mobile' => 'required|unique:customers,mobile,'.$hidden,
                'area' => 'required',
                'full_address' => 'required',
                'city_id' => 'required',
                'email' => Rule::unique('customers')->whereNotNull('email')->ignore($hidden),
                'tel' => Rule::unique('customers')->whereNotNull('tel')->ignore($hidden),
                'delegate_id'=>'required',


            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'mobile.required' =>  __('text.mobile_required'),
                'area.required' =>  __('text.area_required'),
                'full_address.required' =>  __('text.full_address_required'),
                'email.unique'=> __('text.email_must_be_unique'),
                'tel.unique'=> __('text.tel_must_be_unique'),
                'mobile.unique'=> __('text.mobile_must_be_unique'),
                'city_id.required'=>__('text.city_id_required'),
                'delegate_id.required'=>__('text.delegate_id_required'),




            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'mobile' => $mobile,
                    'area' => $area,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'tel'=>$tel,
                    'city_id'=>$city_id,
                    'full_address' => $full_address,
                    'delegate_id' => $delegate_id,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }




             $input=[
                'name_ar'=>$name_ar,
                'name_en'=>$name_en,
                'email'=>$email,
                'mobile'=>$mobile,
                'tel'=>$tel,
                'area'=>$area,
                'full_address'=>$full_address,
                'city_id'=>$city_id,
                'delegate_id' => $delegate_id,
                'price_category_id' => $price_category_id,

            ];


            //add customer
            $model = new MyModel();
            $saved = $model->add($input);

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
           $model= new MyModel();
           $item = $model->getById($id);
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
                'mobile' => 'required|unique:customers,mobile,'.$hidden,
                'area' => 'required',
                'full_address' => 'required',
                'city_id' => 'required',
                'email' => Rule::unique('customers')->whereNotNull('email')->ignore($hidden),
                'tel' => Rule::unique('customers')->whereNotNull('tel')->ignore($hidden),
                'delegate_id' => 'required',

            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'mobile.required' =>  __('text.mobile_required'),
                'area.required' =>  __('text.area_required'),
                'full_address.required' =>  __('text.full_address_required'),
                'email.unique'=> __('text.email_must_be_unique'),
                'tel.unique'=> __('text.tel_must_be_unique'),
                'mobile.unique'=> __('text.mobile_must_be_unique'),
                'city_id.required'=>__('text.city_id_required'),
                'delegate_id.required'=>__('text.delegate_id_required'),




            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'mobile' => $mobile,
                    'area' => $area,
                    'email'=>$email,
                    'mobile'=>$mobile,
                    'tel'=>$tel,
                    'city_id'=>$city_id,
                    'full_address' => $full_address,
                    'delegate_id' => $delegate_id,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }




             $input=[
                'name_ar'=>$name_ar,
                'name_en'=>$name_en,
                'email'=>$email,
                'mobile'=>$mobile,
                'tel'=>$tel,
                'area'=>$area,
                'full_address'=>$full_address,
                'city_id'=>$city_id,
                'delegate_id' => $delegate_id,
                'price_category_id' => $price_category_id,

            ];


            //add customer
            $model = new MyModel();
            $saved = $model->updateCustomer($hidden ,$input);


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
        $model =new MyModel();

            $deleted = $model->deleteCustomer($id);
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }
}
