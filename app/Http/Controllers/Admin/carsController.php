<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\cars as MyModel;
use App\Models\system_constants;
use Illuminate\Support\Facades\Auth;
use App\Models\employees;
use Illuminate\Support\Facades\DB;
class carsController extends  AdminController
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
        $data['cars'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['cars'] = $data['cars']->where('car_number', $name)->orWhere('car_number', 'like', '%' .  $name . '%');
        }

        $data['cars'] = $data['cars']->paginate(8);

        //get system constants
        $data['car_colors']=system_constants::where('company_id',Auth::user()->company_id)->where('type','color_car')->where('status','1')->orderBy('id', 'desc')->get();
        $data['car_type']=system_constants::where('company_id',Auth::user()->company_id)->where('type','type_car')->where('status','1')->orderBy('id', 'desc')->get();
        $data['employees']=employees::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return view('admin.cars.table-data', compact('data'))->render();
        }
        return view('admin.cars.index', compact('data'));
    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $name_ar=$request->get('name_ar');
            $type_id=$request->get('type_id');
            $color_id=$request->get('color_id');
            $car_number=$request->get('car_number');
            $driver_id=$request->get('driver_id');
            $manufacturing_year=$request->get('manufacturing_year');


            $rules = [
                'name_ar' => 'required',
                'car_number' => 'required|unique:cars',
                'driver_id' => 'required',

            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'car_number.required' =>  __('text.car_number_required'),
                'driver_id.required' =>  __('text.driver_id_required'),
                'car_number.unique'=> __('text.car_number_must_be_unique'),

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'car_number' => $car_number,
                    'driver_id'=>$driver_id,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

             //save all input in array
             $input=[
                'name_ar' => $name_ar,
                'car_number' => $car_number,
                'driver_id'=>$driver_id,
                'type_id'=>$type_id,
                'color_id'=>$color_id,
                'manufacturing_year'=>$manufacturing_year,

             ];


             $model= new MyModel();

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
           $model = new MyModel();
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
            $type_id=$request->get('type_id');
            $color_id=$request->get('color_id');
            $car_number=$request->get('car_number');
            $driver_id=$request->get('driver_id');
            $manufacturing_year=$request->get('manufacturing_year');



            $rules = [
                'name_ar' => 'required',
                'car_number' => 'required|unique:cars,car_number,'.$hidden,
                'driver_id' => 'required',

            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'car_number.required' =>  __('text.car_number_required'),
                'driver_id.required' =>  __('text.driver_id_required'),
                'car_number.unique'=> __('text.car_number_must_be_unique'),

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'car_number' => $car_number,
                    'driver_id'=>$driver_id,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

            //save all input in array
            $input=[
                'name_ar' => $name_ar,
                'car_number' => $car_number,
                'driver_id'=>$driver_id,
                'type_id'=>$type_id,
                'color_id'=>$color_id,
                'manufacturing_year'=>$manufacturing_year,

            ];



            $model= new MyModel();
            $saved = $model->updateCars($hidden,$input);

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
        $model = new MyModel();
        $item = MyModel::find($id);
            $count=count($model->getById($id)->movements);
            if($count>0){
                return response()->json(['status' => false, 'data' => __('text.not_be_delete')]);

            }else{

            $deleted = $model->deleteCars($id);

            }
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }
}
