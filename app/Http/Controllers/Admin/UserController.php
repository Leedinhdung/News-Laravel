<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.user.';
    const PATH_UPLOAD = 'users';

    public function index()
    {
        $data = User::query()->with('roles')->where('is_active', 1)->get();
        // dd($data);
        $all = User::query()->where('is_active', 1)->count('id');
        $trash = User::onlyTrashed()->count('id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'trash', 'all'));
    }
    public function trash()
    {

        $data = User::onlyTrashed()->get();
        $all = User::onlyTrashed()->count('id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'all'));
    }

    public function create()
    {
        $role = Role::all();
        //        dd($role);
        return view(self::PATH_VIEW . __FUNCTION__, compact('role'));
    }

    public function store(Request $request)
    {
        try {
            //Trường hợp 1 trong 2 cái bị lỗi thì cả cái hợp lệ sẽ không bị thêm vào db

            DB::beginTransaction();
            $data = $request->except('thumbnail');
            $data['password'] = bcrypt($request->password);
            $data['type'] = 'admin';
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('thumbnail'));
            }
            $user = User::query()->create($data);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Thêm tài khoản thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.user.create')->with('error', $e->getMessage());
        }
        //        dd('abc');
    }
    public function delSoft(string $id)
    {
        $post = User::query()->findOrFail($id);
        $post->update(['is_active' => false]);
        $post->delete();
        return back();
    }

    public function restore(string $id)
    {
        $post = User::onlyTrashed()->findOrFail($id);
        // dd($post);
        $post->update(['is_active' => true]);
        $post->restore();
        return redirect()->route('admin.post.trash')->with('success', 'Khôi phục thành công!');
    }

    public function destroy(string $id)
    {
        $post = User::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        if ($post->thumbnail && Storage::exists($post->thumbnail)) {
            Storage::delete($post->thumbnail);
        }
        return back();
    }
}
