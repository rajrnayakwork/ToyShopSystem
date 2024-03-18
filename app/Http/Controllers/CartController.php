<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function index(){
        $carts = Cart::with('product')->get();
        return $carts;
    }

    public function storeOrUpdate(Request $request,Cart $cart){
        $cart->fill([
                'quantity' => $request->quantity,
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ])->save();
        return $cart;
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return Redirect::back();
    }
}
