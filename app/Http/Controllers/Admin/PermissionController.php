<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::query()->get();
        $user = User::find(1);
        //Lấy ra danh ssasch permissions 
        // dd($user->hasPermission('post.create'));
        // if (!$user->hasPermission('post.create')) {
        //     abort(403);
        // }
        $list_permission = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.permissions.create', compact('permissions', 'list_permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->slug,
        ];
        // dd($data);
        Permission::create($data);
        return back()->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_permission = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $permissionID = Permission::query()->findOrFail($id);
        return view('admin.permissions.edit', compact('list_permission', 'permissionID'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::query()->findOrFail($id);
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->slug,
        ]);
        return redirect()->route('admin.permission.create')->with('success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::query()->findOrFail($id);
        $permission->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
