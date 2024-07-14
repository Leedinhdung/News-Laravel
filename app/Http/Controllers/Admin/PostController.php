<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Catalogue;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';

    public function index()
    {
        $all = Post::query()->where('is_active', 1)->count('id');
        $trash = Post::onlyTrashed()->count('id');
        $data = Post::query()->where('is_active', 1)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'all', 'trash'));
    }

    public function trash()
    {
        $data = Post::onlyTrashed()->get();
        $all = Post::onlyTrashed()->count('id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCatalogues()
    {
        //Lấy danh sách danh mục trên cơ sở dữ liệu
        $data = Catalogue::query()->where('is_active', 1)->get();
        $listCategory = [];
        //Dùng hàm recursive được tạo trong model catalogue để xử lý dữ liệu và truyền vào các tham số cần thiết
        Catalogue::recursive($data, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    public function create()
    {
        $data = $this->getCatalogues();
        $tags = Tag::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'excerpt' => 'required',
                'content' => 'required',
                'catalogue_id' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại',

            ],
            [
                'title' => 'Tiêu đề',
                'excerpt' => 'Tóm tắt',
                'content' => 'Nội dung',
                'catalogue_id' => 'Danh mục',
            ]
        );
        $data = $request->except('thumbnail');

        $data['is_active'] ??= 0;
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('thumbnail'));
        }
        $list_tag = $request->input('new_tags')['0'];
        $data_list_tag = explode(',', $list_tag);
        $data_tag_id = [];
        try {
            DB::beginTransaction();
            foreach ($data_list_tag as $key => $value) {
                $data_tag_id[] = Tag::query()->create(["name" => $value])->id;
            }

            $post = Post::query()->create($data);
            $post->tags()->sync($data_tag_id);
            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->hasFile('thumbnail')) {
                Storage::delete($request->file('thumbnail'));
            }
            return redirect()->route('admin.post.create')->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function edit(string $id)
    {
        $data = Post::query()->findOrFail($id);

        $listCat = $this->getCatalogues();

        // dd($data);
        return view('admin.posts.edit', compact('listCat', 'data'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate(
            [
                'title' => 'required',
                'excerpt' => 'required',
                'content' => 'required',
                'catalogue_id' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại',
            ],
            [
                'title' => 'Tiêu đề',
                'excerpt' => 'Tóm tắt',
                'content' => 'Nội dung',
                'catalogue_id' => 'Danh mục',
            ]
        );

        // Lấy bản ghi hiện tại từ cơ sở dữ liệu
        $post = Post::findOrFail($id);
        $currentImage = $post->thumbnail; // Lưu lại đường dẫn ảnh hiện tại

        // Lấy dữ liệu từ request ngoại trừ thumbnail
        $data = $request->except('thumbnail');

        // Cập nhật các trường còn lại
        $data['is_active'] ??= 0;
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            // Lưu file ảnh mới
            $data['thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('thumbnail'));
        }

        $list_tag = $request->input('new_tags')[0];
        $data_list_tag = explode(',', $list_tag);
        $data_tag_id = [];

        try {
            DB::beginTransaction();

            // Tạo hoặc lấy các tag
            foreach ($data_list_tag as $key => $value) {
                $data_tag_id[] = Tag::query()->firstOrCreate(["name" => $value])->id;
            }

            // Cập nhật bản ghi post
            $post->update($data);

            // Cập nhật các tag liên quan
            $post->tags()->sync($data_tag_id);

            DB::commit();

            // Xóa file ảnh cũ nếu có file ảnh mới
            if ($request->hasFile('thumbnail')) {
                Storage::delete($currentImage);
            }

            return redirect()->route('admin.post.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            // Xóa file ảnh mới nếu có lỗi xảy ra
            if ($request->hasFile('thumbnail')) {
                Storage::delete($data['thumbnail']);
            }

            return redirect()->route('admin.post.edit', $post->id)->with('error', $e->getMessage());
        }
    }


    public function delSoft(string $id)
    {
        $post = Post::query()->findOrFail($id);
        $post->update(['is_active' => false]);
        $post->delete();
        return back();
    }

    public function restore(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        // dd($post);
        $post->update(['is_active' => true]);
        $post->restore();
        return redirect()->route('admin.post.trash')->with('success', 'Khôi phục thành công!');
    }

    public function destroy(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        if ($post->thumbnail && Storage::exists($post->thumbnail)) {
            Storage::delete($post->thumbnail);
        }
        return back();
    }
}
