<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => collect($this->collection)->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'body' => Str::limit($post->body, 100),
                    'author' => $post->user->name,
                    'user_id' => $post->user_id,
                    'subject' => $post->subject,
                    'published' => $post->created_at->format('d F, Y')
                    // 'published' => $post->created_at,
                ];
            }),
            'hasMorePages' => $this->hasMorePages()
        ];
    }
}
