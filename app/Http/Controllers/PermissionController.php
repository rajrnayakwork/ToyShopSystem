<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::with('role')->get();
        $permission_group = [];
        $count = 0;


        foreach ($permissions as $index => $permission_value)
        {
            $permission_role = $category_permission = [];
            $role_count = 0;

            foreach ($roles as $key => $value) {
                foreach ($permission_value->role as $role_value)
                {
                    if ($value->id == $role_value->id) {
                        $role['id'] = $role_value->id;
                        $role['name'] = $role_value->name;
                        $role['has_permission'] = true;
                        $permission_role[$role_count] = $role;
                        $role_count++;
                    }
                }
                if ($role_count <= $key) {
                    $role['id'] = $value->id;
                    $role['name'] = $value->name;
                    $role['has_permission'] = false;
                    $permission_role[$role_count] = $role;
                    $role_count++;
                }
            }

            $permission['id'] = $permission_value->id;
            $permission['name'] = $permission_value->name;
            $permission['display_name'] = $permission_value->display_name;
            $permission['roles'] = $permission_role;
            $category_permission[] = $permission;

            if ($permission_group == null || $permission_value->category != $permission_group[$count-1]['category'])
            {
                $row['category'] = $permission_value->category;
                $row['permissions'] = $category_permission;
                $permission_group[$count] = $row;
                $count++;
            }else
            {
                $permission_group[$count-1]['permissions'][] = $permission;
            }

        }
        return view('admin.permission.index')->with(['permission_group' => $permission_group,'roles' => $roles]);
    }

    public function edit()
    {
        return view('admin.permission.edit');
    }

    public function storeOrUpdate(Request $request)
    {
        foreach ($request->role_permission as $key => $value) {
            $role = Role::find($key);
            $role->permission()->sync($value);
        }
        return Redirect::route('permission.index');
    }
}
