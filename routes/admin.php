<?php

use App\Http\Controllers\Dashboard\AttributesController;
use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\OptionsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\TagsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SliderController;

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
      /*  Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/',[SubCategoriesController::class,'index']) -> name('admin.subcategories');
            Route::get('create',[SubCategoriesController::class,'create']) -> name('admin.subcategories.create');
            Route::post('store',[SubCategoriesController::class,'store']) -> name('admin.subcategories.store');
            Route::get('edit/{id}',[SubCategoriesController::class,'edit']) -> name('admin.subcategories.edit');
            Route::post('update/{id}',[SubCategoriesController::class,'updateCategory']) -> name('admin.subcategories.update');
            Route::get('delete/{id}',[SubCategoriesController::class,'destroy']) -> name('admin.subcategories.delete');
        });*/
        // Brands Route
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/',[BrandsController::class,'index']) -> name('admin.brands');
            Route::get('create',[BrandsController::class,'create']) -> name('admin.brands.create');
            Route::post('store',[BrandsController::class,'store']) -> name('admin.brands.store');
            Route::get('edit/{id}',[BrandsController::class,'edit']) -> name('admin.brands.edit');
            Route::post('update/{id}',[BrandsController::class,'update']) -> name('admin.brands.update');
            Route::get('delete/{id}',[BrandsController::class,'destroy']) -> name('admin.brands.delete');
        });
        // Tags Route
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/',[TagsController::class,'index']) -> name('admin.tags');
            Route::get('create',[TagsController::class,'create']) -> name('admin.tags.create');
            Route::post('store',[TagsController::class,'store']) -> name('admin.tags.store');
            Route::get('edit/{id}',[TagsController::class,'edit']) -> name('admin.tags.edit');
            Route::post('update/{id}',[TagsController::class,'update']) -> name('admin.tags.update');
            Route::get('delete/{id}',[TagsController::class,'destroy']) -> name('admin.tags.delete');
        });

        // Products Route
        Route::group(['prefix' => 'products'], function () {
            Route::get('/',[ProductsController::class,'index']) -> name('admin.products');
            Route::get('create',[ProductsController::class,'create']) -> name('admin.products.general.create');
            Route::post('store',[ProductsController::class,'store']) -> name('admin.products.general.store');

            Route::get('price/{id}',[ProductsController::class,'getPrice']) -> name('admin.products.price');
            Route::post('price',[ProductsController::class,'saveProductPrice']) -> name('admin.products.price.store');


            Route::get('stock/{id}', [ProductsController::class,'getStock'])->name('admin.products.stock');
            Route::post('stock', [ProductsController::class,'saveProductStock'])->name('admin.products.stock.store');

            Route::get('images/{id}', [ProductsController::class,'addImages'])->name('admin.products.images');
            Route::post('images', [ProductsController::class,'saveProductImages'])->name('admin.products.images.store');
            Route::post('images/db', [ProductsController::class,'saveProductImagesDB'])->name('admin.products.images.store.db');
            Route::get('images/delete/{id}', [ProductsController::class,'destroyImages'])->name('admin.products.images.delete');

        });

        // attributes Routes
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', [AttributesController::class,'index'])->name('admin.attributes');
            Route::get('create', [AttributesController::class,'create'])->name('admin.attributes.create');
            Route::post('store', [AttributesController::class,'store'])->name('admin.attributes.store');
            Route::get('delete/{id}', [AttributesController::class,'destroy'])->name('admin.attributes.delete');
            Route::get('edit/{id}', [AttributesController::class,'edit'])->name('admin.attributes.edit');
            Route::post('update/{id}', [AttributesController::class,'update'])->name('admin.attributes.update');
        });

        // options Routes
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', [OptionsController::class,'index'])->name('admin.options');
            Route::get('create', [OptionsController::class,'create'])->name('admin.options.create');
            Route::post('store', [OptionsController::class,'store'])->name('admin.options.store');
            //Route::get('delete/{id}',[OptionsController::class,'destroy']) -> name('admin.options.delete');
            Route::get('edit/{id}', [OptionsController::class,'edit'])->name('admin.options.edit');
            Route::post('update/{id}',[OptionsController::class,'update'])->name('admin.options.update');
        });

        //Sliders Route 

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', [SliderController::class,'addImages'])->name('admin.sliders.create');
            Route::post('images', [SliderController::class,'saveSliderImages'])->name('admin.sliders.images.store');
            Route::post('images/db', [SliderController::class,'saveSliderImagesDB'])->name('admin.sliders.images.store.db');

        });
    });

    // login page routes
    Route::group([ 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.show');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');


    });


