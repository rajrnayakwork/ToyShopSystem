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

        $request->validate([
            'name' => 'bail|required|string|max:50',
            'price' => 'bail|required|numeric|max:100000',
            'quantity' => 'bail|required|numeric|max:10000',
            'description' => 'bail|required|max:300',
        ]);

        $request->quantity > 0 ? $availability = 1 : $availability = 0;
        $product->fill([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'availability' => $availability,
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
        try {
            $product->delete();
        } catch (\Throwable $th) {
            session()->flash('message', "This product is can't delete because it is used somewhere.");
            session()->flash('alert-class', 'alert-danger');
        }
        return redirect()->route('product.index');
    }
}
