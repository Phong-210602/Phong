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
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Vai trò</th>
                        @if (auth()->user()->role === 'admin')
                            {{-- Kiểm tra nếu người dùng hiện tại vai trò là admin sẽ hiện cột thao tác --}}
                            <th>Thao tác</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                @switch($user->status->value)
                                    @case(0)
                                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                    @break

                                    @case(1)
                                        <span class="badge bg-success">Đã duyệt</span>
                                    @break

                                    @case(2)
                                        <span class="badge bg-danger">Bị từ chối</span>
                                    @break

                                    @case(3)
                                        <span class="badge bg-secondary">Bị khoá</span>
                                    @break
                                @endswitch
                            </td>
                            <td>{{ $user->role }}</td>
                            @if (auth()->user()->role === 'admin')
                                <td>
                                    @if ($user->status->value === App\Enums\UserStatus::PENDING->value)
                                        <form action="{{ route('users.approve', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Phê duyệt
                                            </button>
                                        </form>

                                    @elseif($user->status->value === App\Enums\UserStatus::REJECTED->value)
                                                          {{-- dd(123); --}}
                                        <form action=" {{ route('users.reject', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                        </form>

                                    @elseif($user->status->value === App\Enums\UserStatus::BLOCKED->value)
                                        <form action="{{ route('users.block', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-ban"></i> Khoá
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
@section('scripts')
    <script>
        $('#users-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "language": {
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
            }
        });
    </script>
@endsection
