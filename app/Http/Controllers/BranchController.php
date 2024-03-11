<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::all();
        return view('admin.branch.index')->with(['branches' => $branches]);
    }
    public function create(){
        return view('admin.branch.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'bail|required|unique:branches|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ]);
        $branch = new Branch;
        $branch->fill([
            'name' => $request->name,
        ])->save();
        return redirect()->route('branch.index');
    }
    public function edit($branch){
        $branch = Branch::find($branch);
        return view('admin.branch.edit')->with(['branch' => $branch]);
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'bail|required|unique:branches|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ]);
        Branch::where('id', $request->id)
        ->update(['name' => $request->name]);
        return redirect()->route('branch.index');
    }
    public function destroy($branch){
        Branch::find($branch)->delete();
        return redirect()->route('branch.index');
    }
}
