<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function check(){
        if (Auth::check()) {
            if (Auth::user()->role_type == 1) {
                return redirect()->route('admin.dashboard')->withSuccess('You have Successfully loggedin');
            }else{
                return Redirect::route('login');
                // return redirect()->route('user.index',[Auth::user()->student_id])->withSuccess('You have Successfully loggedin');
            }
        }else{
            return Redirect::route('login');
        }
    }

    public function login(){
        if (!Auth::check()) {
            return view('login');
        }else{
            return Redirect::back();
        }
    }

    public function loginPost(Request $request){
        $credentials = $request->validate([
            'email' => 'bail|required|email|max:250',
            'password' => 'bail|required|min:6',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->check();
        }else {
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
    }

    public function logout(){
        if (Auth::check()) {
            Auth::logout();
            Session()->flush();
            Session()->regenerate();
            return redirect()->route('login');
        }
        return redirect()->back();
    }

}
