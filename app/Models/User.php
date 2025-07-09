<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính có thể mass assign (gán hàng loạt)
     * Khi tạo user mới, chỉ những field này mới được phép gán giá trị
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',     // Tên người dùng
        'email',    // Email đăng nhập
        'password', // Mật khẩu (sẽ được hash tự động)
    ];

    /**
     * Các thuộc tính sẽ bị ẩn khi chuyển đổi thành JSON hoặc array
     * Bảo mật thông tin nhạy cảm
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Mật khẩu không được hiển thị
        'remember_token',  // Token ghi nhớ đăng nhập
    ];

    /**
     * Định nghĩa cách chuyển đổi kiểu dữ liệu cho các thuộc tính
     * Khi lấy dữ liệu từ database, Laravel sẽ tự động chuyển đổi
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Chuyển thành object DateTime
            'password' => 'hashed',            // Mật khẩu sẽ được hash
        ];
    }
}
