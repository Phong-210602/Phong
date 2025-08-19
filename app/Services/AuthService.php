<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserStatus;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthService
 * 
 * Mục đích: Xử lý LOGIC NGHIỆP VỤ cho authentication
 * - Chứa tất cả Logic xử lý thực tế
 * - Không chứa validation
 * - Có thể được gọi từ nhiều Controller khác nhau
 */
class AuthService
{
    /**
     * Xử lý Logic Đăng nhập
     * @param string $email Email người dùng
     * @param string $password Mật khẩu người dùng 
     * @return array Kết quả xử lý
     * 
     */
    public function authenticateUser(string $email, string $password): array
    {
        // LOGIC 1: Tìm user theo email trong database
        $user = User::where('email', $email)->first();

        // LOGIC 2: Kiểm tra user có tồn tại không
        if (!$user) {
            return [
                'success' => false, // đổi lại thành true thì vẫn trả ra lỗi được: Kiểu dữ liệu Boolean
                'message' => 'Email không tồn tại trong hệ thống',
                'field' => 'email' // Kiểu dữ liệu là string
            ];
        }

        // LOGIC 3: Kiểm tra password có đúng không (so sánh với password đã mã hoá)
        if(!Hash::check($password, $user->password)){ // *!* phủ định mật khẩu sai, ->truy cập thuộc tính password của $user
            return [
                'success' => false,
                'message' => 'Mật khẩu không chính xác',
                'field' => 'password'   
            ];
        }

        // LOGIC 4: Kiểm tra trạng thái tài khoản có được phép đăng nhập không
        if ($user->status !== UserStatus::APPROVED) {
            return [
                'success' => false,
                'message' => $this->getStatusErrorMessage($user->status),
                'field' => 'email'
            ];
        }
        // LOGIC 5: Đăng nhập thành công - tạo session cho user
        Auth::login($user);

        return [
            'success' => true,
            'user' => $user
        ];
    }

    /**
     * Xử lý logic đăng ký
     * 
     * @param array $data Dữ liệu đăng ký (đã được validation)
     * @return array Kết quả xử lý
     */
    public function registerUser(array $data): array
    {
        try {
            // LOGIC 1: Tạo user mới trong database
            $user = User::create([
                'first_name' => $data['first_name'], //$data tạo 1 mảng mới có key là first_name
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // LOGIC 2: Mã hoá password
                'address' => $data['address'] ?? null,
                'status' => UserStatus::PENDING,
                'role' => 'user',
            ]);

            // Gửi email chào mừng
            try {
                Mail::to($user->email)->send(new TestMail($user));
            } catch (\Exception $e) {
                // Log lỗi gửi email nhưng không ảnh hưởng form đăng ký
                Log::error('Failed to send welcome email:' . $e->getMessage());
            } 

            return [
                'success' => true,
                'user' => $user,
                'message' => 'Đăng ký thành công! Tài khoản của bạn đang chờ phê duyệt.'
            ];
        } catch (\Exception $e) {
            // LOGIC 5: Xử lý lỗi nếu có
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi đăng ký tài khoản'
            ];
        }
    
    }

    /**
     * Xử lý logic đăng xuất 
     */
    public function logoutUser(): void
    {

        // LOGIC: Xoá sesstion của user hiện tại
        Auth::logout();
    }
    /**
     * Lấy thông báo lỗi theo trạng thái user
     * 
     * @param UserStatus $status Trạng thái user
     * @return string Thông báo lỗi 
     */
    private function getStatusErrorMessage(UserStatus $status): string
    {
        return match($status) {
            UserStatus::PENDING => 'Tài khoản của bạn đang chờ phê duyệt',
            UserStatus::REJECTED => 'Tài khoản của bạn đã bị từ chối',
            UserStatus::BLOCKED => 'Tài khoản của bạn đã bị khoá',
            default => 'Trạng thái tài khoản không hợp lệ'
        };
    }
}
