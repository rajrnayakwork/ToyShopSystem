<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('subCategory.category')->paginate(5);
        return view('admin.product.index')->with(['products' => $products]);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.product.create')->with(['categories' => $categories]);
    }

    public function showSubcategory($category){
        $sub_categories = SubCategory::where('category_id',$category)->get();
        return $sub_categories;
    }

    public function storeOrUpdate(Request $request,Product $product){

        $product->fill([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'availability' => $request->availability,
            'sub_category_id' => $request->sub_category,
        ])->save();

        return Redirect::route('product.index');
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.product.edit')->with(['product' => $product,'categories' => $categories]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
