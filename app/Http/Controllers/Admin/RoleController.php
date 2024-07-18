<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $list_permission = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });

        return view('admin.roles.create', compact('list_permission'));
    }
    public function store(Request $request)
    {
        $role = Role::query()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('admin.role.index')->with('success', 'Thêm quyền thành công');
    }
    public function edit($id)
    {
        $role = Role::query()->with('permissions')->findOrFail($id);

        // $permissionChecked = $role->permissions;
        $list_permission = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        // dd($permissionChecked);
        return view('admin.roles.edit', compact('role', 'list_permission'));
    }
    public function update(Request $request, $id)
    {
        $role = Role::query()->findOrFail($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.role.index')->with('success', 'Cập nhật quyền thành công');
    }
    public function destroy($id)
    {
        Role::query()->findOrFail($id)->delete();
        return redirect()->route('admin.role.index')->with('success', 'Xóa quyền thành công');
    }
}
