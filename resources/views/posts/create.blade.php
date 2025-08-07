@extends('layouts.adminlte')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo bài viết mới</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin bài viết</h3>
                </div>
                {{-- <form action="{{ route('posts.store') }}" method="POST"> --}}
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3"> 
                        <label class="form label">Thumbnail</label> <br>
                         <input type="file" id="image" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tiêu đề*</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            {{-- <input type="text" class="form-control" name="title"> --}}
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mô tả*</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                            {{-- <input type="text" class="form-control" name="description" value="{{ old('description') }}" required> --}}

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nội dung*</label>
                            {{-- <textarea class="form-control" name="content" rows="10" required>{{ old('content') }}</textarea> --}}
                            <textarea id="content" class="form-control" name="content" rows="10" required>{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" name="publish_date" value="{{ old('publish_date') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tạo bài viết</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#content').summernote({
        });
    });
</script>
@endsection