<?php

namespace App\Enums;

enum PostStatus: int
{
    case DRAFT = 0;     // Bài viết mới
    case PUBLISHED = 1; // Chờ duyệt
    case PENDING = 2;   // Được duyệt

}

