# HƯỚNG DẪN LARAVEL CHO NGƯỜI MỚI BẮT ĐẦU

## 🎯 TỔNG QUAN VỀ LARAVEL

Laravel là một framework PHP hiện đại giúp xây dựng ứng dụng web một cách nhanh chóng và an toàn. Framework này tuân theo mô hình MVC (Model-View-Controller).

## 📁 CẤU TRÚC THƯ MỤC QUAN TRỌNG

```
laravel2/
├── app/                    # Thư mục chính chứa code ứng dụng
│   ├── Http/              # Xử lý HTTP requests
│   │   ├── Controllers/   # Controllers (Bộ điều khiển)
│   │   └── Middleware/    # Middleware (Lớp trung gian)
│   ├── Models/            # Models (Mô hình dữ liệu)
│   └── Providers/         # Service Providers
├── config/                # Cấu hình ứng dụng
├── database/              # Database
│   ├── migrations/        # Migration files
│   ├── seeders/          # Seeder files
│   └── factories/        # Factory files
├── resources/             # Tài nguyên frontend
│   ├── views/            # Blade templates
│   ├── css/              # CSS files
│   └── js/               # JavaScript files
├── routes/                # Định nghĩa routes
├── storage/               # File uploads, logs
└── public/                # Thư mục public (web root)
```

## 🔄 LUỒNG HOẠT ĐỘNG CỦA LARAVEL

### 1. **ROUTES** (Đường dẫn) - `routes/web.php`
```php
// Khi người dùng truy cập URL '/'
Route::get('/', function () {
    return view('home'); // Trả về file view home.blade.php
});

// Khi người dùng truy cập URL '/about'
Route::get('/about', function () {
    return view('about'); // Trả về file view about.blade.php
});
```

### 2. **CONTROLLERS** (Bộ điều khiển) - `app/Http/Controllers/`
```php
// HomeController xử lý logic cho trang chủ
class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        return view('home', compact('user')); // Truyền dữ liệu sang view
    }
}
```

### 3. **MODELS** (Mô hình) - `app/Models/`
```php
// User Model đại diện cho bảng users trong database
class User extends Authenticatable
{
    protected $fillable = [
        'name',     // Các trường có thể gán giá trị
        'email',    // khi tạo user mới
        'password',
    ];
}
```

### 4. **VIEWS** (Giao diện) - `resources/views/`
```php
{{-- home.blade.php - Hiển thị giao diện trang chủ --}}
@extends('layouts.app') {{-- Kế thừa layout chính --}}

@section('content')
    <div>Nội dung trang chủ</div>
@endsection
```

## 🚀 CÁCH SỬ DỤNG ĐÚNG QUY TRÌNH

### **Bước 1: Tạo Migration (Cấu trúc Database)**
```bash
php artisan make:migration create_products_table
```

### **Bước 2: Định nghĩa cấu trúc bảng trong Migration**
```php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}
```

### **Bước 3: Chạy Migration**
```bash
php artisan migrate
```

### **Bước 4: Tạo Model**
```bash
php artisan make:model Product
```

### **Bước 5: Tạo Controller**
```bash
php artisan make:controller ProductController --resource
```

### **Bước 6: Định nghĩa Routes**
```php
Route::resource('products', ProductController::class);
```

### **Bước 7: Tạo Views**
```bash
# Tạo thư mục và file view
resources/views/products/
├── index.blade.php    # Danh sách sản phẩm
├── create.blade.php   # Form tạo mới
├── edit.blade.php     # Form chỉnh sửa
└── show.blade.php     # Chi tiết sản phẩm
```

## 🔐 AUTHENTICATION (Xác thực)

### **Middleware Auth**
- `auth` - Kiểm tra người dùng đã đăng nhập
- `guest` - Chỉ cho phép người dùng chưa đăng nhập

### **Cách sử dụng:**
```php
// Trong Controller
public function __construct()
{
    $this->middleware('auth'); // Áp dụng cho tất cả methods
}

// Trong Routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth'); // Chỉ người dùng đã đăng nhập mới truy cập được
```

## 📝 BLADE TEMPLATE ENGINE

### **Cú pháp cơ bản:**
```php
{{-- Hiển thị biến --}}
{{ $user->name }}

{{-- Vòng lặp --}}
@foreach($users as $user)
    <li>{{ $user->name }}</li>
@endforeach

{{-- Điều kiện --}}
@if($user->isAdmin)
    <p>Bạn là admin</p>
@else
    <p>Bạn là user thường</p>
@endif

{{-- Kế thừa layout --}}
@extends('layouts.app')
@section('content')
    Nội dung
@endsection
```

## 🗄️ DATABASE OPERATIONS

### **Eloquent ORM - Cách tương tác với Database**

```php
// Lấy tất cả users
$users = User::all();

// Lấy user theo ID
$user = User::find(1);

// Tìm user theo điều kiện
$user = User::where('email', 'admin@example.com')->first();

// Tạo user mới
User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password')
]);

// Cập nhật user
$user = User::find(1);
$user->update(['name' => 'Jane Doe']);

// Xóa user
$user = User::find(1);
$user->delete();
```

## 🎨 FRONTEND (CSS/JS)

### **Vite - Build tool**
```bash
# Cài đặt dependencies
npm install

# Chạy development server
npm run dev

# Build cho production
npm run build
```

### **File cấu hình:**
- `resources/css/app.css` - CSS chính
- `resources/js/app.js` - JavaScript chính
- `vite.config.js` - Cấu hình Vite

## 🔧 CÁC LỆNH ARTISAN QUAN TRỌNG

```bash
# Tạo migration
php artisan make:migration create_table_name

# Chạy migration
php artisan migrate

# Tạo model
php artisan make:model ModelName

# Tạo controller
php artisan make:controller ControllerName

# Tạo model + migration + controller + seeder
php artisan make:model ModelName -mcs

# Tạo resource controller (CRUD)
php artisan make:controller ControllerName --resource

# Xem danh sách routes
php artisan route:list

# Xóa cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Chạy server development
php artisan serve
```

## 🛡️ BẢO MẬT

### **CSRF Protection**
```php
{{-- Trong form --}}
@csrf
```

### **Validation (Xác thực dữ liệu)**
```php
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
]);
```

## 📚 TÀI LIỆU THAM KHẢO

1. **Laravel Documentation**: https://laravel.com/docs
2. **Laravel Tutorial**: https://laravel.com/docs/quickstart
3. **Eloquent ORM**: https://laravel.com/docs/eloquent
4. **Blade Templates**: https://laravel.com/docs/blade

## 🎯 LƯU Ý QUAN TRỌNG

1. **Luôn chạy migration trước khi sử dụng database**
2. **Sử dụng Eloquent ORM thay vì raw SQL**
3. **Validation dữ liệu đầu vào**
4. **Sử dụng middleware để bảo vệ routes**
5. **Cache để tăng hiệu suất**
6. **Log để debug và theo dõi lỗi**

---

**Chúc bạn học Laravel thành công! 🚀** 