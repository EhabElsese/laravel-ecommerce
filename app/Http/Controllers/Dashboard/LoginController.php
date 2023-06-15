<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    public function index () {

        return view('dashboard.auth.login');
    }

    public function login (AdminLoginRequest $request) {

        $remember_me = $request->has('remember_me') ? true : false ;

        if (auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with(['error'=>'هناك خطأ بالابيانات']);

    }


}
