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
                            {{-- @if ($posts->count() > 0) --}}
                            <div class="mb-3">
                                <form action="{{ route('posts.destroyAll') }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xoá tất cả bài viết?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Xoá tất cả bài viết
                                    </button>
                                </form>
                            </div>
                            <table id="posts-table" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Tiêu đề</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#posts-table').DataTable({
                    "language": {
                        "paginate": {
                            "first": "Đầu",
                            "last": "Cuối",
                            "next": "Sau",
                            "previous": "Trước"
                        },
                    },
                    "stripeClasses": [],
                    "lengthMenu": [5, 10, 50],
                    "pageLength": 1,
                    "processing": true,
                    "serverSide": true,
                    "ordering": true,
                    "ajax": {
                        "url": "{{ route('posts.index') }}",
                        "data": function(d) {
                            // console.log("Lượt vẽ trước khi gửi AJAX:", d.draw);
                            drawDT = d.draw;
                            // console.log("Số bản ghi mỗi trang (d.length):", d.length);
                            // console.log("Tham số limit gửi đến server:", d.limit);
                            d.limit = d.length;
                            d.page = d.start / d.length + 1;
                            // console.log("d.start:", d.start);
                            // console.log("Số bản ghi mỗi trang (d.length):", d.length);
                            // console.log("Số trang hiện tại (d.page):", d.page);
                            // d.status = 'abc';
                        },
                        "dataSrc": function(res) {
                            res.draw = drawDT;
                            res.recordsTotal = res.meta.total;
                            res.recordsFiltered = res.meta.total;
                            return res.data;
                        }
                    },
                    "columns": [{
                            "data": "thumbnail",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                return `<img class="w-8 h-8 rounded-ful" style="width: 100px"
                                                        src="${data}" />`;
                            }
                        },
                        {
                            "data": "id"
                        },
                        {
                            "data": "user",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                return `${data}`;
                            }

                        },
                        {
                            "data": "title",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                return data;
                            }

                        },
                        {
                            "data": "description",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                return data;
                            }

                        },
                        {
                            "data": "status",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                if (data == 0)
                                    return `<span class="badge bg-secondary">Bài viết mới</span>`;
                                else if (data == 1)
                                    return `<span class="badge bg-success">Chờ duyệt</span>`;
                                else if (data == 2)
                                    return `<span class="badge bg-warning text-dark">Được duyệt</span>`;

                            }

                        },
                        {
                            "data": "created_at",

                        },
                        {
                            "data": "id",
                            "class": "text-center",
                            "orderable": true,
                            "render": function(data, type, full) {
                                let urlEdit = `{{ route('posts.edit', ':id') }}`.replace(':id', data);
                                let urlShow = `{{ route('posts.show', ':id') }}`.replace(':id', data);

                                return `
                            <button type="button" class="btn delete-btn"
                                                        data-id="${data}" title="Xoá">
                                                        <svg viewBox="0 0 24 24" width="20" height="27"
                                                            stroke="currentColor" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6" />
                                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                            <path d="M10 11v6" />
                                                            <path d="M14 11v6" />
                                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                        </svg>
                                                    </button>


                                                    <a href="${urlEdit}" class="btn btn-sm"
                                                        title="Sửa">
                                                        <svg viewBox="0 0 24 24" width="20" height="28"
                                                            stroke="currentColor" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                        </svg>
                                                    </a>

                                                    <a href="${urlShow}"
                                                        class="btn btn-sm" title="Xem">
                                                        <svg viewBox="0 0 24 24" width="20" height="28"
                                                            stroke="currentColor" stroke-width="2" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                            <circle cx="12" cy="12" r="3" />
                                                        </svg>
                                                    </a>   
                            `;
                            }
                        }
                    ]

                });

                $('#posts-table').on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    let token = $('input[name="_token"]').val();

                    if (confirm('Bạn có chắc muốn xoá?')) {
                        $.ajax({
                            url: '/posts/' + id,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            success: function(res) {
                                if (res.success) {
                                    alert(res.message);
                                    // Xoá dòng khỏi DataTable
                                    $("#posts-table").DataTable().ajax.reload(null, false);
                                } else {
                                    alert('Không thể xoá bài viết');
                                }
                            },
                        });
                    }
                });

            });
        </script>
    @endsection
