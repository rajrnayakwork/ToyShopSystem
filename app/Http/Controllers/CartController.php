<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function index(){
        $id = Auth::user()->id;
        $check_carts = Cart::where('user_id',$id)->with('product')->get();
        foreach ($check_carts as $cart) {
            if($cart->product->quantity == 0){
                Cart::where('id',$cart->id)->delete();
            }
            // elseif(){

            // }
        }
        $carts = Cart::where('user_id',$id)->with('product')->get();
        return $carts;
    }

    public function storeOrUpdate(Request $request){
        $cart = Cart::updateOrCreate(['user_id' => $request->user_id,'product_id' => $request->product_id],
            ['quantity' => $request->quantity]);
        return $cart;
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return Redirect::back();
    }
}
