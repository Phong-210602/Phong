<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() // Hiển thị danh sách bài viết
    {
        // $posts = Post::with('user')->latest()->paginate(10);
         $posts = Post::all();

        $draftPosts = Post::draft()->get();
        $publicshedPosts = Post::published()->get();
        $pendingPosts = Post::pending()->get();
        return view('posts.index', compact('posts'));
    }

    public function create() // Hiển thị form tạo bài viết 
    {
        return view('posts.create');
    }

    public function store(Request $request) // Lưu bài viết mới
    {
        $request->validate([ // kiểm tra dữ liệu
            'title' => 'required|string|max:100',
            'desctiption' => 'nullable|max:200',
            'content' => 'required',
        ]);

        Post::create([ // Tạo bài viết cho user đang login
        'user_id' => auth()->id(), // gán user_id là user đang login
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'content' => $request->content,
        'publish_date' => $request->publish_date,
        'status' => 0,
        
    ]);

    return redirect()->route('posts.index')->with('success', 'Tạo bài viết thành công!');
    }

    // Hiển thị form sửa bài viết
    public function edit(Post $post)
    {
        // kiểm tra quyền sửa
        if ($post->user_id != Auth::id() ){
            return redirect()->route('posts.index');
        }
        return view('posts.edit', compact('post'));
    }
    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        // Kiểm tra quyền sửa - chỉ cho phép sửa bài viết 
        if ($post->user_id != Auth::id() ) {
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
    // xoá bài viết
    public function destroy(Post $post) 
    {
        // kiểm tra quyền xoá - chỉ cho phép xoá bài viết của mình
        // if ($post->user_id != Auth::id() ){
        //     return redirect()->route('posts.index')->with('error', "Bạn không có quyền xoá bài viết này!");

        // }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Xoá bài viết thành công!');
    }
}

