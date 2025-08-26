@extends('layouts.master')
@section('title', 'Xem bài viết')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-9">
                <h1>{{ $post->title }}</h1>
                <h4>{{ $post->description }}</h4>
               {!! $post->content !!}
            </div>
        </div>
    </div>
@endsection
