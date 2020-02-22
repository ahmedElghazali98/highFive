<?php

namespace App\Http\Controllers\Admin;
use App\Models\User as MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends AdminController
{
    public function __construct()
    {

    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {

        $name  = $request->get('name');
        $data['users'] = MyModel::where('company_id',Auth::user()->company_id)->orderBy('serial', 'desc');
        if ($name != '') {
            $data['users'] = $data['users']->where('company_id',Auth::user()->company_id)->where('username', $name)->orWhere('username', 'like', '%' .  $name . '%');
        }

        $data['users'] = $data['users']->paginate(8);
        if ($request->ajax()) {
            return view('admin.users.table-data', compact('data'))->render();
        }
        return view('admin.users.index', compact('data'));
    }
    /***********************************************************************************************************************/
    public function add(Request $request)
    {

        $hidden = $request->get('hidden');
        if ($hidden == 0) {
            $fullname = $request->get('fullname');
            $username = $request->get('username');
            $email = $request->get('email');
            $password = $request->get('password');
            $status = $request->get('activeValue') == '' ? 1 : 0;

            if ($username != '') {
                if (preg_match('/[^A-Za-z0-9]/', $username)) {
                    return response()->json(['status' => false, 'data' => 'اسم المستخدم يجب أن يكون باللغة الانجليزية']);
                }
            }



				$rules = [
                'fullname' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required',
                'status' => 'required',

            ];

            $messages = [
                'fullname.required' =>  __('text.fullname_required'),
                'username.required' =>  __('text.username_required'),
                'username.unique' =>  __('text.username_must_be_unique'),
                'username.required'=> __('text.username_required'),
                'email.required'=> __('text.email_required'),
                'email.unique'=> __('text.email_must_be_unique'),
                'password.required'=> __('text.password_required'),
                'status.required'=> __('text.status_required'),

            ];

            $validator = \Validator::make(
                [
                    'fullname' => $fullname,
                    'username' => $username,
                    'email'=>$email,
                    'password'=>$password,
                    'status'=>$status,


                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }



            //use DB Transaction
        DB::beginTransaction();
        try {
            //get last serial
            $serial=0;
            $last_serial = MyModel::where('company_id',Auth::user()->company_id)->orderBy('id', 'desc')->first();
            if($last_serial!=null){
            $serial= ($last_serial->serial) +1;
            }else{
                $serial=1;
            }



            $item = new MyModel();
            $item->username = $username;
            $item->fullname = $fullname;
            $item->email = $email;
            $item->password = \Hash::make($password);
            $item->status = $status;
            $item->user_id = Auth::user()->id;
            $item->company_id=Auth::user()->company_id;
            $item->serial=$serial;

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



        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
    /***********************************************************************************************************************/

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $item = MyModel::find($id);
        if ($item != '') {
            return response()->json(['status' => true, 'data' => $item]);
        } else {
            return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
        }
    }

    /***********************************************************************************************************************/

    public function UpdateStats(Request $request)
    {
        $id = $request->get('id');
        $item = MyModel::find($id);
        if ($item != '') {
            if ($item->id == 1) {
                return response()->json(['status' => false, 'data' => 'لا يمكن تعديل حالة الأدمن']);
            }
            if ($item->status == 0) {
                $item->status = 1;
            } else {
                $item->status = 0;
            }
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
            }
            return response()->json(['status' => true, 'data' => 'تم تعديل الحالة']);
        } else {
            return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
        }
    }
    /***********************************************************************************************************************/
    public function update(Request $request)
    {

        $hidden = $request->get('hidden');

        if ($hidden != 0) {
            $item = MyModel::find($hidden);
            if ($item == '') {
                return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
            }
            $username = $request->get('username');
            $fullname = $request->get('fullname');
            $email = $request->get('email');
            $password = $request->get('password');
            $status = $request->get('activeValue') == '' ? 1 : 0;

            $rules = [
                'fullname' => 'required',
                'username' => 'required|unique:users,username,'.$hidden,
                'email' => 'required|unique:users,email,'.$hidden,
                'password' => 'required',
                'status' => 'required',

            ];

            $messages = [
                'fullname.required' =>  __('text.fullname_required'),
                'username.required' =>  __('text.username_required'),
                'username.unique' =>  __('text.username_must_be_unique'),
                'username.required'=> __('text.username_required'),
                'email.required'=> __('text.email_required'),
                'email.unique'=> __('text.email_must_be_unique'),
                'password.required'=> __('text.password_required'),
                'status.required'=> __('text.status_required'),

            ];

            $validator = \Validator::make(
                [
                    'fullname' => $fullname,
                    'username' => $username,
                    'email'=>$email,
                    'password'=>$password,
                    'status'=>$status,



                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }


            $item->username = $username;
            $item->fullname = $fullname;
            $item->status = $status;

            $item->email = $email;
            // $item->franchise_id = $franchise_id;
            if ($password != '') {
                $item->password = \Hash::make($password);
            }
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
            }
            return response()->json(['status' => true, 'data' => 'تم تعديل البيانات']);
        }
    }
    /****************************************************************************************************************************************** */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $item = MyModel::find($id);
        if ($item != '') {
            if ($item->id == 1) {
                return response()->json(['status' => false, 'data' => 'لا يمكن حذف الأدمن']);
            }
            $deleted = $item->delete();
            if (!$deleted) {
                return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
            }
            return response()->json(['status' => true, 'data' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
        }
    }
    /****************************************************************************************************************************************** */
    public function changepassword(Request $request)
    {
        $hidden = $request->get('hidden');
        $password = $request->get('password');
        $confirmation_password = $request->get('confirmation_password');

        if ($password == '' or $confirmation_password == '') {
            return response()->json(['status' => false, 'data' => 'جميع الحقول مطلوبة']);
        }

        $item = MyModel::find($hidden);
        if ($item != '') {
            if ($password === $confirmation_password) {
                $item->password = \Hash::make($password);
                $saved = $item->save();
                if (!$saved) {
                    return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
                }
                return response()->json(['status' => true, 'data' => 'تم تغيير  كلمة المرور']);
            } else {
                return response()->json(['status' => false, 'data' => 'كلمة المرور غير متطابقة']);
            }
        } else {
            return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
        }
    }
    /**************************************************************************************/

 public function userpermission (Request $request)
{

    $id = $request->get('id');
    $user = MyModel::find($id);
    $permission = Permission::orderBy('group_id')->get();
    $permissionUser= $user->getAllPermissions();

    $data='<div class="form-group m-form__group row">';
    $i=1;

    foreach($permission as $p){
        $check='';

        foreach($permissionUser as $pu){
        if($pu->id ==$p->id){
            $check='checked="checked"';
        }
          }

        if($p->group!=0){
            $data =$data.'<div class="col-md-12 "><label class="containerCheckbox m--padding-bottom-10 m--margin-bottom-10 border-bottom">' .$p->name_ar  .
            '<input name="permission[]" type="checkbox"'. $check.' value="'.$p->name   .'"><span class="checkmark"></span></label></div>';
        }else{
            $data =$data.'<div class="col-md-4"><label class="containerCheckbox">' .$p->name_ar  .
            '<input name="permission[]" type="checkbox"'. $check.' value="'.$p->name   .'"><span class="checkmark"></span></label></div>';

        }


    }

    return response()->json(['status' => true, 'data' => $data]);



  }

  public function getpermission(Request $request){
    $permission = $request->get('permission');

      $user=Auth::user();

      $user->syncPermissions();

      $user->syncPermissions($permission);

      return response()->json(['status' => true, 'data' => __('text.update_successful')]);


  }

}

