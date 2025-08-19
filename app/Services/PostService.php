<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PostService
{
     const ITEM_PER_PAGE = 50;
     
     
    public function serverPaginationFilteringForAdmin($searchParams): LengthAwarePaginator
    {   
        // dd($searchParams);
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE); // array key default
        // $keyword = Arr::get($searchParams, 'search', '');
        $userId = Arr::get($searchParams, 'user_id', null);

        $query = Post::query();

        if (!is_null($userId)){
            $query->where('user_id', $userId);
        }

        return $query->latest()->paginate($limit);
    }
}