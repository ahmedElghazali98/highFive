<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\store_bills as MyModel;
use App\Models\store_bills_details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\suppliers;
use App\Models\stores;
use App\Models\system_constants;
use App\Models\store_item_transaction_log;
use App\Models\User;
use Session;
class store_billsController extends AdminController
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
         $data['store_bills'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
         if ($name != '') {
             $data['store_bills'] = $data['store_bills']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
         }

         $data['store_bills'] = $data['store_bills']->paginate(8);

         //get data in selete
         $data['suppliers'] = suppliers::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
         $data['stores'] = stores::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
         $data['type_bill']=system_constants::where('company_id',Auth::user()->company_id)->where('type','type_bill')->where('status','1')->orderBy('id', 'desc')->get();

         //get lenght of search
        $system_variables=  session()->get('system_variables');
        $data['length_search']=0;

        if (is_array($system_variables) || is_object($system_variables)){
        foreach($system_variables as $s){
            if($s->index=='length_search'){
                $data['length_search']=$s->value;
            break;

            }

        }
    }



        if ($request->ajax()) {
            return view('admin.store_bills.table-data', compact('data'))->render();
        }
        return view('admin.store_bills.index', compact('data'));
    }

       /***********************************************************************************************************************/
       public function add(Request $request)
       {
           $hidden = $request->get('hidden');
           if ($hidden == 0) {
               $store_id = $request->get('store_id');
               $statement = $request->get('statement');
               $type_id = $request->get('type_id');
               $supplier_id = $request->get('supplier_id');
               $discount = $request->get('discount');

               $id_itemsArray=$request->get('id_items');
               $quantitys=$request->get('quantity');
               $price=$request->get('price');


               $rules = [
                'store_id' => 'required',
                'statement' => 'required',
                'type_id' => 'required',
                'supplier_id' => 'required',
                'id_itemsArray' => 'required',

                    ];

            $messages = [
                'store_id.required' =>  __('text.store_id_required'),
                'statement.required' =>  __('text.statement_required'),
                'type_id.required' =>  __('text.type_id_required'),
                'supplier_id.required' =>  __('text.supplier_id_required'),
                'id_itemsArray.required' =>  __('text.must_chosess_last_one_item'),

            ];

            $validator = \Validator::make(
                [
                    'store_id' => $store_id,
                    'statement' => $statement,
                    'type_id' => $type_id,
                    'supplier_id' => $supplier_id,
                    'id_itemsArray'=>$id_itemsArray,
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
                'store_id' => $store_id,
                'statement' => $statement,
                'type_id' => $type_id,
                'supplier_id' => $supplier_id,
                'discount' => $discount,
                'id_itemsArray' => $id_itemsArray,
                'quantity' => $quantitys,
                'price' => $price,

                        ];

            //call the function
            $model = new MyModel();
            $saved= $model->add($input);


            if (!$saved) {
             return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }

          return response()->json(['status' => true, 'data' => __('text.add_successful')]);


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

           $store_bill = $model->getById($id);

           if ($store_bill != '') {
               // get store_bill_deltes
               $store_bills_details=  store_bills_details::where('bill_id',$store_bill->id)->get();
               $item= item::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

               return response()->json(['status' => true,
               'store_bill' => $store_bill,
               'store_bills_details'=>$store_bills_details,
               'item'=>$item


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

            $store_id = $request->get('store_id');
            $statement = $request->get('statement');
            $type_id = $request->get('type_id');
            $supplier_id = $request->get('supplier_id');
            $discount = $request->get('discount');

            $id_itemsArray=$request->get('id_items');
            $quantitys=$request->get('quantity');
            $price=$request->get('price');


            $rules = [
             'store_id' => 'required',
             'statement' => 'required',
             'type_id' => 'required',
             'supplier_id' => 'required',
             'id_itemsArray' => 'required',

                 ];

         $messages = [
             'store_id.required' =>  __('text.store_id_required'),
             'statement.required' =>  __('text.statement_required'),
             'type_id.required' =>  __('text.type_id_required'),
             'supplier_id.required' =>  __('text.supplier_id_required'),
             'id_itemsArray.required' =>  __('text.must_chosess_last_one_item'),

         ];

         $validator = \Validator::make(
             [
                 'store_id' => $store_id,
                 'statement' => $statement,
                 'type_id' => $type_id,
                 'supplier_id' => $supplier_id,
                 'id_itemsArray'=>$id_itemsArray,
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
             'store_id' => $store_id,
             'statement' => $statement,
             'type_id' => $type_id,
             'supplier_id' => $supplier_id,
             'discount' => $discount,
             'id_itemsArray' => $id_itemsArray,
             'quantity' => $quantitys,
             'price' => $price,

                     ];



            //call the function
            $model = new MyModel();
            $updated= $model->updateStore_bills($hidden ,$input);


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
        $deleted=$model->deleteStore_bills($id);


            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);

    }

      //************************************************************************************************************
    //                                          get_log function
    //************************************************************************************************************
    public function get_log(Request $request){
        $id = $request->get('id');
        $log = store_item_transaction_log::where('transaction_id',$id)->orderBy('id', 'desc')->get();

        $output=[];
        foreach($log as $l){
            $user=User::find($l->user_id);
            $store=stores::find($l->store_id);
            $item=item::find($l->item_id);

            $array=[
                'price'=>$l->price,
                'quantity'=>$l->quantity,
                'user'=>$user->username,
                'store'=>$store->name_ar,
                'item'=>$item->name_ar,
                'date'=>date('Y-m-d ' ,strtotime($l->created_at)),
            ];
            array_push($output,$array);

        }
        if(count($log)>0){
            return response()->json(['status' => true,
            'log' => $log ,
            'output'=>$output,
            ]);

        } else{
            return response()->json(['status' => false, 'data' => __('text.error_process')]);

        }


    }

}
