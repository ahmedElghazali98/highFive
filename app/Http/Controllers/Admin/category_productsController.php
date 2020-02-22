<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\category_product as MyModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class category_productsController extends AdminController
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
         $data['category_products'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
         if ($name != '') {
             $data['category_products'] = $data['category_products']->where('email', $name)->orWhere('email', 'like', '%' .  $name . '%');
         }

         $data['category_products'] = $data['category_products']->paginate(8);


        if ($request->ajax()) {
            return view('admin.category_products.table-data', compact('data'))->render();
        }
        return view('admin.category_products.index', compact('data'));
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


             $input=[
                'name'=>$name,

            ];


            //add
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
       /***********************************************************************************************************************/

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

             $input=[
                'name'=>$name,


            ];


            //update
            $model = new MyModel();
            $saved = $model->updatecategory_product($hidden,$input);


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

            $deleted =$model->deletecategory_product($id);
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }

}
