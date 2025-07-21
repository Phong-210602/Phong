<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'requered|in:draft,published'
        ]);

        Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'slug' => Str::slug($request->title),
        'status' => $request->status,
        'user_id' => auth()->id()
    ]);

    return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

}

