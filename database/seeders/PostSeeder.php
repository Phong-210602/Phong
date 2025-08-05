<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserStatus;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'user_id' => 1,
            'title' => 'Bài viết đầu tiên 1',
            'slug' => 'bai-viet-dau-tien-1',
            'description' => 'Các bạn',
            'content' => 'Nguyen Thai Phong',
            'status' => 0,
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Bài viết đầu tiên 2',
            'slug' => 'bai-viet-dau-tien-2',
            'description' => 'Các bạn',
            'content' => 'Nguyen Thai Phong',
            'status' => 1,
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Bài viết đầu tiên 3',
            'slug' => 'bai-viet-dau-tien-3',
            'description' => 'Các bạn',
            'content' => 'Nguyen Thai Phong',
            'status' => 2,
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Bài viết đầu tiên 4',
            'slug' => 'bai-viet-dau-tien-4',
            'description' => 'Các bạn',
            'content' => 'Nguyen Thai Phong',
            'status' => 3,
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Bài viết đầu tiên 5',
            'slug' => 'bai-viet-dau-tien-5',
            'description' => 'Các bạn',
            'content' => 'Nguyen Thai Phong',
            'status' => 0,
        ]);
    }
    
}
