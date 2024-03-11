<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
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

    Route::group(['prefix' => 'branch','middleware' => ['role:admin']],function(){
        Route::get('/',[BranchController::class,'index'])->name('branch.index');
        Route::get('/create',[BranchController::class,'create'])->name('branch.create');
        Route::post('/',[BranchController::class,'store'])->name('branch.store');
        Route::get('/{branch}/edit',[BranchController::class,'edit'])->name('branch.edit');
        Route::post('/update',[BranchController::class,'update'])->name('branch.update');
        Route::get('/{branch}',[BranchController::class,'destroy'])->name('branch.destroy');
    });
    Route::group(['prefix' => 'category','middleware' => ['role:admin']],function(){
        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/',[CategoryController::class,'store'])->name('category.store');
        Route::get('/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');
        Route::get('/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
    });
});
