<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\dismantling_product as MyModel;
use Illuminate\Support\Facades\Auth;
use App\Models\item;
use App\Models\stores;
use Illuminate\Support\Facades\DB;
class dismantling_productController extends AdminController
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
        $data['dismantling_product'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['dismantling_product'] = $data['dismantling_product']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
        }

        $data['dismantling_product'] = $data['dismantling_product']->paginate(8);

        //get date in selete
        $data['items']=item::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
        $data['stores']=stores::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();



        if ($request->ajax()) {
            return view('admin.dismantling_product.table-data', compact('data'))->render();
        }
        return view('admin.dismantling_product.index', compact('data'));
    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $item_id=$request->get('item_id');
            $date=$request->get('date');
            $to_store_id=$request->get('to_store_id');


            $rules = [
                'item_id' => 'required',
                'date' => 'required',
                'to_store_id' => 'required',

            ];

            $messages = [
                'item_id.required' =>  __('text.item_id_required'),
                'date.required' =>  __('text.date_required'),
                'to_store_id.required' =>  __('text.to_store_id_required'),

            ];

            $validator = \Validator::make(
                [
                    'item_id' => $item_id,
                    'date' => $date,
                    'to_store_id'=>$to_store_id,


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
             //svae dimanting product
             $item = new MyModel();
             $item->item_id = $item_id;
             $item->date = date('Y-m-d ' ,strtotime($date));
             $item->to_store_id = $to_store_id;


             //save company id
             $item->company_id=Auth::user()->company_id;



             $saved = $item->save();
             if (!$saved) {
              return response()->json(['status' => false, 'data' => __('text.error_process')]);
          }

          DB::commit();
          return response()->json(['status' => true, 'data' => __('text.add_successful')]);

        } catch (\Exception $e) {
            DB::rollback();
        }
        return response()->json(['status' => false, 'data' => __('text.error_process')]);



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
            $date=$request->get('date');
            $to_store_id=$request->get('to_store_id');


            $rules = [
                'item_id' => 'required',
                'date' => 'required',
                'to_store_id' => 'required',

            ];

            $messages = [
                'item_id.required' =>  __('text.item_id_required'),
                'date.required' =>  __('text.date_required'),
                'to_store_id.required' =>  __('text.to_store_id_required'),

            ];

            $validator = \Validator::make(
                [
                    'item_id' => $item_id,
                    'date' => $date,
                    'to_store_id'=>$to_store_id,


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
            //update items production
            $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();
            if($item==null){
             return response()->json(['status' => false, 'data' => __('text.error_process')]);

            }
            $item->item_id = $item_id;
            $item->date = date('Y-m-d ' ,strtotime($date));
            $item->to_store_id = $to_store_id;


            $saved = $item->update();
            if (!$saved) {
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
