<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PostStatus;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{   //Khai báo để sử dụng cho database
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'publish_date',
        'status',
    ];
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return Storage::url($this->thumbnail);
        }

        return asset('images/default-thumbnail.jpg'); // nếu không có ảnh
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope cho bài viết bản nháp
    public function scopeDraft($query)
    {
        return $query->where('status', PostStatus::DRAFT);
    }

    // Scope cho bài viết đã xuất bản
    public function scopePublished($query)
    {
        return $query->where('status', PostStatus::PUBLISHED);
    }

    // Scope cho bài viết chờ duyệt
    public function scopePending($query)
    {
        return $query->where('status', PostStatus::PENDING);
    }
}
