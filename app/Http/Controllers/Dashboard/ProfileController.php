<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $admin = auth('admin')->user();

        return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request, $id)
    {

        try {
            $admin = Admin::find($id);

            DB::beginTransaction();


            $admin->update(['name' => $request->name, 'email' => $request->email]);

            $admin->save();

            DB::commit();

            return redirect()->back()->with(['success' => ' تم التعديل بنجاااااااااااااح']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => ' هناك خطأ ما يرجى المحاوله مره اخري  ']);
        }

    }
}
