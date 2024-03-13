<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.product.index');
    }

    public function create(): View
    {
        return view('admin.product.create');
    }
}
