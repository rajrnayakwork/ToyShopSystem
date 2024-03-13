<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $category = Category::with('subCategory')->find($category);
        $vendors = Vendor::all();
        return view('admin.category.edit')->with(['vendors' => $vendors,'category' => $category]);
    }

    public function update(CategoryRequest $request): RedirectResponse
    {
        Category::where('id', $request->id)->update(['name' => $request->input('name'),'vendor_id' => $request->input('vendor')]);
        $ids = data_get($request->sub_categories,'*.id');
        SubCategory::where('category_id',$request->id)->where('id','!=',$ids)->delete();
        if(!empty($request->input('sub_categories')))
        foreach ($request->sub_categories as $key => $value) {
            isset($value['id']) ? $id = $value['id'] : $id = null;
            SubCategory::updateOrCreate(['id' => $id],['name' => $value['name'],'category_id' => $request->id]);
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


//         Category::where('id', $request->id)->update(['name' => $request->input('name'),'vendor_id' => $request->input('vendor')]);
//         SubCategory::where('category_id',$request->id)->where('id','!=',$request->sub_category_id)->delete();
//         if(!empty($request->input('sub_categories')))
//         foreach ($request->sub_categories as $key => $value) {
//             if(isset($request->sub_category_id[$key])){
//                 SubCategory::where('category_id',$request->id)->updateOrCreate(['id' => $request->sub_category_id[$key]],['name' => $value]);
//             }else{
//                 SubCategory::updateOrCreate(['name' => $value,'category_id' => $request->id]);
//             }
//         }





//         Category::where('id', $request->id)
//         ->update(['name' => $request->input('name'),'vendor_id' => $request->input('vendor')]);
//         $sub_categories = SubCategory::where('category_id',$request->id)->get();
//         if(!empty($request->input('sub_categories'))){
//             $size_of_sub_categories = count($sub_categories);
//             $size_of_input = count($request->input('sub_categories'));
//             foreach ($request->input('sub_categories') as $index => $value) {
//                 if ($index < $size_of_sub_categories) {
//                     foreach ($sub_categories as $count => $sub_category) {
//                         if($count == $index){
//                             SubCategory::where('id', $sub_category->id)
//                             ->update(['name' => $value,'category_id' => $request->id]);
//                         }
//                     }
//                 }else {
//                     $sub_category = new SubCategory;
//                     $sub_category->fill([
//                         'category_id' => $request->id,
//                         'name' => $value,
//                     ])->save();
//                 }
//             }
//             foreach ($sub_categories as $count => $sub_category) {
//                 if($size_of_input <= $count){
//                     SubCategory::where('id', $sub_category->id)->delete();
//                 }
//             }
//         }else{
//             SubCategory::where('category_id',$request->id)->delete();
//         }
//         return Redirect::route('category.index');
