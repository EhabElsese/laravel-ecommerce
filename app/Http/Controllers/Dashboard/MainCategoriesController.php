<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{

    // index finction

    public function index()
    {

        $categories = Category::orderBy('id','desc')->paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
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
        try {

            DB::beginTransaction();

            //validation

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);
           // return $request;

            //if user choose main category then we must remove parent id from the request
            //return var_dump($request -> type === CategoryType::mainCategory);
           if($request -> type === CategoryType::mainCategory) //main category
            {

                //$request->request->add(['parent_id' => null]);

                $category = Category::create($request->except('_token'));
                $request->parent_id = null;
                $category->name = $request->name;
                $category->save();
               // return $request;
                DB::commit();
                return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);
            }else {
               $category->slug = $request->slug;
               $category->is_active = $request->is_active;
               $category->parent_id = $request->parent_id;
               $category->name = $request->name;
               $category->save();
              // return $request;
               DB::commit();
               return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);
           }

            //if he choose child category we must add parent id

       // $category = Category::create($request->except('_token'));
            //$category = Category::create(['slug'=>$request->slug,'is_active'=>$request->is_active,'parent_id'=>$request->parent_id]);

            //save translations
           // $category->name = $request->name;
          //  $category->save();
           // return $request->parent_id;
         //   DB::commit();
          //  return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);


        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }




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
