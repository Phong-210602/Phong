<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserStatus;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct(protected UserService $userService) {}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->userService->serverPaginationFilteringForAdmin($request->all());
            return UserResource::collection($users);
        }

        return view('users.index');
    }
    // public function index(){ // hiển thị danh sách người dùng
    //     $users = User::all();
    //     return view('users.index', compact('users'));

    // }
    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    { 
        $validated = $request->validated();

        // Mã hóa mật khẩu
        $validated['password'] = bcrypt($validated['password']);

        // Lưu người dùng mới
        User::create($validated);
        // Chuyển hướng về danh sách với thông báo
        return redirect()
            ->route('users.index')
            ->with('success', 'Tạo người dùng thành công');
    }
    public function edit(User $user)
    {
        // Chỉ cho phép admin hoặc chính chủ user đó
        if (auth()->user()->role !== 'admin' && $user->id != Auth::id()) {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request,  User $user)
    {
        // Cập nhật bài viết
        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'address' => $request->address,
            'publish_date' => $request->publish_date,
            // 'status' => 1,2,3,
        ]);
        return redirect()->route('users.index')->with('success', 'Cập nhập người dùng thành công!');
    }
     public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
        'success' => true,
        'message' => 'Xoá người dùng thành công!'
    ]);
    }
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => UserStatus::APPROVED]);

        return redirect()->route('users.index')
            ->with('success', $user->status->getLabel());
    }
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => UserStatus::REJECTED]);

        return redirect()->route('users.index')
            ->with('success', $user->status->getLabel());
    }
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => UserStatus::BLOCKED]);

        return redirect()->route('users.index')
            ->with('success',  $user->status->getLabel());
    }
    // public function unblock($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->update(['status' => UserStatus::UNBLOCK]);

    //     return redirect()->route('users.index')
    //         ->with('success', 'Đã mở khoá người dùng thành công!');
    // }
}
