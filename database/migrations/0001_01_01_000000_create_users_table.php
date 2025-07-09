<?php

// Import các class cần thiết cho migration
use Illuminate\Database\Migrations\Migration; // Class cơ bản cho migration
use Illuminate\Database\Schema\Blueprint; // Class để định nghĩa cấu trúc bảng
use Illuminate\Support\Facades\Schema; // Facade để thao tác với database

// Tạo class migration mới (anonymous class)
return new class extends Migration
{
    /**
     * Chạy migration - Tạo các bảng trong database
     * Được gọi khi chạy lệnh: php artisan migrate
     */
    public function up(): void
    {
        // Tạo bảng 'users' - Lưu thông tin người dùng
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo cột ID tự động tăng (primary key)
            $table->string('name'); // Cột tên người dùng (varchar)
            $table->string('email')->unique(); // Cột email, phải là duy nhất
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác thực email (có thể null)
            $table->string('password'); // Cột mật khẩu (sẽ được hash)
            $table->rememberToken(); // Token để ghi nhớ đăng nhập
            $table->timestamps(); // Tạo 2 cột: created_at và updated_at
        });

        // Tạo bảng 'password_reset_tokens' - Lưu token reset mật khẩu
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email làm primary key
            $table->string('token'); // Token để reset mật khẩu
            $table->timestamp('created_at')->nullable(); // Thời gian tạo token
        });

        // Tạo bảng 'sessions' - Lưu thông tin phiên đăng nhập
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID của session
            $table->foreignId('user_id')->nullable()->index(); // ID người dùng (foreign key)
            $table->string('ip_address', 45)->nullable(); // Địa chỉ IP
            $table->text('user_agent')->nullable(); // Thông tin trình duyệt
            $table->longText('payload'); // Dữ liệu session
            $table->integer('last_activity')->index(); // Thời gian hoạt động cuối
        });
    }

    /**
     * Hoàn tác migration - Xóa các bảng đã tạo
     * Được gọi khi chạy lệnh: php artisan migrate:rollback
     */
    public function down(): void
    {
        // Xóa các bảng theo thứ tự ngược lại
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
