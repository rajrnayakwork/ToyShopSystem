<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){
        $carts = Cart::with('product')->get();
        return $carts;
    }

    public function storeOrUpdate(Request $request,Cart $cart){
        $cart_data = Cart::updateOrCreate(['id' => $cart->id],
            ['quantity' => $request->quantity,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id]);
        return $cart_data;
    }
}
