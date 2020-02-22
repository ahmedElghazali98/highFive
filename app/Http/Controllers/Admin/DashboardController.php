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
        $item = User::find(Auth::user()->id);
        if ($item != '') {

            $rules = [
                'password' => 'required',

            ];

            $messages = [
                'password.required' =>  __('text.password_required'),

            ];

            $validator = \Validator::make(
                [
                    'password' => $password,
                ],
                $rules,
                $messages
            );


             //cheack  validator
           if ($validator->fails() ) {
            return response()->json(['status' => false, 'data_validator' => $validator->messages() ]);
             }

            $item->password = \Hash::make($password);
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false, 'data' => __('text.error_process')]);
            }
            return response()->json(['status' => true, 'data' =>  __('text.change_password_successfully')]);
        } else {
            return response()->json(['status' => false, 'data' => __('text.error_process')]);
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////



}
