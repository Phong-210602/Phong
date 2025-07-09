# HƯỚNG DẪN LARAVEL CHO THỰC TẬP SINH

## 1. Laravel là gì và tại sao phải dùng?

### Laravel là gì?
Laravel là một PHP Framework hiện đại, mạnh mẽ và dễ học. Nó giúp bạn xây dựng ứng dụng web một cách nhanh chóng và có cấu trúc rõ ràng.

### Tại sao phải dùng Laravel?
- **Tiết kiệm thời gian**: Không cần viết lại những code cơ bản
- **Bảo mật**: Có sẵn các tính năng bảo mật như CSRF protection, SQL injection prevention
- **Cấu trúc rõ ràng**: MVC pattern giúp code dễ đọc và bảo trì
- **Cộng đồng lớn**: Nhiều package và tài liệu hỗ trợ
- **Database migration**: Quản lý cơ sở dữ liệu dễ dàng

## 2. Cách thức hoạt động của Laravel

### Request Lifecycle (Vòng đời của một request):
1. **Request đến** → `public/index.php`
2. **Bootstrap** → Khởi tạo ứng dụng
3. **Router** → Tìm route phù hợp
4. **Middleware** → Kiểm tra quyền truy cập
5. **Controller** → Xử lý logic
6. **View** → Trả về HTML
7. **Response** → Gửi về browser

## 3. Callback Functions và Route::view()

### Callback Functions (Closure Routes)
```php
// Cách 1: Sử dụng callback function
Route::get('/hello', function () {
    return 'Xin chào!';
});

// Cách 2: Trả về view
Route::get('/about', function () {
    return view('about');
});

// Cách 3: Truyền dữ liệu
Route::get('/welcome', function () {
    $name = 'Laravel';
    return view('welcome', ['name' => $name]);
});
```

### Route::view() - Cách ngắn gọn
```php
// Route::view(đường dẫn, tên view, dữ liệu)
Route::view('/about', 'about', ['title' => 'Giới thiệu']);

// Tương đương với:
Route::get('/about', function () {
    return view('about', ['title' => 'Giới thiệu']);
});
```

**Ưu điểm của Route::view():**
- Code ngắn gọn hơn
- Chỉ dùng khi không cần logic phức tạp
- Dễ đọc và hiểu

## 4. Sử dụng Controllers với Routes

### Tạo Controller
```bash
php artisan make:controller ProductController
```

### Controller cơ bản
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ['Laptop', 'Phone', 'Tablet'];
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        return "Sản phẩm có ID: $id";
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        return "Đã tạo sản phẩm: $name";
    }
}
```

### Kết nối Controller với Route
```php
// Cách 1: Chỉ định method cụ thể
Route::get('/products', [ProductController::class, 'index']);

// Cách 2: Resource routes (sẽ học ở phần sau)
Route::resource('products', ProductController::class);
```

## 5. Route Parameters

### Parameters cơ bản
```php
// Parameter đơn
Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
});

// Nhiều parameters
Route::get('/user/{name}/{age}', function ($name, $age) {
    return "Tên: $name, Tuổi: $age";
});

// Optional parameters (có thể có hoặc không)
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Xin chào $name";
});
```

### Parameters với Controller
```php
Route::get('/products/{id}', [ProductController::class, 'show']);
```

## 6. Route Naming

### Đặt tên cho Route
```php
Route::get('/about', function () {
    return view('about');
})->name('about.page');

Route::get('/home', function () {
    return view('home');
})->name('home');
```

### Sử dụng Route Name
```php
// Trong Blade template
<a href="{{ route('about.page') }}">Về chúng tôi</a>
<a href="{{ route('home') }}">Trang chủ</a>

// Trong Controller
return redirect()->route('home');
```

### Tại sao cần Route Naming?
- **Dễ bảo trì**: Thay đổi URL không cần sửa code ở nhiều nơi
- **Tránh lỗi**: Không cần nhớ URL chính xác
- **Code sạch**: Dễ đọc và hiểu hơn

## 7. Route Groups và Resource Controllers

### Route Groups
```php
// Nhóm routes có prefix chung
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });
    Route::get('/products', function () {
        return 'Admin Products';
    });
});

// Nhóm routes có middleware chung
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return 'User Profile';
    });
});
```

### Resource Controllers
Resource Controller tự động tạo 7 routes cơ bản cho CRUD:

```php
Route::resource('products', ProductController::class);
```

**7 routes được tạo:**
- `GET /products` → `index()` (Hiển thị danh sách)
- `GET /products/create` → `create()` (Form tạo mới)
- `POST /products` → `store()` (Lưu dữ liệu)
- `GET /products/{id}` → `show()` (Hiển thị chi tiết)
- `GET /products/{id}/edit` → `edit()` (Form chỉnh sửa)
- `PUT/PATCH /products/{id}` → `update()` (Cập nhật)
- `DELETE /products/{id}` → `destroy()` (Xóa)

### Xem tất cả routes
```bash
php artisan route:list
```

## 8. Thực hành

### Bài tập 1: Tạo Blog System đơn giản
1. Tạo PostController
2. Tạo routes cho CRUD posts
3. Tạo views cơ bản
4. Sử dụng route naming

### Bài tập 2: Tạo Admin Panel
1. Tạo route group cho admin
2. Tạo middleware kiểm tra quyền
3. Tạo resource controllers

## 9. Best Practices

1. **Luôn đặt tên cho routes quan trọng**
2. **Sử dụng Resource Controllers cho CRUD**
3. **Tách logic phức tạp ra Controller**
4. **Sử dụng Route Groups để tổ chức code**
5. **Validate dữ liệu trong Controller**

## 10. Lệnh Artisan hữu ích

```bash
# Tạo controller
php artisan make:controller PostController

# Tạo controller với resource methods
php artisan make:controller PostController --resource

# Tạo model
php artisan make:model Post

# Tạo model với migration
php artisan make:model Post -m

# Xem tất cả routes
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
``` 