<?php

use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
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

        // Main categories Route
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/',[MainCategoriesController::class,'index']) -> name('admin.maincategories');
            Route::get('create',[MainCategoriesController::class,'create']) -> name('admin.maincategories.create');
            Route::post('store',[MainCategoriesController::class,'store']) -> name('admin.maincategories.store');
            Route::get('edit/{id}',[MainCategoriesController::class,'edit']) -> name('admin.maincategories.edit');
            Route::post('update/{id}',[MainCategoriesController::class,'updateCategory']) -> name('admin.maincategories.update');
            Route::get('delete/{id}',[MainCategoriesController::class,'destroy']) -> name('admin.maincategories.delete');
        });
        // Sub categories Route
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/',[SubCategoriesController::class,'index']) -> name('admin.subcategories');
            Route::get('create',[SubCategoriesController::class,'create']) -> name('admin.subcategories.create');
            Route::post('store',[SubCategoriesController::class,'store']) -> name('admin.subcategories.store');
            Route::get('edit/{id}',[SubCategoriesController::class,'edit']) -> name('admin.subcategories.edit');
            Route::post('update/{id}',[SubCategoriesController::class,'updateCategory']) -> name('admin.subcategories.update');
            Route::get('delete/{id}',[SubCategoriesController::class,'destroy']) -> name('admin.subcategories.delete');
        });
        // Brands Route
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/',[BrandsController::class,'index']) -> name('admin.brands');
            Route::get('create',[BrandsController::class,'create']) -> name('admin.brands.create');
            Route::post('store',[BrandsController::class,'store']) -> name('admin.brands.store');
            Route::get('edit/{id}',[BrandsController::class,'edit']) -> name('admin.brands.edit');
            Route::post('update/{id}',[BrandsController::class,'update']) -> name('admin.brands.update');
            Route::get('delete/{id}',[BrandsController::class,'destroy']) -> name('admin.brands.delete');
        });
    });

    // login page routes
    Route::group([ 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.show');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');


    });


