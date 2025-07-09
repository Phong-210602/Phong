<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller - Controller Xử Lý Đăng Nhập
    |--------------------------------------------------------------------------
    |
    | Controller này xử lý việc xác thực người dùng cho ứng dụng và
    | chuyển hướng họ đến trang chủ. Controller sử dụng trait
    | để cung cấp chức năng một cách thuận tiện cho ứng dụng của bạn.
    |
    */

    use AuthenticatesUsers;

    /**
     * Định nghĩa đường dẫn chuyển hướng sau khi đăng nhập thành công
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Hàm khởi tạo (Constructor) - Chạy khi tạo object mới
     * Thiết lập middleware cho các routes
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware 'guest' - Chỉ cho phép người dùng CHƯA đăng nhập truy cập
        // except('logout') - Ngoại trừ method logout
        $this->middleware('guest')->except('logout');
        
        // Middleware 'auth' - Chỉ cho phép người dùng ĐÃ đăng nhập truy cập
        // only('logout') - Chỉ áp dụng cho method logout
        $this->middleware('auth')->only('logout');
    }
}
