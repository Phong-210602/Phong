<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserStatus;

class User extends Authenticatable // ORM
{


    // public function isActive()
    // {
    //     return $this->status == self::STATUS_ACTIVE;
    // }
    use HasFactory, Notifiable;
// Khai báo để sử dụng cho database
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'status',
        'role',
    ];


    protected $casts = [ // $casts giúp là việc với Enum cho trường Status
        // ... existing casts ...
        'status' => UserStatus::class,
    ];


    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
