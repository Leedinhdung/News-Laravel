<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_UPLOAD = 'users';
    public function index()
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();


        $menu->each(function ($item) use ($menu) {
            $item->has_children = $menu->where('parent_id', $item->id)->isNotEmpty();
        });

        //        dd($menu);
        $post = Post::query()->where([['is_active', 1]])->limit(4)->get();
        $date = Post::query()->first();
        //        dd($post);
        $formattedDate = Carbon::parse($date->created_at)->format('d/m/Y');
        $latestPost = Post::query()->where([['is_active', 1]])->latest()->first();
        $latestRecords = Post::query()->where('created_at', '<', $latestPost->created_at)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        //        dd($latestRecords);
        //        dd($formattedDate);
        return view('client.pages.home', compact('menu', 'post', 'formattedDate', 'latestPost', 'latestRecords'));
    }

    public function PostByCatalogue($id)
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();
        $menu->each(function ($item) use ($menu) {
            $item->has_children = $menu->where('parent_id', $item->id)->isNotEmpty();
        });

        $catalogue = Catalogue::query()->findOrFail($id);
        $post = Post::query()->where('catalogue_id', $id)->get();
        $date = Post::query()->first();
        $formattedDate = Carbon::parse($date->created_at)->format('d/m/Y');
        //        dd($post);
        return view('client.pages.postcatalogue', compact('post', 'menu', 'catalogue', 'formattedDate'));
    }

    public function detailPost($id)
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();
        $menu->each(function ($item) use ($menu) {
            $item->has_children = $menu->where('parent_id', $item->id)->isNotEmpty();
        });

        $post = Post::query()->where([['is_active', 1]])->findOrFail($id);
        $tags = Post::query()->findOrFail($id);
        $date = Post::query()->first();
        $relatedPosts = Post::where('catalogue_id', $post->catalogue_id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();
        // dd($relatedPosts);
        $formattedDate = Carbon::parse($date->created_at)->format('d/m/Y');
        //        dd($tags);
        $tagss = explode(',', $post->tags);
        //        dd($tagss);
        //        dd($post);

        return view('client.pages.detail', compact('post', 'menu', 'tagss', 'formattedDate', 'relatedPosts'));
    }

    public function contact()
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();
        return view('client.pages.contact', compact('menu'));
    }
    public function searchNews(Request $request)
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();
        $menu->each(function ($item) use ($menu) {
            $item->has_children = $menu->where('parent_id', $item->id)->isNotEmpty();
        });

        $post = Post::query()->where([['is_active', 1]])->get();
        $date = Post::query()->first();

        $formattedDate = Carbon::parse($date->created_at)->format('d/m/Y');

        $key = $request->input('key');

        // Sử dụng Eloquent ORM để tìm kiếm các bài viết
        $searched = Post::where('title', 'LIKE', "%{$key}%")
            ->orWhere('content', 'LIKE', "%{$key}%")
            ->get();
        // dd($searched);
        return view('client.pages.search', compact('post', 'menu', 'formattedDate', 'searched'));
    }
    public function comment(Request $request, $id)
    {
        // dd($request->all());
        // $request->validate([
        //     [
        //         'content' => 'required',
        //     ],
        //     [
        //         'required' => ':attribute không được để trống',
        //     ],
        //     [
        //         'content' => 'Nội dung',
        //     ]
        // ]);

        Comment::query()->create([
            'post_id' => $id,
            'content' =>  $request->content,
            'author' => Auth::user()->id,
        ]);

        return back();
    }
    public function incrementView(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $post->views += 1;
            $post->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function showProfile()
    {
        $menu = Catalogue::query()->where([['is_active', 1]])->get();
        $menu->each(function ($item) use ($menu) {
            $item->has_children = $menu->where('parent_id', $item->id)->isNotEmpty();
        });

        $user = auth()->user();
        return view('client.pages.profile', compact('user', 'menu'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put('users', $request->file('thumbnail'));
        }
        // dd($data);
        $currentImage = $user->thumbnail;
        $user->update($data);
        if ($request->hasFile('thumbnail') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        // dd($request->all());
        return redirect()->route('profile')->with('success', 'Thông tin cá nhân đã được cập nhật.');
    }
}
