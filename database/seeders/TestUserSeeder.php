<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Tài khoản chờ phê duyệt
        User::create([
            'first_name' => 'Pending',
            'last_name' => 'User',
            'email' => 'nguyenphongmkey2003@gmail.com',
            'password' => Hash::make('1234567A'),
            'status' => UserStatus::PENDING,
            'role' => 'user',
        ]);

        // Tài khoản bị từ chối
        User::create([
            'first_name' => 'Rejected',
            'last_name' => 'User',
            'email' => 'nguyenphongmkey2004@gmail.com',
            'password' => Hash::make('1234567A'),
            'status' => UserStatus::REJECTED,
            'role' => 'user',
        ]);

        // Tài khoản bị khoá
        User::create([
            'first_name' => 'Blocked',
            'last_name' => 'User',
            'email' => 'nguyenphongmkey2005@gmail.com',
            'password' => Hash::make('1234567A'),
            'status' => UserStatus::BLOCKED,
            'role' => 'user',
        ]);

        // Tài khoản được duyệt (hoạt động bình thường)
        User::create([
            'first_name' => 'Approved',
            'last_name' => 'User',
            'email' => 'nguyenphongmkey2006.com',
            'password' => Hash::make('1234567A'),
            'status' => UserStatus::APPROVED,
            'role' => 'user',
        ]);
        
    }
}
