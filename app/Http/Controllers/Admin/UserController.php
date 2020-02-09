<?php

namespace App\Http\Controllers\Admin;
use App\Models\User as MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
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

            //check username
            $users_name_count = MyModel::where('company_id',Auth::user()->company_id)->where('username', $username)->count();
            //check email
            $users_count = MyModel::where('company_id',Auth::user()->company_id)->where('email', $email)->count();

            if ($users_name_count > 0) {
                return response()->json(['status' => false, 'data' => __('text.username_must_be_unique')]);
            }
            if ($users_count > 0) {
                return response()->json(['status' => false, 'data' => __('text.email_must_be_unique')]);
            }
            $rules = [
                'username' => 'required',
                 'email' => 'required',
                'password' => 'required',
            ];

            $messages = [
                'username.required' => 'اسم مستخدم  مطلوب',
                 'email.required' => 'البريد الالكتروني مطلوب',
                'password.required' => 'كلمة المرور مطلوبة',
            ];

            $validator = \Validator::make(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                ],
                $rules,
                $messages
            );

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' =>  __('text.error_all_filed_required') ]);
            }

            //get  last serial
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
                return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء عملية الإضافة']);
            }
            return response()->json(['status' => true, 'data' => 'تمت عملية الإضافة']);
        } else {
            return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء عملية الإضافة']);
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
            $language=$request->get('language');
            $password = $request->get('password');
            // $franchise_id = $request->get('franchise_id');

            if ($username != '') {
                if (preg_match('/[^A-Za-z0-9]/', $username)) {
                    return response()->json(['status' => false, 'data' => 'اسم المستخدم يجب أن يكون باللغة الانجليزية']);
                }
            }

            $users_name_count = MyModel::where('username', $username)->where('id', '!=', $item->id)->count();
            $users_count = MyModel::where('email', $email)->where('id', '!=', $item->id)->count();

            if ($users_name_count > 0) {
                return response()->json(['status' => false, 'data' => 'اسم المستخدم موجود مسبقا']);
            }

            if ($users_count > 0) {
                return response()->json(['status' => false, 'data' => 'البريد الالكتروني مستخدم من قبل']);
            }

            $rules = [
                'username' => 'required',
                // 'email' => 'required',
            ];

            $messages = [
                'username.required' => 'اسم مستخدم  مطلوب',
                // 'email.required' => 'البريد الالكتروني مطلوب',
            ];

            $validator = \Validator::make(
                [
                    'username' => $username,
                    // 'email' => $email,
                ],
                $rules,
                $messages
            );

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => 'جميع الحقول مطلوبة']);
            }

            $item->username = $username;
            $item->fullname = $fullname;
            $item->language = $language;

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
    $permission = Permission::all();
    $permissionUser= $user->getAllPermissions();
$data='';
    $i=1;
    foreach($permission as $pu){

        if($pu->group!=0){
            $data =$data.'<input type="checkbox" >';
            $data =$data.'<label>'.$pu->name_ar.'</label><hr><div class="row">';
        }else{
            $data =$data.'<div class="col-md-3">' ;
            $data =$data.'<input type="checkbox" >';
            $data =$data.'<label>'.$pu->name_ar.'</label></div>';

        }




    }

    return response()->json(['status' => true, 'data' => $data]);



  }

  public function getpermission(Request $request){

  }

}

