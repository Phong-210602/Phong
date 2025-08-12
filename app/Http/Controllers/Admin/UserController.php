<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserStatus;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function __construct (protected UserService $userService)
    {
    }
      public function index(Request $request)
    {
        if ($request->ajax()) {
            $serviceAttributes = $this->userService->serverPaginationFilteringForAdmin($request->all());
            return UserResource::collection($serviceAttributes);
        }

        return view('users.index');
    }
    // public function index(){ // hiển thị danh sách người dùng
    //     $users = User::all();
    //     return view('users.index', compact('users'));
        
    // }

    public function store(StoreUserRequest $request){ // store lưu người dùng mới vào database
        $validated = $request->validated();
        User::create($validated);
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


