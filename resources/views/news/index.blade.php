@extends('layouts.master')
@section('title', 'Xem bài viết')
@section('content')
    <div class="container mt-3">
        <h1 class="mb-5 pb-3 border-bottom">Danh sách bài viết</h1>
        @foreach ($posts as $post)
            <div class="d-flex mb-4 pb-3 border-bottom">
                <a href="{{ route('news.show', $post->slug) }}">
                    <img src="{{ $post->thumbnail_url }}" class="img-fluid me-3" style="width:200px; height:auto;">
                </a>
                <div>
                    <h3 class="mb-1">{{ $post->title }}</h3>
                    <p class="mb-1">{{ $post->publish_date }}</p>
                    <p class="mb-1">{{ $post->description }}</p>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
