<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $vendors = Vendor::count();
        $categories = Category::count();
        $sub_categories = SubCategory::count();
        $products = Product::count();
        $orders = Order::count();
        $carts = Cart::count();

        $data = ['labels' => [],
            'data' => [],
        ];
        $amount_data = ['labels' => [],
            'data' => [],
        ];

        $users = User::all();
        foreach ($users as $user) {
            $all_orders = Order::where('user_id',$user->id)->with(['user','product'])->get();

            $user_data = $total_orders = $total_amount = null;
            foreach ($all_orders as $order) {
                $total_orders += $order->quantity;
                $total_amount += $order->product->price * $order->quantity;
            }

            $user_data = [
                'user_id'=> $user->id, 'user_name'=> $user->user_name,
                'total_orders'=> $total_orders, 'total_amount'=> $total_amount,
            ];

            $data['labels'][] = $user_data['user_name'];
            $data['data'][] = $user_data['total_orders'];

            $amount_data['labels'][] = $user_data['user_name'];
            $amount_data['data'][] = $user_data['total_amount'];
        }

        return view('admin.dashboard')
        ->with([
            'vendors'=>$vendors,
            'categories'=>$categories,
            'sub_categories'=>$sub_categories,
            'products'=>$products,
            'orders'=>$orders,
            'carts'=>$carts,
            'data' => $data,
            'amount_data' => $amount_data,
        ]);
    }
}
