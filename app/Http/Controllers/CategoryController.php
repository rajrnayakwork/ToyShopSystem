<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('branch')->get();
        return view('admin.category.index')->with(['categories' => $categories]);
    }

    public function create(): View
    {
        $branches = Branch::all();
        return view('admin.category.create')->with(['branches' => $branches]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'branch' => 'bail|required',
            'name' => 'bail|required|unique:categories|string|regex:/^[a-zA-Z ]+$/u|max:250',
            'subCategoryName' => 'bail|required|array|min:1',
            'subCategoryName.*' => 'bail|required|string|regex:/^[a-zA-Z ]+$/u|max:250',
        ]);
        dd($request->toArray());
        $category = new Category;
        $category->fill([
            'branch_id' => $request->branch,
            'name' => $request->name,
        ])->save();
        return Redirect::route('category.index');
    }
}
