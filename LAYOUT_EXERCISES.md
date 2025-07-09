# Bài tập thực hành Layout trong Laravel

## Bài tập 1: Tạo Layout cơ bản

### Yêu cầu:
Tạo một layout cơ bản với header, navigation, content area và footer.

### Hướng dẫn:
1. Tạo file `resources/views/layouts/basic.blade.php`
2. Tạo file `resources/views/partials/header.blade.php`
3. Tạo file `resources/views/partials/footer.blade.php`
4. Tạo một trang sử dụng layout này

### Code mẫu:
```php
// layouts/basic.blade.php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website cơ bản')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.header')
    
    <main class="container mt-4">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

## Bài tập 2: Tạo Component tái sử dụng

### Yêu cầu:
Tạo một component card có thể tái sử dụng với các props khác nhau.

### Hướng dẫn:
1. Tạo file `resources/views/components/product-card.blade.php`
2. Component phải nhận các props: title, price, image, description
3. Sử dụng component trong trang sản phẩm

### Code mẫu:
```php
// components/product-card.blade.php
@props(['title', 'price', 'image', 'description'])

<div class="card h-100">
    @if($image)
        <img src="{{ $image }}" class="card-img-top" alt="{{ $title }}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $description }}</p>
        <p class="card-text"><strong>Giá: {{ number_format($price) }} VNĐ</strong></p>
        <button class="btn btn-primary">Thêm vào giỏ</button>
    </div>
</div>

// Sử dụng
<x-product-card 
    title="iPhone 15" 
    price="25000000" 
    image="/images/iphone.jpg"
    description="iPhone 15 mới nhất từ Apple" />
```

## Bài tập 3: Tạo Admin Layout

### Yêu cầu:
Tạo một layout riêng cho trang admin với sidebar.

### Hướng dẫn:
1. Tạo file `resources/views/layouts/admin.blade.php`
2. Tạo file `resources/views/partials/admin-sidebar.blade.php`
3. Layout phải có sidebar bên trái và content area bên phải
4. Sử dụng Bootstrap grid system

### Code mẫu:
```php
// layouts/admin.blade.php
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        @yield('admin-content')
    </div>
</div>
@endsection

// partials/admin-sidebar.blade.php
<div class="list-group">
    <a href="/admin/dashboard" class="list-group-item list-group-item-action">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="/admin/users" class="list-group-item list-group-item-action">
        <i class="fas fa-users me-2"></i>Quản lý người dùng
    </a>
    <a href="/admin/products" class="list-group-item list-group-item-action">
        <i class="fas fa-box me-2"></i>Quản lý sản phẩm
    </a>
    <a href="/admin/orders" class="list-group-item list-group-item-action">
        <i class="fas fa-shopping-cart me-2"></i>Quản lý đơn hàng
    </a>
</div>
```

## Bài tập 4: Tạo Auth Layout

### Yêu cầu:
Tạo layout riêng cho các trang đăng nhập, đăng ký.

### Hướng dẫn:
1. Tạo file `resources/views/layouts/auth.blade.php`
2. Layout phải có form ở giữa màn hình
3. Sử dụng CSS để tạo background đẹp
4. Responsive design

### Code mẫu:
```php
// layouts/auth.blade.php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đăng nhập')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-container">
                    @yield('auth-content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
```

## Bài tập 5: Tạo Nested Layouts

### Yêu cầu:
Tạo layout lồng nhau với base layout và app layout.

### Hướng dẫn:
1. Tạo `layouts/base.blade.php` (HTML cơ bản)
2. Tạo `layouts/app.blade.php` (extends base)
3. Tạo `layouts/admin.blade.php` (extends app)
4. Hiểu cách layout kế thừa nhau

### Code mẫu:
```php
// layouts/base.blade.php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    @stack('styles')
</head>
<body>
    @yield('body')
    @stack('scripts')
</body>
</html>

// layouts/app.blade.php
@extends('layouts.base')

@section('body')
    @include('partials.navbar')
    <main class="container mt-4">
        @yield('content')
    </main>
    @include('partials.footer')
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
```

## Bài tập 6: Tạo Conditional Layouts

### Yêu cầu:
Tạo layout thay đổi dựa trên điều kiện (user role, device type).

### Hướng dẫn:
1. Tạo layout khác nhau cho admin và user thường
2. Sử dụng helper functions để kiểm tra role
3. Tạo responsive layout cho mobile và desktop

### Code mẫu:
```php
// Trong view
@extends(auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

// Hoặc
@extends($isMobile ? 'layouts.mobile' : 'layouts.desktop')

// Helper function
function isAdmin() {
    return auth()->check() && auth()->user()->role === 'admin';
}
```

## Bài tập 7: Tạo Layout với JavaScript

### Yêuẩu:
Tạo layout có JavaScript tương tác.

### Hướng dẫn:
1. Sử dụng @stack để quản lý scripts
2. Tạo JavaScript cho sidebar toggle
3. Tạo JavaScript cho theme switcher
4. Sử dụng Alpine.js hoặc vanilla JavaScript

### Code mẫu:
```php
// Trong layout
@stack('scripts')

// Trong view
@push('scripts')
<script>
    // Sidebar toggle
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    });
    
    // Theme switcher
    document.getElementById('theme-switch').addEventListener('change', function() {
        document.body.classList.toggle('dark-theme');
    });
