# Lý thuyết về Layout trong Laravel - Hướng dẫn cho Thực tập sinh

## 1. Tổng quan về Layout trong Laravel

### 1.1 Layout là gì?
Layout trong Laravel là một template cơ sở (base template) chứa cấu trúc HTML chung cho toàn bộ website. Layout giúp:
- Tránh lặp lại code HTML
- Duy trì tính nhất quán trong giao diện
- Dễ dàng bảo trì và cập nhật

### 1.2 Tại sao cần Layout?
- **DRY Principle**: Don't Repeat Yourself - Không lặp lại code
- **Consistency**: Đảm bảo tính nhất quán
- **Maintainability**: Dễ bảo trì và cập nhật
- **SEO**: Tối ưu hóa cho công cụ tìm kiếm

## 2. Các khái niệm cơ bản

### 2.1 Blade Template Engine
Laravel sử dụng Blade - một template engine mạnh mẽ với các directive:
- `@extends()`: Kế thừa layout
- `@section()`: Định nghĩa nội dung
- `@yield()`: Hiển thị nội dung
- `@include()`: Nhúng file khác
- `@stack()` và `@push()`: Quản lý scripts/styles

### 2.2 Cấu trúc thư mục chuẩn
```
resources/views/
├── layouts/
│   ├── master.blade.php      # Layout chính
│   ├── admin.blade.php       # Layout admin
│   └── app.blade.php         # Layout ứng dụng
├── partials/
│   ├── header.blade.php      # Header chung
│   ├── footer.blade.php      # Footer chung
│   ├── navbar.blade.php      # Navigation
│   └── sidebar.blade.php     # Sidebar
├── components/
│   ├── card.blade.php        # Component card
│   └── button.blade.php      # Component button
└── pages/
    ├── home.blade.php        # Trang chủ
    ├── about.blade.php       # Trang giới thiệu
    └── contact.blade.php     # Trang liên hệ
```

## 3. Các directive chính trong Blade

### 3.1 @extends() - Kế thừa Layout
```php
@extends('layouts.master')
```
- Định nghĩa layout cha mà view hiện tại sẽ kế thừa
- Phải đặt ở dòng đầu tiên của file

### 3.2 @section() - Định nghĩa nội dung
```php
@section('title', 'Trang chủ')
@section('content')
    <h1>Nội dung trang</h1>
@endsection
```
- Định nghĩa nội dung cho các vùng trong layout
- Có thể có giá trị mặc định

### 3.3 @yield() - Hiển thị nội dung
```php
<title>@yield('title', 'Website mặc định')</title>
<div class="content">
    @yield('content')
</div>
```
- Hiển thị nội dung từ @section
- Có thể có giá trị mặc định

### 3.4 @include() - Nhúng file
```php
@include('partials.navbar')
@include('partials.footer', ['year' => date('Y')])
```
- Nhúng file blade khác vào vị trí hiện tại
- Có thể truyền dữ liệu

### 3.5 @stack() và @push() - Quản lý scripts/styles
```php
// Trong layout
@stack('scripts')

// Trong view
@push('scripts')
    <script src="/js/app.js"></script>
@endpush

@prepend('scripts')
    <script src="/js/jquery.js"></script>
@endprepend
```

## 4. Các loại Layout phổ biến

### 4.1 Master Layout (Layout chính)
```php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website mặc định')</title>
    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main class="container">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
</body>
</html>
```

### 4.2 Admin Layout
```php
@extends('layouts.master')

@section('content')
<div class="admin-layout">
    @include('partials.admin-sidebar')
    
    <div class="admin-content">
        @yield('admin-content')
    </div>
</div>
@endsection
```

### 4.3 Auth Layout (Layout đăng nhập)
```php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Đăng nhập')</title>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        @yield('auth-content')
    </div>
</body>
</html>
```

## 5. Best Practices

### 5.1 Tổ chức file
- Đặt layout chính trong `layouts/`
- Đặt các phần chung trong `partials/`
- Đặt components tái sử dụng trong `components/`
- Đặt trang cụ thể trong thư mục riêng

