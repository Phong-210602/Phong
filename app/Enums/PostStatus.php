<?php

namespace App\Enums;

enum PostStatus: int
{
    case DRAFT = 0;     // Bản nháp
    case PUBLISHED = 1; // Đã xuất bản
    case PENDING = 2;   // Chờ duyệt
}
