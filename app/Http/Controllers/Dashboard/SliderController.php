<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImagesRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addImages()
    {

         $images = Slider::get(['photo']);
        return view('dashboard.sliders.images.create', compact('images'));
    }

    //to save images to folder onlys
    public function saveSliderImages(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('sliders', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveSliderImagesDB(SliderImagesRequest $request)
    {

        

        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Slider::create([
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

        }
    }
}
