<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $request)
    {
        return view('admin.dashboard.index');
    }
    public function getProfile()
    {
        return view('admin.dashboard.profile');
    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    public function postPassword(Request $request)
    {
        $password = $request->get('password');
        $item = User::find(\Auth::user()->id);
        if ($item != '') {
            $item->password = \Hash::make($password);
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => true, 'message' => 'حدث خطأ']);
            }
            return response()->json(['status' => true, 'message' => 'تم تغيير كلمة المرور بنجاح']);
        } else {
            return response()->json(['status' => false, 'message' => 'حدث خطأ']);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////

}
