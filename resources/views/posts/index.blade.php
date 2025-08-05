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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
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
                            @if ($posts->count() > 0)
                                <table id="posts-table" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            @if (auth()->user()->role === 'admin')
                                                <th>User</th>
                                            @endif
                                            <th>Tiêu đề</th>
                                            <th>Mô tả</th>
                                            <th>Ảnh</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                @if (auth()->user()->role === 'admin')
                                                    <td>{{ $post->user->name }}</td>
                                                @endif
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->description }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <img class="w-8 h-8 rounded-ful" style="width: 100px"
                                                        src="{{ $post->thumbnail_url }}" />
                                                </td>

                                                <td>
                                                    @if ($post->status == 0)
                                                        <span class="badge bg-secondary">Bản nháp</span>
                                                    @elseif($post->status == 1)
                                                        <span class="badge bg-success">Đã xuất bản</span>
                                                    @elseif($post->status == 2)
                                                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                                    @endif
                                                </td>

                                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                                <td>

                                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                        style="display:inline"
                                                        onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Xoá">
                                                            <svg viewBox="0 0 24 24" width="20" height="20"
                                                                stroke="currentColor" stroke-width="2" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <polyline points="3 6 5 6 21 6" />
                                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                                <path d="M10 11v6" />
                                                                <path d="M14 11v6" />
                                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <!-- Nút sửa -->
                                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-info"
                                                        title="Sửa">
                                                        <svg viewBox="0 0 24 24" width="20" height="20"
                                                            stroke="currentColor" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                        </svg>
                                                    </a>
                                                    <!-- Nút xem -->
                                                    <a href="{{ route('posts.show', $post) }}"
                                                        class="btn btn-sm btn-secondary" title="Xem">
                                                        <svg viewBox="0 0 24 24" width="20" height="20"
                                                            stroke="currentColor" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg>
                                                    </a>
                                                    <!-- Nút xoá -->
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
            $(document).ready(function() {
                $('#posts-table').DataTable();

            });
        </script>
    @endsection
