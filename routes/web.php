<?php

// Import các class cần thiết từ Laravel
// use Illuminate\Support\Facades\Route; // Class để định nghĩa routes
// use Illuminate\Support\Facades\Auth; // Class để xử lý authentication
// use App\Http\Controllers\UserController; // Controller quản lý User
// use App\Http\Controllers\HomeController; // Controller trang chủ

// ========================================
// ĐỊNH NGHĨA ROUTES (Đường dẫn URL)
// ========================================

// Route GET '/' - Khi người dùng truy cập trang chủ
// Route::get('/', function () {
//     return view('home'); // Trả về file view home.blade.php
// });

// // Route GET '/about' - Khi người dùng truy cập trang giới thiệu
// Route::get('/about', function () {
//     return view('about'); // Trả về file view about.blade.php
// });

// ========================================
// PUBLIC ROUTES (Không cần đăng nhập)
// ========================================

// Trang chính
// Route::get('/', function () {
//     return view('home');
// })->name('welcome');

// Trang About
// Route::get('/about', function () {
//     return view('about');
// })->name('about.page');

// ========================================
// AUTHENTICATED ROUTES (Cần đăng nhập)
// ========================================

// Auth routes (đăng nhập, đăng ký, đăng xuất)
// Auth::routes();

// Dashboard/Home sau khi đăng nhập
// Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// User management routes
// Route::get('/users', [UserController::class, 'index'])->name('users.index');

// ========================================
// ADMIN ROUTES (Có thể thêm middleware admin)
// ========================================

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::resource('users', Admin\UserController::class);
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Layout Demo Routes
// Route::get('/layout-demo', [LayoutDemoController::class, 'layoutDemo'])->name('layout.demo');

// Layout Demo Routes - Thêm vào cuối file
// Route::get('/layout-demo', [LayoutDemoController::class, 'index'])->name('layout.home');
// Route::get('/layout-demo/about', [LayoutDemoController::class, 'about'])->name('layout.about');
// Route::get('/layout-demo/products', [LayoutDemoController::class, 'products'])->name('layout.products');

// Route::get('/', function () {
//      return view('welcome');
// });

// Route::get('/abouts', function () {
//      return 'hello';
// });

// Route::get('/trang-chu', function () {
//     return 'Đây là trang chủ';
// });

// Route::get('/trang-sua', function () {
//     return 'Đây là trang sửa ';
// });

// Route::view('/abouts', 'about', ['email' => 'admin@example.com']);

// Route::get('/san-pham/{id}', function ($id) {
//     return "Bạn đang xem sản phẩm có mã: " . $id;
// });

// Route đơn giản
// Route::get('/hello', function () {
//     return 'Xin chào!';
// });

// Route trả về View
// Route::get('/', function () {
//     return view('welcome');
// });

// Phương thức Http
// GET lấy dữ liệu
// Route::get('/users', function () {
//     return 'Danh sách người dùng';
// });

// POST gửi dữ liệu
// Route::post('/users', function () {
//     return 'Tạo người dùng mới';
// });

// PUT/PATH- cập nhật dữ liệu
// Route::put('/users/{id}', function ($id) {
//     return "Cập nhật người dùng $id";
// });

// Route::patch('/users/{id}', function ($id) {
//     return "Cập nhật một phần người dùng $id";
// });

// DELETE xoá dữ liệu
// Route::delete('/users/{id}', function ($id) {
//     return "Xóa người dùng $id";
// });

// Nhiều phương thức cùng một lúc
// Route::match(['get', 'post'], '/users', function () {
//     return 'Xử lý GET hoặc POST';
// });

// Route::any('/users', function () {
//     return 'Xử lý bất kỳ phương thức nào';
// });


// Route Parameters (Tham số)


// 1 Tham số
// Route::get('/ten/{ten}',function ($ten) {
//     return "Bạn tên là..." . $ten; 
// });

// Nhiều tham số
// Route::get('/user/{name}/{age}', function ($name, $age) {
//     return "Xin chào $name, bạn $age tuổi."; Nhiều tham số
// });

// Tham số tuỳ chọn
// Route::get('/user/{name?}', function ($name = 'Khách') {
//     return "Xin chào $name"; 
// });

// Chỉ nhận số. Tham số ràng buộc
// Route::get('/user/{id}', function ($id) {
//     return "User ID: $id";
// })->where('id', '[0-9]+'); 

// Sử dụng Route vs Controller
// Route::get('/hello', [HelloController::class, 'index']);

// Đặt tên cho Route
// Route::get('/profile', function () {
//     return view('profile');
// })->name('profile');

// Sử dụng named route trong view
// <a href="{{ route('profile') }}">Hồ sơ</a>

// Named route với tham số
// Route::get('/user/{id}', function ($id) {
//     return "User $id";
// })->name('user.show');

// // Sử dụng:
// <a href="{{ route('user.show', ['id' => 1]) }}">Xem user 1</a>

// Sử dụng Route vs Controller
// Route::get('/users', [UserController::class, 'index']);

// Resource Routes (Tự động tạo CRUD)
// Route::resource('users', UserController::class);

// Câu lệnh tạo CRUD
// php artisan make:model TenModel -mcr
// Tạo ra các routes:

// - `GET /users` → `index()` (danh sách)
// - `GET /users/create` → `create()` (form tạo)
// - `POST /users` → `store()` (lưu)
// - `GET /users/{id}` → `show()` (chi tiết)
// - `GET /users/{id}/edit` → `edit()` (form sửa)
// - `PUT/PATCH /users/{id}` → `update()` (cập nhật)
// - `DELETE /users/{id}` → `destroy()` (xóa)

