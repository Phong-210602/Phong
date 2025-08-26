<?php

namespace App\Enums;

enum PostStatus: int
{
    case DRAFT = 0;     // Bài viết mới
    case PUBLISHED = 1; // Đã xuất bản
    case PENDING = 2;   // Chờ duyệt

}

