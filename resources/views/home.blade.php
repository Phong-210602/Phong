@extends('layouts.adminlte')
{{-- @extends('layouts.master') --}}
@section('title', 'Trang chủ')
{{-- @section('content_header', 'Dashboard') --}}
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 60vh; background: #fff;">
        <h2 class="text-warning m-0">Nguyễn Thái Phong</h2>
    </div>
@push('scripts')
    <script>alert('Xin chào');</script>
@endpush
@if ($errors->any())
    <div class="alert alert-danger mt-2">
        {{ $errors->first() }}
    </div>
@endif

   {{-- <p> {!! $name !!} </p>
   @{{ message }}
   {{ $hello ?? 'Khách' }} --}}
@php
// $age = 7;
// $isAdmin = false;
// $user = ['name' => 'Phong', 'email' => null];
// $name = '';
// $products = [];
// $i = 0;
@endphp
   {{-- @if ($age >= 5)
       <p>Nhỏ hơn 7 </p>
    @elseif ($age >7)
        <p>Lớn hơn 7 </p>
   @endif  --}}
{{-- -- @unless ($isAdmin)
    <p> Bạn không phải admin </p>
@else 
    <p> Chào admin </p>
@endunless --}}
{{-- @isset($user['name'])
    <p>Tên: {{ $user['name'] }} </p>
@endisset
@isset($user['email'])
    <p>Email: {{ $user['email'] }} </p>
@endisset --}}
{{-- @empty($name)
    <p> Tên đang trống </p>
@endempty --}}

{{-- @forelse ($products as  $product)
    {{ $product }}
@empty
    <p> Không có ai </p>
@endforelse --}}
{{-- @for ($i = 1; $i <= 3; $i++)
    Mục số {{ $i }}
@endfor --}}

{{-- @while ($i < 3)
    Giá trị: {{ $i }}
    @php $i++; @endphp
@endwhile --}}
@endsection