// Route Groups (Nhóm routes)

// Nhóm theo prefix
// Route::prefix('admin')->group(function () {
//     Route::get('/users', function () {
//         return 'Admin Users';
//     });
//     Route::get('/posts', function () {
//         return 'Admin Posts';
//     });
// });

// Nhóm theo middleware
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', function () {
//         return 'Profile page';
//     });
// });
// Tạo ra: /admin/users, /admin/posts

// Nhóm theo namespace
// Route::namespace('Admin')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

// Route với View và Data

// Route::view() - Nhanh chóng
// Route::view('/about', 'about', ['title' => 'Giới thiệu']);

//  Route với data
//  Route::get('/welcome', function () {
//     $data = [
//         'name' => 'Laravel',
//         'version' => '10.x'
//     ];
//     return view('welcome', $data);
// });

// Route với Form
// Form GET
// Route::get('/search', function () {
//     $query = request('q');
//     return "Tìm kiếm: $query";
// });

//  Form POST
//  Route::post('/register', function (Request $request) {
//     $name = $request->input('name');
//     $email = $request->input('email');
//     return "Đăng ký: $name - $email";
// });

// Route Middleware

// Middleware đơn
// Route::get('/admin', function () {
//     return 'Admin Panel';
// })->middleware('auth');

//  Nhiều middleware
//  Route::get('/admin', function () {
//     return 'Admin Panel';
// })->middleware(['auth', 'admin']);

// Route Model Binding

// Tự động binding
// Route::get('/user/{user}', function (User $user) {
//     return $user->name;
// });

// Custom binding
// Route::get('/user/{user}', function (User $user) {
//     return $user->name;
// })->where('user', '[0-9]+');

// Route Caching
// Cache routes
// php artisan route:cache // Tạo Route Cache
// php artisan route:clear // Xoá Route Cache

// Route list

// Xem tất cả Routes
// php artisan route:list

// Xem routes theo method
// php artisan route:list --method=GET

// Best Practices

// Tổ chức routes

// //routes/web.php
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::resource('users', AdminUserController::class);
//     Route::resource('posts', AdminPostController::class);
// });

// Route::prefix('api')->group(function () {
//     Route::apiResource('users', ApiUserController::class);
// });

// Validation trong routes

// Route::post('/users', function (Request $request) {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users'
//     ]);

//     // Xử lý dữ liệu đã validate
// });

// Ví dụ thực tế hoàn chỉnh
// <?php

// use Illuminate\\Support\\Facades\\Route;
// use App\\Http\\Controllers\\UserController;
// use App\\Http\\Controllers\\PostController;

// // Trang chủ
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// // Routes cho người dùng
// Route::prefix('users')->name('users.')->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/create', [UserController::class, 'create'])->name('create');
//     Route::post('/', [UserController::class, 'store'])->name('store');
//     Route::get('/{user}', [UserController::class, 'show'])->name('show');
//     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
//     Route::put('/{user}', [UserController::class, 'update'])->name('update');
//     Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
// });

// // Routes cho bài viết (sử dụng resource)
// Route::resource('posts', PostController::class);

// // Routes cần đăng nhập
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', function () {
//         return view('profile');
//     })->name('profile');

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// // Routes cho admin
// Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     Route::resource('users', AdminUserController::class);
// });




// Dòng này giúp Laravel hiểu được cách dùng Route

// Định nghĩa một route GET với đường dẫn /gioi-thieu
// Route::get('/gioi-thieu', function () {
//     return 'Trang giới thiệu'; // Khi truy cập /gioi-thieu, sẽ hiển thị nội dung này
// })->name('gioithieu'); // Đặt tên cho route là 'gioithieu'

// Route::get('/trang-chu', function () {
//     return 'Đây là trang chủ';
// })->name('home')
// ;
// Route::get('/form', function () {
//     return '
//         <form action="/gui-form" method="POST">
//             '.csrf_field().'
//             <label>Nhập tên của bạn:</label><br>
//             <input type="text" name="ten"><br><br>
//             <button type="submit">Gửi</button>
//         </form>
//     ';
// });
// Route::post('/gui-form', function (\Illuminate\Http\Request $request) {
//     $ten = $request->input('ten');
//     return "Xin chào, $ten!";
// });

// use App\Http\Controllers\UsersController;

// Route::get('/users', [UsersController::class, 'index'])->name('users.index');

// Route::get('/san-pham', [HelloController::class, 'index']);

// Route::get('/home', function () {
//     return view('home');
// })->name('home');

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// route('users.show', ['user' => $user->id])
// Route::get('/welcome', function () {
//     $data = [
//         'name' => 'Laravel',
//         'version' => '10.x'
//     ];
//     return view('welcome', $data);
// });

// Route::get('/search', function () {
//     $query = request('q');
//     return "Tìm kiếm: $query";
// });

use Illuminate\Support\Facades\Route;
// Route::get('/hello', function () {
//     return 'Xin chào';
// });
// Route::get('/', function (){
//     return view('welcome');
// });
// Route::get('/welcome', function (){
//     $data = [
//         'name' => 'Laravel',
//         'version' => '10.x',
//         return view('welcome', $data);
//     ];
// });
Route::view('/about', 'home', ['title' => 'Giới thiệu']);