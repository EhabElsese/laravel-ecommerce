<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{

    // index finction

    public function index()
    {

        $categories = Category::whereNot('parent_id', null)->orderByDesc('id')->paginate(PAGINATION_COUNT);

        return view('dashboard.subcategories.index', compact('categories'));
    }

    // create category func

    public function create()
    {
        $categories =   Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    // store Func

    public function store(MainCategoryRequest $request)
    {
        return $request;



    }


    // edit function

    public function edit($id)
    {

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.maincategories')->with(['error', 'هذا القسم غير موجود']);
        }

        return view('dashboard.categories.edit', compact('category'));
    }


    // update function

    public function updateCategory (MainCategoryRequest $request, $id)
    {

        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);
            }


            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $category->slug = $request->slug;
            $category->is_active = $request->is_active;
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with([ $ex->getMessage(),'error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

    public function destroy ($id) {


        try {
            $category = Category::find($id);

            $category->delete();


            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with([ $ex->getMessage(),'error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
