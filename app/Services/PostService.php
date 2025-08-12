<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PostService
{
     const ITEM_PER_PAGE = 50;
     
     /**
     * @inheritdoc
     */
    public function serverPaginationFilteringForAdmin(array $searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $query = Post::query();
        return $query->latest()->paginate($limit);
    }
}