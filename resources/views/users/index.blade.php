@extends('layouts.adminlte')
@section('title', 'Danh sách người dùng')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách người dùng</h3>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tạo người dùng</a>
                </div>
            </div>

            <table id="users-table" class="table table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 140px;"">Tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th style="width: 50px;">Vai trò</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $(document).ready(function() {
    $('#users-table').DataTable({
        "language": {
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            }
        },
        "stripeClasses": [],
        "lengthMenu": [5, 10, 50],
        "pageLength": 5,
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
            "url": "{{ route('users.index') }}",
            "data": function(d) {
                drawDT = d.draw;
                d.limit = d.length;
                d.page = d.start / d.length + 1;
            },
            "dataSrc": function(res) {
                res.draw = drawDT;
                res.recordsTotal = res.meta.total;
                res.recordsFiltered = res.meta.total;
                return res.data;
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name", },
            { "data": "email",},
            { "data": "address" },
            { "data": "created_at",},
            {
                "data": "status",
                "class": "text-center",
                "orderable": false,
                "render": function(data) {
                    if (data == 0) return `<span class="badge bg-secondary">Chờ phê duyệt</span>`;
                    if (data == 1) return `<span class="badge bg-success">Được phê duyệt</span>`;
                    if (data == 2) return `<span class="badge bg-danger">Bị từ chối</span>`;
                    if (data == 3) return `<span class="badge bg-secondary">Bị Khoá</span>`;
                }
            },
            { "data": "role" },
            {
                "data": "id",
                "class": "text-center",
                "orderable": false,
                "render": function(data, type, full) {
                    let urlApprove = `{{ route('users.approve', ':id') }}`.replace(':id', data);
                    let urlReject  = `{{ route('users.reject', ':id') }}`.replace(':id', data);
                    let urlEdit    = `{{ route('users.edit', ':id') }}`.replace(':id', data);
                    let urlBlock   = `{{ route('users.block', ':id') }}`.replace(':id', data);

                    if (full.status == 1) {
                        return `
                            <form action="${urlBlock}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm" title="Khoá">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        style="width: 24px; height: 24px; color: black;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75
                                            11.25h10.5a2.25 2.25 0 0 0
                                            2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25
                                            2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </button>
                            </form>
                        `;
                    }

                    return `
                        <form action="${urlApprove}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px;">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </button>
                        </form>
                        <form action="${urlReject}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px;">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                        <form action="${urlBlock}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    style="width: 24px; height: 24px; color: black;">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75
                                        11.25h10.5a2.25 2.25 0 0 0
                                        2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25
                                        2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </button>
                        </form>
                         <a href="${urlEdit}" class="btn btn-sm" title="Sửa">
                            <svg viewBox="0 0 24 24" width="20" height="28"
                                stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0
                                    0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1
                                    3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </a>
                    `;
                }
            },
        ]
    });     

$('#users-table').on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    let token = $('input[name="_token"]').val();

                    if (confirm('Bạn có chắc muốn xoá?')) {
                        $.ajax({
                            url: '/users/' + id,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            success: function(res) {
                                if (res.success) {
                                    alert(res.message);
                                    // Xoá dòng khỏi DataTable
                                     $("#users-table").DataTable().ajax.reload(null, false);
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