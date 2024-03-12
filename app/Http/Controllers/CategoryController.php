<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('vendor')->get();
        $sub_categories = SubCategory::with('category')->get();
        return view('admin.category.index')->with(['categories' => $categories,'sub_categories' => $sub_categories]);
    }

    public function create(): View
    {
        $vendors = Vendor::all();
        return view('admin.category.create')->with(['vendors' => $vendors]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = new Category;
        $category->fill([
            'vendor_id' => $request->input('vendor'),
            'name' => $request->input('name'),
        ])->save();
        if(!empty($request->input('sub_categories'))){
            foreach ($request->input('sub_categories') as $value) {
                $sub_category = new SubCategory;
                $sub_category->fill([
                    'category_id' => $category->id,
                    'name' => $value,
                ])->save();
            }
        }
        return Redirect::route('category.index');
    }

    public function edit($category): View
    {
        $sub_categories = SubCategory::where('category_id',$category)->get();
        $category = Category::find($category);
        $vendors = Vendor::all();
        return view('admin.category.edit')->with(['vendors' => $vendors,'category' => $category,'sub_categories' => $sub_categories]);
    }

    public function update(CategoryRequest $request): RedirectResponse
    {
        Category::where('id', $request->id)
        ->update(['name' => $request->input('name'),'vendor_id' => $request->input('vendor')]);
        SubCategory::where('category_id',$request->id)->delete();
        if(!empty($request->input('sub_categories'))){
            foreach ($request->input('sub_categories') as $value) {
                $sub_category = new SubCategory;
                $sub_category->fill([
                    'category_id' => $request->id,
                    'name' => $value,
                ])->save();
            }
        }
        return Redirect::route('category.index');
    }

    public function destroy($category)
    {
        SubCategory::where('category_id',$category)->delete();
        Category::find($category)->delete();
        return redirect()->route('category.index');
    }
}
