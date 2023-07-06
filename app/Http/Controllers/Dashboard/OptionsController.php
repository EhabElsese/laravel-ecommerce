<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::with(['product' => function ($prod) {
            $prod->select('id');
        }, 'attribute' => function ($attr) {
            $attr->select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);

        return view('dashboard.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
         $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionRequest $request)
    {

        //return $request;

        
        DB::beginTransaction();

        //validation
        $option = Option::create($request->except('_token'));
        //save translations
        $option->name = $request->name;
        $option->save();
        DB::commit();

        return redirect()->route('admin.options')->with(['success' => 'تم ألاضافة بنجاح']);
    
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
    public function edit(string $id)
    {
        $data = [];
        $data['option'] = Option::find($id);

       if (!$data['option'])
           return redirect()->route('admin.options')->with(['error' => 'هذه القيمة غير موجود ']);

        $data['products'] = Product::active()->select('id')->get();
       $data['attributes'] = Attribute::select('id')->get();

       return view('dashboard.options.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionRequest $request, string $id)
    {
        try {

            $option = Option::find($id);

           if (!$option)
               return redirect()->route('admin.options')->with(['error' => 'هذا ألعنصر غير موجود']);

           $option->update($request->only(['price','product_id','attribute_id']));
           //save translations
           $option->name = $request->name;
           $option->save();

           return redirect()->route('admin.options')->with(['success' => 'تم ألتحديث بنجاح']);
       } catch (\Exception $ex) {

           return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
