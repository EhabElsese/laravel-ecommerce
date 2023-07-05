<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceRequest;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    // index finction

    public function index()
    {
        $products = Product::select('id','slug','price', 'created_at','is_active')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));


    }

    // create category func

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        return view('dashboard.products.general.create',compact('data'));
    }

    // store Func

    public function store(GeneralProductRequest $request)
    {

       // return $request;
        DB::beginTransaction();

        //validation

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        //save product categories

        $product->categories()->attach($request->categories);

        //save product tags
        $product->tags()->attach($request->tags);


        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);



    }


    // get price product
    public function getPrice ($product_id){

        return view('dashboard.products.prices.create') -> with('id',$product_id) ;
    }

    // store price product
    public function saveProductPrice (ProductPriceRequest $request ) {


        try{
            

            Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_type','special_price_start','special_price_end']));

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        }catch(\Exception $ex){

        }


    }

    public function getStock ($product_id){

        return view('dashboard.products.stock.create') -> with('id',$product_id) ;
    }

    // store price product
    public function saveProductStock (ProductStockRequest $request ) {


        Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));

        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);


    }

    public function addImages($product_id){



           $images= DB::table('images')->where("product_id",$product_id)->get();


        $id = $product_id;
        return view('dashboard.products.images.create',compact('id','images'));
    }

    //to save images to folder only
    public function saveProductImages(Request $request ){

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveProductImagesDB(ProductImagesRequest $request){



        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

        }catch(\Exception $ex){

        }
    }

    public function destroyImages ($id) {

         DB::table('images')->where("product_id",$id)->delete();


        return redirect()->route('admin.products');



    }

}
