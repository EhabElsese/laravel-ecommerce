<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        DB::beginTransaction();
        $attribute = Attribute::create([]);

        //save translations
        $attribute->name = $request->name;
        $attribute->save();
        DB::commit();
        return redirect()->route('admin.attributes')->with(['success' => 'تم ألاضافة بنجاح']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => 'هذا العنصر  غير موجود ']);

        return view('dashboard.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, AttributeRequest $request)
    {
        try {
            //validation

            //update DB
            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذا العنصر غير موجود']);


            DB::beginTransaction();

            //save translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.attributes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصيه  غير موجود ']);

            $attribute->delete();

            return redirect()->route('admin.attributes')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.attributes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
}
