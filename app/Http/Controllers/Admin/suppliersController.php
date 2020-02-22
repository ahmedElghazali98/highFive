<?php

namespace App\Http\Controllers\Admin;
use App\Models\suppliers as MyModel;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\system_constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class suppliersController extends AdminController
{
    //


    public function __construct()
    {

    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {

        //search using name
        $name  = $request->get('name');
        $data['suppliers'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['suppliers'] = $data['suppliers']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
        }

        $data['suppliers'] = $data['suppliers']->paginate(8);

        //get system constants
        $data['cities']=system_constants::where('company_id',Auth::user()->company_id)->where('type','city')->where('status','1')->orderBy('id', 'desc')->get();


        if ($request->ajax()) {
            return view('admin.suppliers.table-data', compact('data'))->render();
        }
        return view('admin.suppliers.index', compact('data'));
    }


     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
    {


        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $email = $request->get('email');
            $mobile = $request->get('mobile');
            $tel = $request->get('tel');

         // get address
         $area = $request->get('area');
         $city_id = $request->get('city_id');
         $full_address = $request->get('full_address');




         $rules = [
             'name_ar' => 'required',
             'mobile' => 'required|unique:employees',
             'area' => 'required',
             'full_address' => 'required',
             'city_id' => 'required',
             'email' => Rule::unique('employees')->whereNotNull('email'),
             'tel' => Rule::unique('employees')->whereNotNull('tel'),

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


             ],
             $rules,
             $messages
         );


          //cheack  validator
        if ($validator->fails() ) {
         return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
          }

          //save to input array

          $input=[
              'name_ar'=>$name_ar,
              'name_en'=>$name_en,
              'email'=>$email,
              'mobile'=>$mobile,
              'tel'=>$tel,
              'area'=>$area,
              'full_address'=>$full_address,
              'city_id'=>$city_id,


          ];


          //svae employees
          $model = new MyModel();
          $saved = $model->add($input);

          if (!$saved) {
           return response()->json(['status' => false, 'data' => __('text.error_process')]);
          }

       return response()->json(['status' => true, 'data' => __('text.add_successful')]);


        } else {
         return response()->json(['status' => false, 'data' => __('text.error_process')]);
     }
    }
//************************************************************************************************************
 //                                          edit function
 //************************************************************************************************************
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $model = new MyModel();

        $item = $model->getByid($id);

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
         $city_id=$request->get('city_id');
         $area=$request->get('area');
         $full_address=$request->get('full_address');




         $rules = [
             'name_ar' => 'required',
             'mobile' => 'required|unique:employees,mobile,'.$hidden,
             'area' => 'required',
             'full_address' => 'required',
             'city_id' => 'required',
             'email' => Rule::unique('employees')->whereNotNull('email')->ignore($hidden),
             'tel' => Rule::unique('employees')->whereNotNull('tel')->ignore($hidden),

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


         ];


         //updateSuppliers
         $model = new MyModel();
         $saved = $model->updateSuppliers($hidden,$input);

            if (!$saved) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }

            return response()->json(['status' => true, 'data' => __('text.update_successful')]);

         }else{
             return response()->json(['status' => false, 'data' => __('text.error_process')]);

         }
 }

    /****************************************************************************************************************************************** */
 public function delete(Request $request)
 {
     $id = $request->get('id');
     $model = new MyModel();

         $deleted = $model->deleteSuppliers($id);
         if (!$deleted) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
         }
         return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

 }

}
