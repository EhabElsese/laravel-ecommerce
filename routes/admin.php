<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;

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

    Route::group([ 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Admin route logout
        Route::get('/logout',[LoginController::class, 'logout'])->name('admin.logout');

        // Settings Routes
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-method/{type}', [SettingsController::class, 'editShippingMethod'])->name('edit.shippings');
            Route::post('shipping-method/{id}', [SettingsController::class, 'updateShippingMethod'])->name('update.shippings');
        });
    });

    // login page routes
    Route::group([ 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.show');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');


    });


