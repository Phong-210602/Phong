@extends('layouts.adminlte')
{{-- @extends('layouts.master') --}}
@section('title', 'Trang chủ')
{{-- @section('content_header', 'Dashboard') --}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tiêu đề</h3>
            <td>{{ $post->title }}</td>
            <td>{!! $post->content !!}</td>
        </div>
    </div>
@endsection
