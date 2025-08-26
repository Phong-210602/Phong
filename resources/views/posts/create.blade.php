@extends('layouts.adminlte')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Tạo bài viết</h3>
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
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3"> 
                        <label class="form label" style="margin-left: 20px;">Ảnh</label> <br>
                         <input type="file" id="image" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Mô tả <span class="text-danger">*</span></label>
                            <textarea class="form-control" placeholder="Nhập mô tả" name="description" rows="3">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="content">Nội dung <span class="text-danger">*<span></label>
                            <textarea id="content" class="form-control" placeholder="Nhập nội dung" name="content" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="publish_date">Ngày xuất bản <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="publish_date" value="{{ old('publish_date') }}">
                        </div>
                    </div>
                    <div class="card-footer mb-3">
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