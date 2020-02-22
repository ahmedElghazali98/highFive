<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\store_item as MyModel;
use Illuminate\Support\Facades\Auth;
use App\Models\stores;

class store_itemController extends AdminController
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
         $data['store_items'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
         $store=stores::where('name_ar','like', '%' .  $name . '%')->orWhere('name_en','like', '%' .  $name . '%')->first();
         if ($name != '' && $store) {
             $data['store_items'] = $data['store_items']->where('store_id', $store->id);
         }

         $data['store_items'] = $data['store_items']->paginate(8);

         $data['stores'] = stores::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();



        if ($request->ajax()) {
            return view('admin.store_item.table-data', compact('data'))->render();
        }
        return view('admin.store_item.index', compact('data'));
    }

       /***********************************************************************************************************************/
       public function add(Request $request)
       {
           $hidden = $request->get('hidden');
           if ($hidden == 0) {
               $name = $request->get('name');
               $store_id = $request->get('store_id');
               $item_id = $request->get('item_id');
               $quantity = $request->get('quantity');
               $min_quantity = $request->get('min_quantity');
               $max_quantity = $request->get('max_quantity');

               $rules = [
                'store_id' => 'required',
                'item_id' => 'required',
                'quantity' => 'required',
                'min_quantity' => 'required',
                'max_quantity' => 'required',

                    ];

            $messages = [
                'store_id.required' =>  __('text.store_id_required'),
                'item_id.required' =>  __('text.item_id_required'),
                'quantity.required' =>  __('text.quantity_required'),
                'min_quantity.required' =>  __('text.min_quantity_required'),
                'max_quantity.required' =>  __('text.max_quantity_required'),

            ];

            $validator = \Validator::make(
                [
                    'store_id' => $store_id,
                    'item_id' => $item_id,
                    'quantity' => $quantity,
                    'min_quantity' => $min_quantity,
                    'max_quantity' => $max_quantity,

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
                'store_id'=>$store_id,
                'item_id'=>$item_id,
                'quantity'=>$quantity,
                'min_quantity'=>$min_quantity,
                'max_quantity'=>$max_quantity,

            ];

            //call the function
            $model = new MyModel();
            $saved= $model->add($input);
            if (!$saved) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }

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
             $store= new stores();
             $item = new item();


           $store_item = $model->getById($id);
           $store=$store->getById($store_item->store_id);
           $item=$item->getById($store_item->item_id);


           if ($store_item != '') {
               return response()->json(['status' => true,
               'data' => $store_item ,
               'store'=>$store,
               'item'=>$item,
               ]);
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

            $min_quantity=$request->get('min_quantity');
            $max_quantity=$request->get('max_quantity');

            $rules = [
                'min_quantity' => 'required',
                'max_quantity' => 'required',

                    ];

            $messages = [
                'min_quantity.required' =>  __('text.min_quantity_required'),
                'max_quantity.required' =>  __('text.max_quantity_required'),

            ];

            $validator = \Validator::make(
                [
                    'min_quantity' => $min_quantity,
                    'max_quantity' => $max_quantity,

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
                'min_quantity'=>$min_quantity,
                'max_quantity'=>$max_quantity,

            ];


            //call the function
            $model = new MyModel();
            $updated= $model->updateStore_item($hidden ,$input);


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
        $deleted=$model->deleteStore_item($id);

            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }
}
