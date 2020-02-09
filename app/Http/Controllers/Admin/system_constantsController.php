<?php

namespace App\Http\Controllers\Admin;
use App\Models\system_constants as MyModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;

class system_constantsController extends AdminController
{
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
        $data['system_constants'] = MyModel::where('company_id',Auth::user()->company_id)->where('type','!=','system_constant')->where('type','!=','language')->orderBy('id', 'desc');

        if ($name != '') {
            $get_type=MyModel::where('name_ar',$name)->orderBy('id', 'desc')->first();
            $data['system_constants'] = MyModel::where('type', $get_type->value2)->orWhere('type', 'like', '%' .  $get_type->value2 . '%');
        }

        $data['system_constants'] = $data['system_constants']->paginate(8);

        $data['system_constants_select'] = MyModel::where('type','system_constant')->orderBy('id', 'desc')->get();

        $data['languages'] = MyModel::where('type','language')->where('status','1')->orderBy('id', 'ASC')->get();


        if ($request->ajax()) {
            return view('admin.system_constants.table-data', compact('data'))->render();
        }
        return view('admin.system_constants.index', compact('data'));
    }

     //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {
        $hidden = $request->get('hidden');
        if ($hidden == 0) {


            $name_ar=$request->get('name_ar');
            $constant_type=$request->get('constant_type');
            $status = $request->get('activeValue') == '' ? 1 : 0;



            $rules = [
                'name_ar' => 'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم  مطلوب  ',

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $request->get('name_ar'),
                    'type' => $request->get('constant_type'),

                ],
                $rules,
                $messages
            );


            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

            //get last number in value
            $system_constant= MyModel::where('company_id',Auth::user()->company_id)->where('type',$constant_type)->orderBy('id', 'desc')->first();
            if($system_constant!=null){
            $new_value= ($system_constant->value) +1;
            }else{
                $new_value=1;
            }


             //check whether system_constants table has name_{lang} column
            $languages = MyModel::where('company_id',Auth::user()->company_id)->where('type','language')->where('status','1')->orderBy('id', 'ASC')->get();
            foreach($languages as $lang){
            if(Schema::hasColumn('system_constants', 'name_'.$lang->value2))
            {


            }
            else{
                $sTable='system_constants';
                $sColumn='name_'.$lang->value2;
                Schema::table($sTable, function(Blueprint $table) use ($sColumn, &$fluent)
                {
                    $fluent = $table->string($sColumn)->default(null);;
                });
            }
            }//end foreach

            //name filed in tabel
            $array_name_filed[]=null;
            foreach($languages as $lang){
                $array_name_filed[]='name_'.$lang->value2;
            }


             //svae  new  system_constant
             $item = new MyModel();
                /* foreach($array_name_filed as $name){
                $item->$name = $request->get($name);
                $item->save();
            }*/

             $item->name_ar = $name_ar;
             $item->type = $request->get('constant_type');
             $item->value=$new_value ;
             $item->order=$new_value ;
             $item->status=$status ;
             $item->company_id=Auth::user()->company_id;


               $saved = $item->save();
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
            $constant_type=$request->get('constant_type');
            $status = $request->get('activeValue') == '' ? 1 : 0;



            $rules = [
                'name_ar' => 'required',

            ];

            $messages = [
                'name_ar.required' => 'اسم  مطلوب  ',

            ];

            $validator = \Validator::make(
                [
                    'name_ar' => $request->get('name_ar'),
                    'type' => $request->get('constant_type'),

                ],
                $rules,
                $messages
            );


            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

               //update system constants
               $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$hidden)->first();
               if($item==null){
                return response()->json(['status' => false, 'data' => __('text.error_process')]);

               }
               $item->name_ar = $name_ar;
               $item->type = $request->get('constant_type');
               $item->status=$status ;

               $updated = $item->save();
               if (!$updated) {
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
        $item = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
        if ($item != '') {

            if(count($item->cities)>0  ){
                return response()->json(['status' => false, 'data' => __('text.not_be_delete')]);
            }
            $deleted = $item->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }



}
