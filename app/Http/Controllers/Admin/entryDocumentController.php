<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\entryDocument as MyModel;
use App\Models\system_constants;
use App\Models\suppliers;
use App\Models\categoty;
use App\Models\items_entry_documents;
class entryDocumentController  extends  AdminController
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
        $data['entry_documents'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['entry_documents'] = $data['entry_documents']->where('email', $name)->orWhere('email', 'like', '%' .  $name . '%');
        }

        $data['entry_documents'] = $data['entry_documents']->paginate(8);

        //get  suppliers
        $data['suppliers']=suppliers::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

        //get category
        $data['categoties']=categoty::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();


        if ($request->ajax()) {
            return view('admin.entry_documents.table-data', compact('data'))->render();
        }
        return view('admin.entry_documents.index', compact('data'));
    }
   //************************************************************************************************************
    //                                          search Item function
    //************************************************************************************************************
    public function searchItem(Request $request){

        $name = $request->get('name');

        $categoty = categoty::where('company_id',Auth::user()->company_id)->where('name_ar',$name)->orderBy('id', 'desc')->first();
        if ($categoty != '') {
            return response()->json(['status' => true, 'data' => $categoty]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }

    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $supplier_id=$request->get('supplier_id');
            $date=$request->get('date');
            $document=$request->get('document');

            $id_itemsArray=$request->get('id_items');
            $quantitys=$request->get('quantity');
            $prices=$request->get('price');


            $rules = [
                'date' => 'required',
                'document' => 'required',

            ];

            $messages = [
                'date.required' => 'اسم التصنيف مطلوب  ',
                'document.required' => 'البيان  مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'date' => $date,
                    'document' => $document,
                ],
                $rules,
                $messages
            );



           //cheack  validator and value in select
           if ($validator->fails() || $supplier_id==-1 ) {
            return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
             }



               //svae entry document
               $item = new MyModel();
               $item->supplier_id = $supplier_id;
               $item->date = date('Y-m-d ' ,strtotime($date));
               $item->document = $document;
               $item->company_id =Auth::user()->company_id ;

               $saved = $item->save();

               //save items_entry_documents

               $length = count($id_itemsArray);
               for($i=0 ; $i<$length ;++$i){

                   //find category and set the value of quantity
                   $c =categoty::find($id_itemsArray[$i]);
                    $newValeOfQuantity =($c->quantity)+ $quantitys[$i];
                    $c->quantity=$newValeOfQuantity;
                    $c->update();


                   $items_entry_documents = new items_entry_documents();
                   $items_entry_documents->category_id=$id_itemsArray[$i];
                   $items_entry_documents->quantity=$quantitys[$i];
                   $items_entry_documents->entry_document_id=$item->id;
                   $items_entry_documents->price=$prices[$i];
                   $items_entry_documents->save();

               }


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
           $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
           $items_entry_doc=items_entry_documents::where('entry_document_id',$id)->get();
           $categoty=categoty::where('company_id',Auth::user()->company_id)->get();
           if ($item != '') {
               return response()->json(['status' => true, 'data' => $item  , 'item'=>$items_entry_doc , 'categoty'=>$categoty]);

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

            $supplier_id=$request->get('supplier_id');
            $date=$request->get('date');
            $document=$request->get('document');
            $id_itemsArray=$request->get('id_items');
            $quantitys=$request->get('quantity');
            $prices=$request->get('price');




            $rules = [
                'date' => 'required',
                'document' => 'required',

            ];

            $messages = [
                'date.required' => 'اسم التصنيف مطلوب  ',
                'document.required' => 'البيان  مطلوب  ',


            ];

            $validator = \Validator::make(
                [
                    'date' => $date,
                    'document' => $document,
                ],
                $rules,
                $messages
            );



           //cheack  validator and value in select
           if ($validator->fails() || $supplier_id==-1 ) {
            return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
             }


               //update entry document
               $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();

               //remove all item in entry document and return the quantitys to categorty
               foreach($item->allItems as $i){

                $c =categoty::find($i->category_id);
                $newValeOfQuantity =0;
                $c->quantity=$newValeOfQuantity;
                $c->update();

                $i->delete();
                 }

                 //save items_entry_documents
               $length = count($id_itemsArray);
               for($i=0 ; $i<$length ;++$i){

                //find category and set the value of quantity
                    $c =categoty::find($id_itemsArray[$i]);
                    $newValeOfQuantity =($c->quantity)+ $quantitys[$i];
                    $c->quantity=$newValeOfQuantity;
                    $c->update();

                   $items_entry_documents = new items_entry_documents();
                   $items_entry_documents->category_id=$id_itemsArray[$i];
                   $items_entry_documents->quantity=$quantitys[$i];
                   $items_entry_documents->entry_document_id=$item->id;
                   $items_entry_documents->price=$prices[$i];
                   $items_entry_documents->save();

               }

               if($item==null){
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

               }
               $item->supplier_id = $supplier_id;
               $item->date = date('Y-m-d ' ,strtotime($date));
               $item->document = $document;
               $item->company_id =Auth::user()->company_id ;

               $saved = $item->save();
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
            foreach($item->allItems as $i){
                $c =categoty::find($i->category_id);
                $c->quantity=$c->quantity - ($i->quantity);
                $c->update();
                $i->delete();
                $deleted =$item->delete();
            }
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
}
