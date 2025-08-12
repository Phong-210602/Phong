{{-- filepath: c:\Users\nguye\OneDrive\Desktop\Phong\laravel2\resources\views\users\index.blade.php --}}
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
        <div class="card-body">
            {{-- <table class="table table-bordered table-hover"> --}}
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Vai trò</th>
                        {{-- @if (auth()->user()->role === 'admin') --}}
                        {{-- Kiểm tra nếu người dùng hiện tại vai trò là admin sẽ hiện cột thao tác --}}
                        <th>Thao tác</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $user) --}}
                    {{-- <tr> --}}
                    {{-- <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td> --}}
                    {{-- @switch($user->status)
                                    @case(\App\Enums\UserStatus::PENDING)
                                        <span class="badge bg-warning text-dark">{{ $user->status->getLabel() }}</span>
                                    @break

                                    @case(\App\Enums\UserStatus::APPROVED)
                                        <span class="badge bg-success">{{ $user->status->getLabel() }}</span>
                                    @break

                                    @case(\App\Enums\UserStatus::REJECTED)
                                        <span class="badge bg-danger">{{ $user->status->getLabel() }}</span>
                                    @break

                                    @case(\App\Enums\UserStatus::BLOCKED)
                                        <span class="badge bg-secondary">{{ $user->status->getLabel() }}</span>
                                    @break
                                @endswitch --}}
                    {{-- </td> --}}
                    {{-- <td>{{ $user->role }}</td>
                            @if (auth()->user()->role === 'admin')
                                <td>
                                    @if ($user->status === App\Enums\UserStatus::PENDING)
                                        {{-- Phê duyệt --}}
                    {{-- <form action="{{ route('users.approve', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form> --}}

                    {{-- Từ chối --}}
                    {{-- <form action="{{ route('users.reject', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form> --}}

                    {{-- Khoá --}}
                    {{-- <form action="{{ route('users.block', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    style="width: 24px; height: 24px; color: black;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75
                                                            11.25h10.5a2.25 2.25 0 0 0
                                                            2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25
                                                            2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                </svg>
                                            </button> --}}

                    {{-- </form> --}}
                    {{-- @endif --}}
                    {{-- </td> --}}
                    {{-- @endif --}}
                    {{-- </tr> --}}
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

@stop
@section('scripts')
    <script>
        $('#users-table').DataTable({
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
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "{{ route('users.index') }}",
                "data": function(d) {
                    drawDT = d.draw;    // Lưu số draw hiện tại = 5 vào biến drawDT
                    d.limit = d.length; // Tạo trường limit = 10 (số bản ghi trên 1 trang)
                    d.page = d.start / d.length + 1; // Tính số trang (ví dụ start=10, length=5 => page=3)
                },
                "dataSrc": function(res) {
                    res.draw = drawDT; // Gán lại biến draw cho DataTables nhận biết
                    res.recordsTotal = res.meta.total; // Tổng số bản ghi toàn bộ (cho phân trang)
                    res.recordsFiltered = res.meta.total; // Tổng số bản ghi sau lọc (ở đây bằng total)
                    return res.data;     // Trả về mảng dữ liệu người dùng để hiển thị
                }
            },
            "columns": [
                {
                    "data": "id"
                },
                {
                    "data": "name",
                    "class": "text-center",
                    "orderable": false,
                    "render": function(data, type, full) {
                        return `${data}`;
                    }

                },
                {
                    "data": "email"
                },
                {
                    "data": "address"
                },
                {
                    "data": "status",
                    "class": "text-center",
                    "orderable": false,
                    "render": function(data, type, full) {
                        if (data == 0)
                            return `<span class="badge bg-secondary">Chờ phê duyệt</span>`;
                        else if (data == 1)
                            return `<span class="badge bg-success">Được phê duyệt</span>`;
                        else if (data == 2)
                            return `<span class="badge bg-danger">Bị từ chối</span>`;
                        else if (data == 3)
                            return `<span class="badge bg-secondary">Bị Khoá</span>`;
                    }
                },
                {
                    "data": "role"
                },
                {
                    // "data": "id" nghĩa là hàm render sẽ nhận data = giá trị cột id của bản ghi hiện tại.
                    "data": "id",
                    "class": "text-center",
                    "orderable": false,
                    "render": function(data, type, full) {
                        let urlApprove = `{{ route('users.approve', ':id') }}`.replace(':id', data);
                        let urlReject = `{{ route('users.reject', ':id') }}`.replace(':id', data);
                        let urlBlock = `{{ route('users.block', ':id') }}`.replace(':id', data);
                        if (full.status == 1) { // Đã phê duyệt
                            return `
            <form action="${urlBlock}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm" title="Khoá">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        style="width: 24px; height: 24px; color: black;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75
                        11.25h10.5a2.25 2.25 0 0 0
                        2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25
                        2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </button>
            </form>
        `;
                        } else {
                            return `
            <form action="${urlApprove}" method="POST" style="display:inline;">
                     @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        style="width: 24px; height: 24px;">
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
                                        stroke-width="1.5" stroke="currentColor"
                                        style="width: 24px; height: 24px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18 18 6M6 6l12 12" />
                                </svg>
                </button>
            </form>
            <form action="${urlBlock}" method="POST"
                                        style="display:inline;">
                    @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            style="width: 24px; height: 24px; color: black;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75
                                            11.25h10.5a2.25 2.25 0 0 0
                                            2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25
                                            2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                </button>
            </form>
        `;
                        }

                    }
                }
            ]
        });
    </script>
@endsection
