@extends('layouts.adminlte')

@section('title', 'Cập nhật hồ sơ')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3>Cập nhập hồ sơ</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="last_name">Họ <span class="text-danger">*</span></label>
                            <input type="text" id="last_name" name="last_name"
                                   class="form-control"
                                   placeholder="Nhập họ"
                                   value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name">Tên <span class="text-danger">*</span></label>
                            <input type="text" id="first_name" name="first_name"
                                   class="form-control"
                                   placeholder="Nhập tên"
                                   value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="address"> Địa chỉ <span class="text-danger">*</span></label>
                            <input type="address" id="address" name="address"
                                   class="form-control"
                                   placeholder="Nhập địa chỉ"
                                   value="{{ old('address', $user->address) }}">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