### 5.2 Naming Convention
- Layout: `master.blade.php`, `admin.blade.php`
- Partial: `header.blade.php`, `footer.blade.php`
- Component: `card.blade.php`, `button.blade.php`

### 5.3 Performance
- Sử dụng `@include` cho các phần nhỏ
- Sử dụng `@extends` cho layout chính
- Cache views trong production

### 5.4 Security
- Escape dữ liệu với `{{ }}`
- Sử dụng `{!! !!}` cẩn thận
- Validate input data

## 6. Ví dụ thực tế

### 6.1 Layout Master
```php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel App')</title>
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('partials.header')
    
    <!-- Navigation -->
    @include('partials.navbar')
    
    <!-- Main Content -->
    <main class="container mt-4">
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
        
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
```

### 6.2 View sử dụng Layout
```php
@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>Chào mừng đến với website</h1>
        <p>Đây là nội dung trang chủ.</p>
    </div>
    
    <div class="col-md-4">
        @include('components.sidebar')
    </div>
</div>
@endsection

@push('styles')
<style>
    .welcome-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
    }
</style>
@endpush

@push('scripts')
<script>
    console.log('Trang chủ đã load');
</script>
@endpush
```

## 7. Advanced Techniques

### 7.1 Conditional Layouts
```php
@extends($user->isAdmin() ? 'layouts.admin' : 'layouts.master')
```

### 7.2 Nested Layouts
```php
// layouts/base.blade.php
<!DOCTYPE html>
<html>
<head>
    @yield('head')
</head>
<body>
    @yield('body')
</body>
</html>

// layouts/app.blade.php
@extends('layouts.base')

@section('head')
    <title>@yield('title')</title>
    @stack('styles')
@endsection

@section('body')
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @stack('scripts')
@endsection
```

### 7.3 Component-based Layouts
```php
// components/layout.blade.php
@props(['title' => 'Default Title'])

<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    {{ $slot }}
</body>
</html>

// Sử dụng
<x-layout title="Trang chủ">
    <h1>Nội dung trang</h1>
</x-layout>
```

## 8. Debugging và Troubleshooting

### 8.1 Lỗi thường gặp
- **Layout không load**: Kiểm tra đường dẫn file
- **Section không hiển thị**: Kiểm tra tên section
- **Include không hoạt động**: Kiểm tra file tồn tại

### 8.2 Debug techniques
```php
// Kiểm tra view được load
@if(app()->environment('local'))
    <!-- Debug info -->
    <div style="background: #f0f0f0; padding: 10px; margin: 10px;">
        <strong>Debug:</strong> View: {{ $__env->getViewName() }}
    </div>
@endif
```

## 9. Performance Optimization

### 9.1 View Caching
```bash
php artisan view:cache
php artisan view:clear
```

### 9.2 Lazy Loading
```php
@includeWhen($showSidebar, 'partials.sidebar')
@includeUnless($isMobile, 'partials.desktop-nav')
```

## 10. Kết luận

Layout trong Laravel là một khái niệm quan trọng giúp:
- Tạo ra cấu trúc website nhất quán
- Giảm thiểu code trùng lặp
- Dễ dàng bảo trì và phát triển
- Tăng hiệu suất phát triển

### Checklist cho thực tập sinh:
- [ ] Hiểu được khái niệm Layout và Blade
- [ ] Biết cách sử dụng @extends, @section, @yield
- [ ] Biết cách tổ chức file theo cấu trúc chuẩn
- [ ] Biết cách sử dụng @include và @stack
- [ ] Biết cách tạo layout responsive
- [ ] Biết cách debug và troubleshoot
- [ ] Biết cách optimize performance

### Tài liệu tham khảo:
- [Laravel Blade Documentation](https://laravel.com/docs/blade)
- [Laravel Views Documentation](https://laravel.com/docs/views)
- [Blade Components](https://laravel.com/docs/blade#components) 