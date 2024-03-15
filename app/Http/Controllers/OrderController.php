<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        $products = Product::with('subCategory')->get();
        return view('admin.order.index')->with(['products' => $products]);
    }

    // public function showVendor($vendor){
    //     $categories = Category::where('vendor_id',$vendor)->get();
    //     return $categories;
    // }

    // public function showSubcategory($category){
    //     $sub_categories = SubCategory::where('category_id',$category)->get();
    //     return $sub_categories;
    // }

}
