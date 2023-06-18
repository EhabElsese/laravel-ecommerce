<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

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
     //   echo $request->email ."<br>".$request->password;
        return redirect()->back()->with(['error'=>'هناك خطأ بالابيانات']);

    }

    public function logout () {

        Auth::logout();

        return redirect()->route('admin.show');

    }


}
