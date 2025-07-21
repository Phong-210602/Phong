<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

/**
 * class RegisterController
 * 
 * Mục đích: ĐIÈU PHỐI (coordinate) - không chứa logic xử lý
 */
class RegisterController extends Controller
{
    protected $redirectTo = '/login';

    // Inject AuthService vào Controller
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('guest');
        $this->authService = $authService;
    }

    /**
     * Hiển thị form đăng ký
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký - CHỈ ĐIỀU PHỐI
     * 
     * @param RegisterRequest $request Request đã được validation tự động
     */
    public function register(RegisterRequest $request)
    {   
        /** @var \Illuminate\Http\Request $request */
        // Bước 1: Validation đã tự động chạy trong RegisterRequest

        // Bước 2: Gọi service để xử lý logic đăng ký
        $result = $this->authService->registerUser($request->validated());
        if (!$result['success']) {
            return redirect()->back()
                ->withErrors(['general' => $result['message']])
                ->withInput($request->except('password', 'password_confirmation'));
        }
        return redirect($this->redirectTo)
            ->with('success', $result['message']);
    }
}
