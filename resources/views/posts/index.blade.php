    @extends('layouts.adminlte')

    @section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách bài viết</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bài viết của tôi</h3>
                        <div class="card-tools">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                Tạo bài viết mới
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($posts->count() > 0)
                            <table id="posts-table" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>
                                            @if($post->status == 0)
                                                <span class="badge bg-secondary">Bản nháp</span>
                                            @elseif($post->status == 1)
                                                <span class="badge bg-success">Đã xuất bản</span>
                                            @elseif($post->status == 2)
                                                <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-info">Sửaaa</a>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-4">
                                <p>Bạn chưa có bài viết nào.</p>
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">Tạo bài viết đầu tiên</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#posts-table').DataTable();
        
    });
</script>
@endsection
