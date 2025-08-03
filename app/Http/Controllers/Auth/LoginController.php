<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * 
 * Mục đích: ĐIỀU PHỐI (coordinate) - không chứa logic xử lý
 * - Nhận request từ user
 * - Gọi validation (LoginRequest)
 * - Gọi service để xử lý logic
 * - Trả về response cho user
 */
class LoginController extends Controller
{
    protected $redirectTo = '/';
    
    // Inject AuthService vào Controller
    private $authService;
    

    public function __construct(AuthService $authService)
    {
        $this->middleware('guest')->except('logout'); // Chặn người đã đăng nhập xem form login, trừ hành động logout
        $this->middleware('auth')->only('logout'); // Chỉ những ai đăng nhập mới được logout
        $this->authService = $authService; // Lưu Service vào biến
    }

    /**
     * Hiển thị form Đăng nhập
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /** 
     * Xử lý đăng nhập - CHỈ ĐIỀU PHỐI
     * 
     * @param LoginRequest $request Request đã được validation tự động
     */
    public function login(LoginRequest $request)
    {
        // Bước 1: Validation đã tự động chạy trong LoginRequest

        // Bước 2: Gọi Service để xử lý Login đăng nhập
        $result = $this->authService->authenticateUser(
            $request->email,    // Dữ liệu đã được validation
            $request->password  // Dữ liệu đã được validation
        );

        // Bước 3: Điều phối response dựa trên kết quả từ serveice
        if (!$result['success']) {
            //Nếu đăng nhập thất bại - trả về lỗi
            /** @var \Illuminate\Http\Request $request */
            return redirect()->back()
                ->withErrors([$result['field']=> $result['message']])
                ->withInput($request->only('email'));
        }

        // Nếu đăng nhập thành công - tạo sesstion mới và redirect
        /** @var \Illuminate\Http\Request $request */
      $request->session()->regenerate();
    // Thêm flash message và chuyển hướng đến danh sách bài viết
    return redirect()->route('posts.index')->with('success', 'Đăng nhập thành công');
}
    /**
     * Xử lý đăng xuất - CHỈ ĐIỀU PHỐI
     */
    public function logout(Request $request)
    {
        // Bước 1: Gọi service để xử lý logic đăng xuất
        $this->authService->logoutUser();

        // Bước 2: Điều phối response - xoá sesion và redirect
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}