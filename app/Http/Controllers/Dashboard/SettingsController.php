<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethod($type)
    {
        // $type ===> free or inner or outer
        if ($type === 'free') {
            $shipping_method = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'inner') {
            $shipping_method = Setting::where('key', 'local_label')->first();
        } elseif ($type === 'outer') {
            $shipping_method = Setting::where('key', 'outer_label')->first();
        } else {
            $shipping_method = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shippings.edit', compact('shipping_method'));

    }

    public function updateShippingMethod(ShippingsRequest $request, $id)
    {

        try {
            $shipping_method = Setting::find($id);

            DB::beginTransaction();

            $shipping_method->update(['plain_value' => $request->value,]);

            $shipping_method->value = $request->name;

            $shipping_method->save();

            DB::commit();

            return redirect()->back()->with(['success' => ' تم التعديل بنجاااااااااااااح']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => ' هناك خطأ ما يرجى المحاوله مره اخري  ']);
        }


    }
}
