<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::with('role')->get();
        // dd($permission->toArray());
        return view('admin.permission.index')->with(['permissions' => $permissions]);
    }

    public function edit(Permission $permission){
        return view('admin.permission.edit')->with(['permission' => $permission]);
    }

    public function storeOrUpdate(Request $request,Permission $permission){
        dump($request->toArray());
        dd($permission->toArray());
        $permission->fill([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ])->save();
        $permission->role()->attach($request->role);

        return Redirect::route('permission.index');
    }
}
