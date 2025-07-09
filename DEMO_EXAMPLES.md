# DEMO LARAVEL ROUTES - CÁC VÍ DỤ THỰC TẾ

## 1. CÁCH TEST CÁC ROUTES

### Chạy server Laravel:
```bash
php artisan serve
```

### Các URL để test:

#### Callback Functions và Route::view()
- `http://localhost:8000/` - Trang chủ
- `http://localhost:8000/hello` - Callback function trả về text
- `http://localhost:8000/welcome` - Callback function với dữ liệu
- `http://localhost:8000/about` - Route::view() ngắn gọn

#### Controllers với Routes
- `http://localhost:8000/users` - Sử dụng UserController
- `http://localhost:8000/hello-controller` - Sử dụng HelloController

#### Route Parameters
- `http://localhost:8000/user/123` - Parameter đơn
- `http://localhost:8000/user/NguyenVanA/25` - Nhiều parameters
- `http://localhost:8000/greet` - Optional parameter (mặc định)
- `http://localhost:8000/greet/ThucTapSinh` - Optional parameter với giá trị
- `http://localhost:8000/products/1` - Parameter với controller

#### Route Groups
- `http://localhost:8000/admin/dashboard` - Admin dashboard
- `http://localhost:8000/admin/users` - Admin users
- `http://localhost:8000/admin/products` - Admin products
- `http://localhost:8000/profile` - User profile
- `http://localhost:8000/settings` - User settings

#### Resource Controllers (CRUD Products)
- `http://localhost:8000/products` - Danh sách sản phẩm (GET)
- `http://localhost:8000/products/create` - Form tạo mới (GET)
- `http://localhost:8000/products/1` - Chi tiết sản phẩm (GET)
- `http://localhost:8000/products/1/edit` - Form chỉnh sửa (GET)

## 2. CÁC HTTP METHODS

### GET Requests (Browser)
- Tất cả các routes trên đều dùng GET

### POST Requests (Forms)
- Form tạo sản phẩm: `POST /products`
- Form submit: `POST /submit-form`

### PUT/PATCH Requests (Forms với @method)
- Form cập nhật sản phẩm: `PUT /products/{id}`
- Cập nhật user: `PUT /users/{id}`

### DELETE Requests (Forms với @method)
- Xóa sản phẩm: `DELETE /products/{id}`
- Xóa user: `DELETE /users/{id}`

## 3. ROUTE NAMING - CÁCH SỬ DỤNG

### Trong Blade Templates:
```php
<a href="{{ route('home') }}">Trang chủ</a>
<a href="{{ route('users.index') }}">Danh sách users</a>
<a href="{{ route('products.show', 1) }}">Xem sản phẩm 1</a>
<a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
```

### Trong Controllers:
```php
return redirect()->route('home');
return redirect()->route('products.index');
return redirect()->route('products.show', $id);
```

## 4. RESOURCE CONTROLLER - 7 ROUTES TỰ ĐỘNG

Khi bạn tạo `Route::resource('products', ProductController::class)`, Laravel tự động tạo:

| Method | URI | Name | Action | Mô tả |
|--------|-----|------|--------|-------|
| GET | `/products` | `products.index` | `index()` | Danh sách |
| GET | `/products/create` | `products.create` | `create()` | Form tạo |
| POST | `/products` | `products.store` | `store()` | Lưu dữ liệu |
| GET | `/products/{id}` | `products.show` | `show()` | Chi tiết |
| GET | `/products/{id}/edit` | `products.edit` | `edit()` | Form sửa |
| PUT/PATCH | `/products/{id}` | `products.update` | `update()` | Cập nhật |
| DELETE | `/products/{id}` | `products.destroy` | `destroy()` | Xóa |

## 5. ROUTE GROUPS - TỔ CHỨC CODE

### Prefix Groups:
```php
Route::prefix('admin')->name('admin.')->group(function () {
    // Tất cả routes trong này sẽ có prefix 'admin' và name prefix 'admin.'
    // /admin/dashboard → admin.dashboard
    // /admin/users → admin.users
});
```

### Middleware Groups:
```php
Route::middleware(['auth'])->group(function () {
    // Tất cả routes trong này sẽ áp dụng middleware 'auth'
    // Chỉ user đã đăng nhập mới truy cập được
});
```

## 6. BEST PRACTICES

### 1. Luôn đặt tên cho routes quan trọng:
```php
Route::get('/about', function () {
    return view('about');
})->name('about.page'); // ✅ Tốt

Route::get('/about', function () {
    return view('about');
}); // ❌ Không tốt
```

### 2. Sử dụng Resource Controllers cho CRUD:
```php
// ✅ Tốt - Tự động tạo 7 routes
Route::resource('products', ProductController::class);

// ❌ Không tốt - Phải viết từng route
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
// ... và 5 routes khác
```

### 3. Tách logic phức tạp ra Controller:
```php
// ✅ Tốt
Route::get('/products', [ProductController::class, 'index']);

// ❌ Không tốt - Logic phức tạp trong route
Route::get('/products', function () {
    $products = Product::all();
    $categories = Category::all();
    return view('products.index', compact('products', 'categories'));
});
```

### 4. Sử dụng Route Groups để tổ chức:
```php
// ✅ Tốt - Code có tổ chức
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
    Route::resource('products', AdminProductController::class);
});

// ❌ Không tốt - Code rải rác
Route::get('/admin/users', [AdminUserController::class, 'index']);
Route::get('/admin/products', [AdminProductController::class, 'index']);
```

## 7. LỆNH HỮU ÍCH

### Xem tất cả routes:
```bash
php artisan route:list
```

### Xem routes của một controller:
```bash
php artisan route:list --name=products
```

### Clear route cache:
```bash
php artisan route:clear
```

### Cache routes (production):
```bash
php artisan route:cache
```

## 8. DEBUGGING ROUTES

### Kiểm tra route có tồn tại:
```php
if (Route::has('products.index')) {
    echo 'Route tồn tại';
}
```

### Lấy URL từ route name:
```php
$url = route('products.index');
echo $url; // http://localhost:8000/products
```

### Kiểm tra route hiện tại:
```php
if (Route::currentRouteName() == 'products.index') {
    echo 'Đang ở trang danh sách sản phẩm';
}
``` 