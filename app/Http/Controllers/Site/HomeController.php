<?php

namespace App\Http\Controllers\Site;


use App\Models\Category;
use App\Models\Slider;
use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;

class HomeController extends Controller
{

    public function home()
    {
       // return Category::get();
    //     $categoryService = new CategoryService() ;

    //    return $allsub = $categoryService->fetchAllSubcategories(Category::select('id')->get());

       
        $data = [];
         $data['sliders'] = Slider::get(['photo']);
         $data['categories'] = Category::parent()->select('id', 'slug')->with(['childrens'])->get();
       // return $data;
        return view('front.home', $data);
    }
}