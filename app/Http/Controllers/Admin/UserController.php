<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request){
        $validated = $request->validated();
        User::create($validated);
    }
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }
    
}


