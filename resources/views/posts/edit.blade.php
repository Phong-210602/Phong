@extends('layouts.adminlte')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa bài viết</h1>
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

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 px-3 pt-3">
                            <label class="form-label mb-3">Ảnh</label> <br>
                            @if ($post->thumbnail_url)
                                <div class="mb-2">
                                    <img src="{{ $post->thumbnail_url }}" alt="Thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                            <input type="file" id="image" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Nhập tiêu đề" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (auth()->user()->role === 'admin')
                                <div class="form-group mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status">
                                        <option value="{{ App\Enums\PostStatus::DRAFT->value }}"
                                            {{ $post->status == App\Enums\PostStatus::DRAFT->value ? 'selected' : '' }}>Bài
                                            viết mới</option>
                                        <option value="{{ App\Enums\PostStatus::PUBLISHED->value }}"
                                            {{ $post->status == App\Enums\PostStatus::PUBLISHED->value ? 'selected' : '' }}>
                                            Chờ duyệt </option>
                                        <option value="{{ App\Enums\PostStatus::PENDING->value }}"
                                            {{ $post->status == App\Enums\PostStatus::PENDING->value ? 'selected' : '' }}>
                                            Được duyệt</option>

                                        {{-- <option value="" {{ $post->status == 2 ? 'selected' : '' }}>Đã xuất bản</option>
                                    <option value="" {{ $post->status == 3 ? 'selected' : '' }}>Chờ duyệt</option> --}}
                                    </select>
                                </div>
                            @endif

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
                                <label>Ngày xuất bản</label>
                                <input type="datetime-local" class="form-control" name="publish_date"
                                    value="{{ old('publish_date', $post->publish_date ?? '') }}">
                            </div>
                        </div>

                        <div class="card-footer mb-3">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            $('#content').summernote({});
        });
    </script>
@endsection
