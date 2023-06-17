<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['namespace'=>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');

    Route::get('/logout',function (){
        Auth::logout();
        return redirect()->route('admin.show') ;
    });


});

Route::group(['namespace'=>'Dashboard','prefix'=>'admin','middleware'=>'guest:admin'],function(){
    Route::get('/login',[LoginController::class,'index'])->name('admin.show');
    Route::post('/login',[LoginController::class,'login'])->name('admin.login');


});
