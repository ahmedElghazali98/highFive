<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\taxes as MyModel;
use Illuminate\Support\Facades\Auth;
use App\Models\tax_category;
use Illuminate\Support\Facades\DB;
class taxesController extends AdminController
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
         $data['taxes'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
         if ($name != '') {
             $data['taxes'] = $data['taxes']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
         }

         $data['taxes'] = $data['taxes']->paginate(8);

         $data['tax_categories'] = tax_category::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();


        if ($request->ajax()) {
            return view('admin.taxes.table-data', compact('data'))->render();
        }
        return view('admin.taxes.index', compact('data'));
    }

       /***********************************************************************************************************************/
       public function add(Request $request)
       {
           $hidden = $request->get('hidden');
           if ($hidden == 0) {
               $name = $request->get('name');
               $rate = $request->get('rate');
               $category_id = $request->get('category_id');


               $rules = [
                'name' => 'required',
                'category_id' => 'required',
                'rate' => 'required',


                    ];

            $messages = [
                'name.required' =>  __('text.name_required'),
                'category_id.required' =>  __('text.category_id_required'),
                'rate.required' =>  __('text.rate_required'),

            ];

            $validator = \Validator::make(
                [
                    'name' => $name,
                    'category_id' => $category_id,
                    'rate' => $rate,


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
                'category_id'=>$category_id,
                'rate'=>$rate,

            ];

            //call the function
            $model = new MyModel();
            $saved= $model->add($input);

            if (!$saved) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }

          return response()->json(['status' => true, 'data' => __('text.add_successful')]);


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
            $rate = $request->get('rate');
            $category_id = $request->get('category_id');


            $rules = [
             'name' => 'required',
             'category_id' => 'required',
             'rate' => 'required',


                 ];

         $messages = [
             'name.required' =>  __('text.name_required'),
             'category_id.required' =>  __('text.category_id_required'),
             'rate.required' =>  __('text.rate_required'),

         ];

         $validator = \Validator::make(
             [
                 'name' => $name,
                 'category_id' => $category_id,
                 'rate' => $rate,


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
                'category_id'=>$category_id,
                'rate'=>$rate,

            ];


            //call the function
            $model = new MyModel();
            $updated= $model->updateTaxes($hidden ,$input);


               if (!$updated) {
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
        $deleted=$model->deleteTax_category($id);


            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }

}
