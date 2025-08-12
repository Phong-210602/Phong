<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class UserService
{
    const ITEM_PER_PAGE = 50;
     
     /**
     * @inheritdoc
     */
    public function serverPaginationFilteringForAdmin(array $searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $query = User::query();

        // if ($keyword) {
        //     if (is_array($keyword)) {
        //         $keyword = $keyword['value'];
        //     }
        //     $query->where('title', 'LIKE', '%' . $keyword . '%');
        // }

        return $query->latest()->paginate($limit);
    }
}