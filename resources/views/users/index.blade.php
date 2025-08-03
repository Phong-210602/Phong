{{-- filepath: c:\Users\nguye\OneDrive\Desktop\Phong\laravel2\resources\views\users\index.blade.php --}}
@extends('layouts.adminlte')
{{-- @extends('adminlte::page') --}}
@section('title', 'Danh sách người dùng')
@section('content')
    @if(session('success'))
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
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Vai trò</th>
                        @if(auth()->user()->role === 'admin') {{-- Kiểm tra nếu người dùng hiện tại vai trò là admin sẽ hiện cột thao tác --}}
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
                            @if(auth()->user()->role === 'admin')
                                <td>
                                    @if($user->status->value === 0)
                                        <form action="{{ route('users.approve', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Duyệt
                                            </button> 
                                        </form>   
                                        <form action=" {{ route('users.reject', $user->id) }}" method="POST" style="display: inline;">    
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Từ chối
                                            </button>
                                        </form>
                                    @elseif($user->status->value === 1)
                                        <form action="{{ route('users.block', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-ban"></i> Khoá
                                            </button>
                                        </form>
                                    @elseif($user->status->value === 3)
                                        <form action="{{ route('users.approve', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-unlock"></i> Mở khoá
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

