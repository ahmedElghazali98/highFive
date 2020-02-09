<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends AdminController
{
    use AuthenticatesUsers;
    public function __construct()
    {
        parent::__construct();
    }
    ///////////////////////////////////////////
    public function getIndex()
    {
        return view('admin.login.index');
    }
    ///////////////////////////////////////////
    public function postIndex(Request $request)
    {
        $field = 'name';
        $username = $request->get('username');
        $password = $request->get('password');
        $remember_token = $request->get('remember_token');

        $user = User::where('name',$username)->first();
        if($user != ''){
            if($user->status != 1){
                return redirect('/admin/login')->with(['danger' => 'عذرا ، الحساب معطل الرجاء مراجعة الإدارة']);
            }
        }else{
            return redirect('/admin/login')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }

        $admin[$field] = $username;
        $admin['password'] = $password;

        if (Auth::guard('admin')->attempt($admin, $remember_token))
        {
            return redirect()->intended('/admin/setting');
        }
        else
        {
            return redirect('/admin/login')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }
    }
    ///////////////////////////////////////////
    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

}