<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index(): View
    {
        $categorys = Category::all();
        return view('admin.order.index')->with(['categorys' => $categorys]);
    }

    public function showSubcategories($category){
        $sub_categories = SubCategory::where('category_id',$category)->get();
        return $sub_categories;
    }

    public function showOrders($sub_category){
        $products = Product::where('sub_category_id',$sub_category)->with('subCategory')->get();
        return $products;
    }

    public function orderPayment($id): View
    {
        $carts = Cart::with('product')->where('user_id',$id)->get();
        return view('admin.order.payment')->with(['carts' => $carts]);
    }

    public function storeOrUpdate(Request $request)
    {
        foreach ($request->cart as $value)
        {
            $order = new Order;
            $order->fill([
                'quantity' => $value['quantity'],
                'date_and_time' => Carbon::now('Asia/Kolkata')->toDateTimeString(),
                'user_id' => $request->user_id,
                'product_id' => $value['product_id'],
                ])->save();

            $payment = new Payment;
            $payment->fill([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'country' => $request->country,
                'state' => $request->state,
                'zip' => $request->zip,
                'total_amount' => $request->total_amount,
                'payment_method' => $request->payment_method,
                'order_id' => $order->id,
            ])->save();
        }
        return Redirect::route('order.order_index');
    }

        public function orderIndex(): View
        {
            return view('admin.order.order_index');
        }
}
