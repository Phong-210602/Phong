@extends('layouts.adminlte')

@section('title', 'Thêm người dùng')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h3>Thêm người dùng</h3>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            {{-- Họ --}}
                            <div class="form-group mb-3">
                                <label for="last_name">Họ <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    placeholder="Nhập họ" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tên --}}
                            <div class="form-group mb-3">
                                <label for="first_name">Tên <span class="text-danger">*</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    placeholder="Nhập tên" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="address" id="address" name="address" class="form-control"
                                    placeholder="Nhập địa chỉ" value="{{ old('address') }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Nhập email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Mật khẩu --}}
                            <div class="form-group mb-3">
                                <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Nhập lại mật khẩu <span
                                        class="text-danger">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Nhập lại mật khẩu">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if (auth()->user()->role === 'admin')
                                <div class="form-group mb-3 d-flex align-items-center">
                                    <label class="me-2 mb-0">Trạng thái</label>
                                    <select class="form-select form-select-sm w-auto">
                                        <option value="{{ App\Enums\UserStatus::PENDING->value }}">Chờ phê duyệt</option>
                                        <option value="{{ App\Enums\UserStatus::APPROVED->value }}">Được phê duyệt</option>
                                        <option value="{{ App\Enums\UserStatus::REJECTED->value }}">Bị từ chối</option>
                                        <option value="{{ App\Enums\UserStatus::BLOCKED->value }}">Bị khoá</option>
                                    </select>
                                </div>
                            @endif
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Tạo người dùng mới</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
