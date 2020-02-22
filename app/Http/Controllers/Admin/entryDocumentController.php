<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\entryDocument as MyModel;
use App\Models\suppliers;
use App\Models\item;
use App\Models\items_entry_documents;

use Illuminate\Support\Facades\DB;
use PDF;
use Elibyy\TCPDF\Facades\TCPDF;


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
        $data['categoties']=item::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();


        if ($request->ajax()) {
            return view('admin.entry_documents.table-data', compact('data'))->render();
        }
        return view('admin.entry_documents.index', compact('data'));
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
                'supplier_id' => 'required',
                'date' => 'required',
                'document' => 'required',

            ];

            $messages = [
                'date.required' => __('text.date_required'),
                'document.required' => __('text.document_required'),
                'document.required' => __('text.document_required'),


            ];

            $validator = \Validator::make(
                [
                    'date' => $date,
                    'document' => $document,
                ],
                $rules,
                $messages
            );



           //cheack  validator
           if ($validator->fails()) {
            return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
             }

         //start DB transaction
        DB::beginTransaction();
        try {
               //svae entry document
               $item = new MyModel();
               $item->supplier_id = $supplier_id;
               $item->date = date('Y-m-d ' ,strtotime($date));
               $item->document = $document;
               $item->company_id =Auth::user()->company_id ;

               $saved=$item->save();

               //save items_entry_documents

               $length = count($id_itemsArray);
               for($i=0 ; $i<$length ;++$i){

                   //find category and set the value of quantity
                    // $c =item::find($id_itemsArray[$i]);
                    // $newValeOfQuantity =($c->quantity)+ $quantitys[$i];
                    // $c->quantity=$newValeOfQuantity;
                    // $c->update();


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
           $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
           $items_entry_doc=items_entry_documents::where('entry_document_id',$id)->get();
           $categoty=item::where('company_id',Auth::user()->company_id)->get();
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

             //start DB transaction
             DB::beginTransaction();
             try {

               //update entry document
               $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();

               //remove all item in entry document and return the quantitys to categorty
               foreach($item->allItems as $i){

                $c =item::find($i->category_id);
                $newValeOfQuantity =0;
                $c->quantity=$newValeOfQuantity;
                $c->update();

                $i->delete();
                 }

                 //save items_entry_documents
               $length = count($id_itemsArray);
               for($i=0 ; $i<$length ;++$i){

                //find category and set the value of quantity
                    // $c =item::find($id_itemsArray[$i]);
                    // $newValeOfQuantity =($c->quantity)+ $quantitys[$i];
                    // $c->quantity=$newValeOfQuantity;
                    // $c->update();

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
            foreach($item->allItems as $i){
                $c =item::find($i->category_id);
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

 //************************************************************************************************************
    //                                          export_pdf function
    //************************************************************************************************************

    public function export_pdf($id){
        $entry_documnet = MyModel::find($id);
        $project = Projects::find($bill->project_id);
        $bill_template = Bills::find($project->bill_id);
        $data['bill'] = $bill;
        $data['service'] = $project->services;
        $main_project_service = new ProjectsServices();
        $main_project_service = $main_project_service->getProjectServices($project->id,$data['service']->id,1);
        $data['service_price'] = $main_project_service->price;
        $data['addtional_services'] = $project->additional_services_secondaty;
        $data['other_services'] = $project->other_services;
        $data['title'] = $bill_template->name;
        $tax_service = FinancialMovements::where('project_id',$project->id)->where('service_id',-1)->first();
        $data['tax'] = $tax_service->credit;

        $lg = Array();
        PDF::setRTL(true);
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';
        PDF::setLanguageArray($lg);

        PDF::setCellPadding(3);
        PDF::SetFont('arial', '', 14);
        PDF::setHeaderFont(['arial', '', '12']);
        PDF::SetHeaderMargin(5);

        PDF::SetAutoPageBreak(true,15);

        PDF::setHeaderCallback(function($pdf)  use ($bill_template){
            PDF::Image(\URL::to('/')."/uploads/".$bill_template->file, 90, 5, 40, '', 'PNG', '', 'B', false, 300, 'C', false, false, 0, false, false, false);
            $pdf->SetMargins(0, 50, 0);
        });


        // PDF::setFooterCallback(function($pdf)  use ($bill_template){
        //     $bMargin = $pdf->getBreakMargin();
        //     $pdf->SetAutoPageBreak(false, 0);
        // $img_file = \URL::to('/').'/uploads/'.$bill_template->file;

        //     $pdf->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);
        //     $pdf->setPageMark();
        // });



        $data['num'] = 1;
        $view_1 = view('admin.bill.pdf',compact('data'))->render();
        PDF::AddPage('P');
        PDF::writeHTML($view_1, true, false, true, false, '');

        PDF::SetTitle('Bill');
        PDF::Output('bill'.$bill->bill_no.'.pdf');
        // PDF::Output('hello_world.pdf');
        // echo $view;


    }



}
