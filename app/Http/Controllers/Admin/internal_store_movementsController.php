<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\system_constants;
use App\Models\internal_store_movements as MyModel ;
use Illuminate\Support\Facades\Auth;
use App\Models\employees;
use App\Models\cars;
use App\Models\stores;
use App\Models\items_internal_store_movements;
use App\Models\item;
use Illuminate\Support\Facades\DB;
use App\Models\processors_log;
use App\Models\store_item;
use App\Models\User;
use App\Models\internal_store_movement_log;

class internal_store_movementsController extends AdminController
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
        $data['internal_store_movements'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc');
        if ($name != '') {
            $data['internal_store_movements'] = $data['internal_store_movements']->where('name', $name)->orWhere('name', 'like', '%' .  $name . '%');
        }

        $data['internal_store_movements'] = $data['internal_store_movements']->paginate(8);

        $data['storesSelect'] = stores::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

        //get system constants
        $data['cities']=system_constants::where('company_id',Auth::user()->company_id)->where('type','city')->where('status','1')->orderBy('id', 'desc')->get();
        $data['employees']=employees::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
        $data['cars']=cars::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return view('admin.internal_store_movements.table-data', compact('data'))->render();
        }
        return view('admin.internal_store_movements.index', compact('data'));
    }
    //************************************************************************************************************
    //                                          add function
    //************************************************************************************************************

    public function add(Request $request)
       {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $from_store_id=$request->get('from_store_id');
            $to_store_id=$request->get('to_store_id');
            $car_id=$request->get('car_id');
            $date=$request->get('date');
            $emp_id=$request->get('emp_id');

            $id_itemsArray=$request->get('id_items');
            $quantitys=$request->get('quantity');


            $rules = [
                'from_store_id' => 'required',
                'to_store_id' => 'required',
                'car_id' => 'required',
                'date' => 'required',
                'id_itemsArray' => 'required',

            ];

            $messages = [
                'from_store_id.required' =>  __('text.from_store_id_required'),
                'to_store_id.required' =>  __('text.to_store_id_required'),
                'car_id.required' =>  __('text.car_id_required'),
                'date.required'=> __('text.date_required'),
                'id_itemsArray.required'=> __('text.id_itemsArray_required'),

            ];

            $validator = \Validator::make(
                [
                    'from_store_id' => $from_store_id,
                    'to_store_id' => $to_store_id,
                    'car_id'=>$car_id,
                    'date'=>$date,
                    'id_itemsArray'=>$id_itemsArray,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

             $input=[
                'from_store_id' => $from_store_id,
                'to_store_id' => $to_store_id,
                'id_itemsArray'=>$id_itemsArray,
                'car_id'=>$car_id,
                'date'=>$date,
                'emp_id'=>$emp_id,
                'quantitys'=>$quantitys,

             ];

             $internal_store_movements = new MyModel();
            $saved=$internal_store_movements->add($input);


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
           $internal_store_movements = MyModel::where('company_id',Auth::user()->company_id)->where('id',$id)->first();
            $items_internal_store_movement=items_internal_store_movements::where('movement_id',$internal_store_movements->id)->orderBy('id', 'desc')->get();
            $units=system_constants::where('company_id',Auth::user()->company_id)->where('type','unit')->where('status','1')->orderBy('id', 'desc')->get();
            $item = item::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->get();

             $output=[];
            foreach($items_internal_store_movement as $i){
                $item=item::find($i->item_id);
                $unit=system_constants::find($item->unit_id);
                $quantity=$i->quantity;
                $array=[
                    'item_id'=>$item->id,
                    'name_ar'=>$item->name_ar,
                    'name_en'=>$item->name_en,
                    'quantity'=>$quantity,
                    'unit'=>$unit->name_ar,
                ];
                array_push($output,$array);

            }

           if ($internal_store_movements != '') {
               return response()->json(['status' => true,
               'data' => $internal_store_movements ,
               'output'=>$output

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
        $processors_log = new processors_log();

        $hidden = $request->get('hidden');
        if ($hidden != 0) {

            $from_store_id=$request->get('from_store_id');
            $to_store_id=$request->get('to_store_id');
            $car_id=$request->get('car_id');
            $date=$request->get('date');
            $emp_id=$request->get('emp_id');

            $id_itemsArray=$request->get('id_items');
            $quantitys=$request->get('quantity');

            $rules = [
                'from_store_id' => 'required',
                'to_store_id' => 'required',
                'car_id' => 'required',
                'date' => 'required',
                'id_itemsArray' => 'required',

            ];

            $messages = [
                'from_store_id.required' =>  __('text.from_store_id_required'),
                'to_store_id.required' =>  __('text.to_store_id_required'),
                'car_id.required' =>  __('text.car_id_required'),
                'date.required'=> __('text.date_required'),
                'id_itemsArray.required'=> __('text.id_itemsArray_required'),

            ];

            $validator = \Validator::make(
                [
                    'from_store_id' => $from_store_id,
                    'to_store_id' => $to_store_id,
                    'car_id'=>$car_id,
                    'date'=>$date,
                    'id_itemsArray'=>$id_itemsArray,

                ],
                $rules,
                $messages
            );

           // return response()->json(['status' => false, 'data' => count($id_itemsArray)]);


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }




               //update
               $item = MyModel::where('id',$hidden)->orderBy('id', 'desc')->first();

            //    //فحص هل تم تغير القيم وتغير بجدول المعالجات
            //    if( $item->from_store_id  !=$from_store_id){
            //        $s = new stores();
            //        $old_name =$s->getByid($item->from_store_id);
            //        $new_name =$s->getByid($from_store_id);

            //        $processors_log->add('من المخزن',$old_name->name_ar , $new_name->name_ar ,Auth::user()->id ,$hidden );

            //    }

            //    if( $item->to_store_id  !=$to_store_id){
            //       $s = new stores();
            //       $old_name =$s->getByid($item->to_store_id);
            //        $new_name =$s->getByid($to_store_id);

            //        $processors_log->add('الى المخزن ',$old_name->name_ar , $new_name->name_ar ,Auth::user()->id ,$hidden );

            // }

        //     if( $item->car_id  !=$car_id){
        //         $s = new cars();
        //         $old_name =$s->getByid($item->car_id);
        //          $new_name =$s->getByid($car_id);

        //          $processors_log->add('السيارة ',$old_name->name_ar , $new_name->name_ar ,Auth::user()->id ,$hidden );

        //   }

    //       if( $item->emp_id  !=$emp_id){
    //         $s = new employees();
    //         $old_name =$s->getByid($item->emp_id);
    //          $new_name =$s->getByid($emp_id);

    //          $processors_log->add('الموظف ',$old_name->name_ar , $new_name->name_ar ,Auth::user()->id ,$hidden );

    //   }

           // Reverse movement

            $all_items=items_internal_store_movements::where('movement_id',$item->id)->get();
            foreach($all_items as $a){
                $input_store_item=[
                    'from_store_id'=>$item->from_store_id,
                    'to_store_id'=>$item->to_store_id,
                    'item_id'=>$a->item_id,
                    'quantity'=>$a->quantity,
                ];
                $store_item = new store_item();
                $store_item->reverse_movements($input_store_item);



            }


               $item->from_store_id = $from_store_id;
               $item->to_store_id = $to_store_id;
               $item->date = date('Y-m-d' ,strtotime($date));
               $item->car_id = $car_id;
               $item->emp_id = $emp_id;

               //save company id
               $item->company_id=Auth::user()->company_id;

               $saved = $item->update();


               //remove all items in table items_internal_store_movements
               $all_items=items_internal_store_movements::where('movement_id',$item->id)->get();
               foreach($all_items as $a){
                   $i = new internal_store_movement_log();
                   $i->from_store_id =$from_store_id;
                   $i->to_store_id =$to_store_id;
                   $i->car_id =$car_id;
                   $i->emp_id =$emp_id;
                   $i->item_id =$a->item_id;
                   $i->quantity =$a->quantity;
                   $i->movement_id =$item->id;

                   $i->user_id=Auth::user()->id;
                   $i->company_id=Auth::user()->company_id;
                   $s =internal_store_movement_log::where('company_id',Auth::user()->company_id)->max('serial');

                  $i->serial=$s+1;
                  $i->save();


                 $a->delete();
               }

               $input=[
                'from_store_id' => $from_store_id,
                'to_store_id' => $to_store_id,
                'id_itemsArray'=>$id_itemsArray,
                'quantitys'=>$quantitys,

             ];

            $store_item= new store_item();
           $saved=$store_item->movements($input);
           if(!$saved){
                    return response()->json(['status' => false, 'data' =>'error']);

           }


                //save  items_internal_store_movements
                $length = count($id_itemsArray);
                for($t=0 ; $t<$length ;++$t){
                   // return response()->json(['status' => false, 'data' =>$id_itemsArray[$t]]);

                    $items_internal_store_movement = new items_internal_store_movements();
                    $items_internal_store_movement->movement_id=$item->id;
                    $items_internal_store_movement->item_id=$id_itemsArray[$t];
                    $items_internal_store_movement->quantity=$quantitys[$t];
                    $items_internal_store_movement->company_id=Auth::user()->company_id;
                    $items_internal_store_movement->user_id=Auth::user()->id;
                    $s =items_internal_store_movements::where('company_id',Auth::user()->company_id)->max('serial');

                    $items_internal_store_movement->serial=$s+1;

                    $items_internal_store_movement->save();

                }

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

            $deleted = $item->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' => __('text.delete_successful')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }

    //************************************************************************************************************
    //                                          get_log function
    //************************************************************************************************************
    public function get_log(Request $request){
        $id = $request->get('id');
        $array=[];

        $internal_store_movement_log = internal_store_movement_log::where('movement_id',$id)->orderBy('id', 'desc')->get();
            foreach($internal_store_movement_log as $i){
                $from_store_id=stores::find($i->from_store_id);
                $to_store_id=stores::find($i->to_store_id);
                $car=cars::find($i->car_id);
                $emp=employees::find($i->emp_id);
                $item=item::find($i->item_id);
                $user=user::find($i->user_id);

                $output=[
                    'from_store_id'=>$from_store_id->name_ar,
                    'to_store_id'=>$to_store_id->name_ar,
                    'car'=>$car->name_ar,
                    'emp'=>$emp->name_ar,
                    'item'=>$item->name_ar,
                    'quantity'=>$i->quantity,
                    'user'=>$user->username,
                    'date'=>date('Y-m-d ' ,strtotime($i->created_at)),


                ];
                array_push($array,$output);

            }

        if(count($internal_store_movement_log)>0){
            return response()->json(['status' => true, 'data' => $array  ]);

        } else{
            return response()->json(['status' => false, 'data' => __('text.error_process')]);

        }

    }



}

