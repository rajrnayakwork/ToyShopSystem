<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
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

    public function store(VendorRequest $request)
    {
        $vendor = new Vendor;
        $vendor->fill([
            'name' => $request->input('name'),
        ])->save();
        return redirect()->route('vendor.index');
    }

    public function edit($vendor)
    {
        $vendor = Vendor::find($vendor);
        return view('admin.vendor.edit')->with(['vendor' => $vendor]);
    }

    public function update(VendorRequest $request)
    {
        Vendor::where('id', $request->id)
        ->update(['name' => $request->input('name')]);
        return redirect()->route('vendor.index');
    }

    public function destroy($vendor)
    {
        Vendor::find($vendor)->delete();
        return redirect()->route('vendor.index');
    }
}
