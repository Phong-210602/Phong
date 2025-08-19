<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

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

    public function register(RegisterRequest $request)
    {   

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
