<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id'           => $this->id,
        'thumbnail'    => $this->thumbnail_url,
        'user_id'      => $this->user_id,
        'user'         => $this->user->name,
        'title'        => $this->title,
        'slug'         => $this->slug,
        'description'  => $this->description,
        'content'      => $this->content,
        'publish_date' => $this->publish_date,
        'status'       => $this->status,
        'created_at'   => $this->created_at->format('d/m/Y'),
        'updated_at'   => $this->updated_at,

        ];
    }
}
