<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,'check'])->name('check');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginPost'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['prefix' => 'admin','middleware' => ['role:admin']],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'vendor','middleware' => ['role:admin']],function(){
        Route::get('/',[VendorController::class,'index'])->name('vendor.index');
        Route::get('/create',[VendorController::class,'create'])->name('vendor.create');
        Route::post('/',[VendorController::class,'store'])->name('vendor.store');
        Route::get('/{vendor}/edit',[VendorController::class,'edit'])->name('vendor.edit');
        Route::post('/update',[VendorController::class,'update'])->name('vendor.update');
        Route::get('/{vendor}',[VendorController::class,'destroy'])->name('vendor.destroy');
    });

    Route::group(['prefix' => 'category','middleware' => ['role:admin']],function(){
        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/',[CategoryController::class,'store'])->name('category.store');
        Route::get('/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');
        Route::get('/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
    });

    Route::group(['prefix' => 'product','middleware' => ['role:admin']],function(){
        Route::get('/',[ProductController::class,'index'])->name('product.index');
        Route::get('/create',[ProductController::class,'create'])->name('product.create');
        Route::post('/',[ProductController::class,'store'])->name('product.store');
        Route::get('/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
        Route::post('/update',[ProductController::class,'update'])->name('product.update');
        Route::get('/{product}',[ProductController::class,'destroy'])->name('product.destroy');
    });
});
