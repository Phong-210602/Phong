<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserStatus;


class UserController extends Controller
{
    public function store(StoreUserRequest $request){ // store lưu người dùng mới vào database
        $validated = $request->validated();
        User::create($validated);
    }
    public function index(){ // hiển thị danh sách người dùng
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function approve($id)
    {
        $user = User::findOrFail($id); // phê duyệt người dùng
        $user->update(['status' => 1]);

        return redirect()->route('users.index')
            ->with('success' , 'Đã duyệt người dùng thành công!');
    }
    public function reject($id) // từ chối người dùng
    {
        $user = User::findOrFail($id);
        $user->update(['status' => UserStatus::REJECTED]);

        return redirect()->route('users.index')
         ->with('success', 'Đã từ chối người dùng thành công!');
    }
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => UserStatus::BLOCKED]);

        return redirect()->route('users.index')
            ->with('success', 'Đã khoá người dùng thành công!');
    }
}


