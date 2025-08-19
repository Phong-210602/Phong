<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements HasMedia
{   //Khai báo để sử dụng cho database
    use HasFactory, InteractsWithMedia;
    use SoftDeletes;

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
    protected $casts = [ // $casts giúp là việc với Enum cho trường Status
        // ... existing casts ...
        'status' => PostStatus::class,
    ];
    public function getThumbnailUrlAttribute()
    {
    return $this->getFirstMedia()?->getUrl() ?? '/abc/avatar-cute-3.jpg';
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
