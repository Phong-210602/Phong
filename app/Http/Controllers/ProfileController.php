<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user(); // lấy user đang đăng nhập
        return view('profile.edit', compact('user'));
    }
    public function update(ProfileUserRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'address' => $request->address,
        ]);
        return redirect()->route('users.index')->with('success', 'Cập nhập người dùng thành công!');
    }
}
