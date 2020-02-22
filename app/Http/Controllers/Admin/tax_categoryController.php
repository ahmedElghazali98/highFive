<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tax_category as MyModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class tax_categoryController extends AdminController
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
         $data['tax_category'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
         if ($name != '') {
             $data['tax_category'] = $data['tax_category']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
         }

         $data['tax_category'] = $data['tax_category']->paginate(8);

        if ($request->ajax()) {
            return view('admin.tax_category.table-data', compact('data'))->render();
        }
        return view('admin.tax_category.index', compact('data'));
    }

       /***********************************************************************************************************************/
       public function add(Request $request)
       {
           $hidden = $request->get('hidden');
           if ($hidden == 0) {
               $name = $request->get('name');


               $rules = [
                'name' => 'required',
                    ];

            $messages = [
                'name.required' =>  __('text.name_required'),

            ];

            $validator = \Validator::make(
                [
                    'name' => $name,

                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }


            DB::beginTransaction();
        try {

            //save all input to array
            $input =[
                'name'=>$name,
            ];

            //call the function
            $model = new MyModel();
            $saved= $model->add($input);

            if (!$saved) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }

          DB::commit();
          return response()->json(['status' => true, 'data' => __('text.add_successful')]);

        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => __('text.error_process')]);

           } else {
            return response()->json(['status' => false, 'data1' => __('text.error_process')]);
        }
       }
       /***********************************************************************************************************************/

       public function edit(Request $request)
       {
           $id = $request->get('id');

             //call the function
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

            $name=$request->get('name');




            $rules = [
                'name' => 'required',
                    ];

            $messages = [
                'name.required' =>  __('text.name_required'),

            ];

            $validator = \Validator::make(
                [
                    'name' => $name,

                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }





              //save all input to array
              $input =[
                'name'=>$name,
            ];


             DB::beginTransaction();
        try {

            //call the function
            $model = new MyModel();
            $updated= $model->updateTax_category($hidden ,$input);


               if (!$updated) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
               }

          DB::commit();
          return response()->json(['status' => true, 'data' => __('text.update_successful')]);

        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => __('text.error_process')]);



            }else{
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

            }
    }

       /****************************************************************************************************************************************** */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $model = new MyModel();
        $deleted=$model->deleteTax_category($id);

            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.unable_to_delete')]);
            }

            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }

}