</script>
@endpush
```

## Bài tập 8: Tạo Layout với CSS Variables

### Yêu cầu:
Tạo layout sử dụng CSS variables để dễ tùy chỉnh.

### Hướng dẫn:
1. Định nghĩa CSS variables cho colors, fonts, spacing
2. Tạo theme system với CSS variables
3. Sử dụng CSS variables trong layout

### Code mẫu:
```css
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    
    --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    --font-size-base: 1rem;
    --line-height-base: 1.5;
    
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 3rem;
}

body {
    font-family: var(--font-family);
    font-size: var(--font-size-base);
    line-height: var(--line-height-base);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}
```

## Bài tập 9: Tạo Layout với SEO

### Yêu cầu:
Tạo layout tối ưu cho SEO.

### Hướng dẫn:
1. Thêm meta tags động
2. Tạo Open Graph tags
3. Tạo Twitter Card tags
4. Tạo structured data

### Code mẫu:
```php
// Trong layout
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Website mặc định')">
    <meta name="keywords" content="@yield('meta_keywords', 'laravel, php, web development')">
    <meta name="author" content="@yield('meta_author', 'Your Name')">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', @yield('title'))">
    <meta property="og:description" content="@yield('og_description', @yield('meta_description'))">
    <meta property="og:image" content="@yield('og_image', '/images/default-og.jpg')">
    <meta property="og:url" content="{{ request()->url() }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', @yield('title'))">
    <meta name="twitter:description" content="@yield('twitter_description', @yield('meta_description'))">
    <meta name="twitter:image" content="@yield('twitter_image', @yield('og_image'))">
    
    <title>@yield('title', 'Website mặc định')</title>
</head>
```

## Bài tập 10: Tạo Layout với Performance

### Yêu cầu:
Tạo layout tối ưu cho performance.

### Hướng dẫn:
1. Sử dụng lazy loading cho images
2. Minify CSS và JavaScript
3. Sử dụng CDN cho external resources
4. Implement caching strategies

### Code mẫu:
```php
// Trong layout
<head>
    <!-- Preload critical resources -->
    <link rel="preload" href="/css/critical.css" as="style">
    <link rel="preload" href="/js/critical.js" as="script">
    
    <!-- Critical CSS inline -->
    <style>
        /* Critical CSS here */
        body { margin: 0; font-family: Arial, sans-serif; }
        .header { background: #333; color: white; padding: 1rem; }
    </style>
    
    <!-- Non-critical CSS -->
    <link rel="stylesheet" href="/css/non-critical.css" media="print" onload="this.media='all'">
    
    <!-- Fallback for no JavaScript -->
    <noscript>
        <link rel="stylesheet" href="/css/non-critical.css">
    </noscript>
</head>

<body>
    @yield('content')
    
    <!-- Defer non-critical JavaScript -->
    <script src="/js/critical.js"></script>
    <script defer src="/js/non-critical.js"></script>
</body>
```

## Checklist hoàn thành:

- [ ] Bài tập 1: Layout cơ bản
- [ ] Bài tập 2: Component tái sử dụng
- [ ] Bài tập 3: Admin layout
- [ ] Bài tập 4: Auth layout
- [ ] Bài tập 5: Nested layouts
- [ ] Bài tập 6: Conditional layouts
- [ ] Bài tập 7: Layout với JavaScript
- [ ] Bài tập 8: Layout với CSS variables
- [ ] Bài tập 9: Layout với SEO
- [ ] Bài tập 10: Layout với Performance

## Lưu ý:
- Mỗi bài tập nên được thực hiện độc lập
- Test responsive trên các thiết bị khác nhau
- Kiểm tra performance với browser dev tools
- Validate HTML và CSS
- Test cross-browser compatibility 