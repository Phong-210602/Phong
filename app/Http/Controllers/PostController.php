<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Hiển thị danh sách bài viết
    {
        // $posts = Post::with('user')->latest()->paginate(10);
        //  $posts = Post::all();
        // $posts = auth()->user()->posts;
        /**
         * @var \App\Models\User $user
         */
        if (auth()->user()->role === 'admin') {
            // Admin xem tất cả
            $posts = Post::all();
        } else {
            // User thường chỉ xem bài viết của chính mình
            $posts = auth()->user()->posts;
        }

        $draftPosts = Post::draft()->get();
        $publicshedPosts = Post::published()->get();
        $pendingPosts = Post::pending()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // Hiển thị form tạo bài viết 
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request) // Lưu bài viết mới
    {
        // Tạo bài viết với dữ liệu đã validate từ FormRequest
        $post = Post::create(array_merge( // được dùng để tạo bài viết mới, kết hợp dữ liệu từ form đã được kiểm tra (validated) với các dữ liệu thêm như user_id và slug.
            $request->validated(),
            [
                'user_id' => auth()->id(),
                'slug' => Str::slug($request->title)
            ]
        ));

        // Gắn ảnh từ form nếu có
        if ($request->hasFile('image')) { // kiểm tra form có upload ảnh không, nếu có thì
            $post->addMediaFromRequest('image')
                ->usingName('Bài viết của tôi ')
                ->toMediaCollection();
        }

        return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Hiển thị form sửa bài viết
    public function edit(Post $post)
    {
        // Chỉ cho phép admin hoặc chủ bài viết
        if (auth()->user()->role !== 'admin' && $post->user_id != Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền sửa bài viết này.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Cập nhật bài viết
    public function update(Request $request,  Post $post)
    {
        // Kiểm tra quyền sửa - chỉ cho phép sửa bài viết
        if ($post->user_id != Auth::id()) {
            return redirect()->route('posts.index');
        }

        // Kiểm tra dữ liệu
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable|max:200',
            'content' => 'required',
        ]);

        // Cập nhật bài viết
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'status' => 1,
        ]);
        return redirect()->route('posts.index')->with('success', 'Cập nhập bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // xoá bài viết
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Xoá bài viết thành công!');
    }
    public function destroyAll()
    {
        // dd(123);
        $user = Auth::user();

        // Dùng relationship để xoá toàn bộ bài viết của user hiện tại
        $user->posts()->delete();

        return redirect()->route('posts.index')->with('success', 'Đã xoá tất cả bài viết của bạn.');
    }
}
