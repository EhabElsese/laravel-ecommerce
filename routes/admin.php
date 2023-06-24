<?php

use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
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

        // profile Route
        Route::group(['prefix' => 'prfile'], function () {
            Route::get('/edit', [ProfileController::class, 'editProfile'])->name('edit.profile');
            Route::post('/update/{id}', [ProfileController::class, 'updateProfile'])->name('update.profile');
        });

        // categories Route
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/',[MainCategoriesController::class,'index']) -> name('admin.maincategories');
            Route::get('create',[MainCategoriesController::class,'create']) -> name('admin.maincategories.create');
            Route::post('store',[MainCategoriesController::class,'store']) -> name('admin.maincategories.store');
            Route::get('edit/{id}',[MainCategoriesController::class,'edit']) -> name('admin.maincategories.edit');
            Route::post('update/{id}',[MainCategoriesController::class,'updateCategory']) -> name('admin.maincategories.update');
            Route::get('delete/{id}',[MainCategoriesController::class,'destroy']) -> name('admin.maincategories.delete');
        });
    });

    // login page routes
    Route::group([ 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.show');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');


    });


