<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.vendor.index')->with(['vendors' => $vendors]);
    }

    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:vendors|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ]);
        $vendor = new Vendor;
        $vendor->fill([
            'name' => $request->name,
        ])->save();
        return redirect()->route('vendor.index');
    }

    public function edit($vendor)
    {
        $vendor = Vendor::find($vendor);
        return view('admin.vendor.edit')->with(['vendor' => $vendor]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:vendors|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ]);
        Vendor::where('id', $request->id)
        ->update(['name' => $request->name]);
        return redirect()->route('vendor.index');
    }

    public function destroy($vendor)
    {
        Vendor::find($vendor)->delete();
        return redirect()->route('vendor.index');
    }
}
