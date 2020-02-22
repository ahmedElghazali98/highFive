<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\stores as MyModel;
use App\Models\system_constants;
use App\Models\employees;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\storesExport;
use Illuminate\Support\Facades\DB;


class storesController  extends  AdminController
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
        $data['stores'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['stores'] = $data['stores']->where('name_ar', $name)->orWhere('name_ar', 'like', '%' .  $name . '%');
        }

        $data['stores'] = $data['stores']->paginate(8);

        //get system constants
        $data['cities']=system_constants::where('company_id',Auth::user()->company_id)->where('type','city')->where('status','1')->orderBy('id', 'desc')->get();
        $data['employees']=employees::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            return view('admin.stores.table-data', compact('data'))->render();
        }
        return view('admin.stores.index', compact('data'));
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
            $tel=$request->get('tel');
            $storekeeper_id=$request->get('storekeeper_id');
            $city_id=$request->get('city_id');
            $area=$request->get('area');
            $full_address=$request->get('full_address');

            $rules = [
                'name_ar' => 'required',
                'tel' => 'required|unique:stores',
                'area' => 'required',
                'full_address' => 'required',
                'storekeeper_id'=>'required',
                'city_id'=>'required',



            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'tel.required' =>  __('text.tel_required'),
                'full_address.required' =>  __('text.full_address_required'),
                'tel.unique'=> __('text.tel_must_be_unique'),
                'storekeeper_id.required'=> __('text.storekeeper_id_required'),
                'city_id.required'=> __('text.city_id_required'),
                'area.required'=> __('text.area_required'),

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'tel' => $tel,
                    'full_address'=>$full_address,
                    'area'=>$area,
                    'storekeeper_id'=>$storekeeper_id,
                    'city_id'=>$city_id,


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
                'tel'=>$tel,
                'area'=>$area,
                'full_address'=>$full_address,
                'city_id'=>$city_id,
                'storekeeper_id' => $storekeeper_id,
            ];


            //add stores
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
           $model = new MyModel();
           $item =$model->getById($id);
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
            $tel=$request->get('tel');
            $storekeeper_id=$request->get('storekeeper_id');
            $city_id=$request->get('city_id');
            $area=$request->get('area');
            $full_address=$request->get('full_address');

            $rules = [
                'name_ar' => 'required',
                'tel' => 'required|unique:stores,tel,'.$hidden,
                'area' => 'required',
                'full_address' => 'required',
                'storekeeper_id'=>'required',
                'city_id'=>'required',



            ];

            $messages = [
                'name_ar.required' =>  __('text.name_ar_required'),
                'tel.required' =>  __('text.tel_required'),
                'full_address.required' =>  __('text.full_address_required'),
                'tel.unique'=> __('text.tel_must_be_unique'),
                'storekeeper_id.required'=> __('text.storekeeper_id_required'),
                'city_id.required'=> __('text.city_id_required'),

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $name_ar,
                    'tel' => $tel,
                    'full_address'=>$full_address,
                    'area'=>$area,
                    'storekeeper_id'=>$storekeeper_id,
                    'city_id'=>$city_id,


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
                'tel'=>$tel,
                'area'=>$area,
                'full_address'=>$full_address,
                'city_id'=>$city_id,
                'storekeeper_id' => $storekeeper_id,
            ];


            //add stores
            $model = new MyModel();
            $saved = $model->updateStores($hidden, $input);


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
        $deleted = $model->deleteStores($id);

            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }
  //************************************************************************************************************
    //                                          export stores to excel function
    //************************************************************************************************************
    public function export()
    {
        return Excel::download(new storesExport, 'stores.xls');
    }


}

