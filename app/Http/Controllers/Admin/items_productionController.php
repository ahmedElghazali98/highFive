<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\items_production as MyModel;
use Illuminate\Support\Facades\Auth;
use App\Models\system_constants;
use App\Models\item;
use App\Models\items_production;
use App\Models\stores;
use Illuminate\Support\Facades\DB;
class items_productionController extends AdminController
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
        $data['items_production'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['items_production'] = $data['items_production']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
        }

        $data['items_production'] = $data['items_production']->paginate(8);

        //get system constants

        $data['stores']=stores::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
        $data['items']=item::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();



        if ($request->ajax()) {
            return view('admin.items_production.table-data', compact('data'))->render();
        }
        return view('admin.items_production.index', compact('data'));
    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $item_id=$request->get('item_id');
            $store_id=$request->get('store_id');
            $quantity=$request->get('quantity');
            $date=$request->get('date');


		   $rules = [
                'item_id' => 'required',
                'store_id' => 'required',
                'quantity' => 'required',
                'date' => 'required',

            ];

            $messages = [
                'item_id.required' =>  __('text.item_id_required'),
                'store_id.required' =>  __('text.store_id_required'),
                'quantity.required' =>  __('text.quantity_required'),
                'date.required'=> __('text.date_required'),

            ];

            $validator = \Validator::make(
                [
                    'item_id' => $item_id,
                    'store_id' => $store_id,
                    'quantity'=>$quantity,
                    'date'=>$date,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

             $input=[
                 'item_id'=>$item_id,
                 'store_id'=>$store_id,
                 'quantity'=>$quantity,
                 'date'=>$date,

             ];

              $item = new MyModel();
              $saved=$item->add($input);

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
           $item_peoduction = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
           $item=item::find($item_peoduction->item_id);

           if ($item_peoduction != '') {
               return response()->json(['status' => true, 'data' => $item_peoduction ,'item'=>$item]);
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

            $item_id=$request->get('item_id');
            $store_id=$request->get('store_id');
            $quantity=$request->get('quantity');
            $date=$request->get('date');



            $rules = [
                'item_id' => 'required',
                'store_id' => 'required',
                'quantity' => 'required',
                'date' => 'required',

            ];

            $messages = [
                'item_id.required' =>  __('text.item_id_required'),
                'store_id.required' =>  __('text.store_id_required'),
                'quantity.required' =>  __('text.quantity_required'),
                'date.required'=> __('text.date_required'),

            ];

            $validator = \Validator::make(
                [
                    'item_id' => $item_id,
                    'store_id' => $store_id,
                    'quantity'=>$quantity,
                    'date'=>$date,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

             $input=[
                'item_id'=>$item_id,
                'store_id'=>$store_id,
                'quantity'=>$quantity,
                'date'=>$date,

            ];

               //update items production
               $items_production= new items_production();
               $saved=$items_production->updateItems_production($hidden,$input);

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

            $deleted =$item->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
}
