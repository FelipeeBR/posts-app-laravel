<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): Post {
        if(Post::where('title', $data['title'])->exists()) {
            throw new \Exception('Existe um post com esse titulo');
        }

        return Post::create($data);
    }

    public function update(array $data, Post $post): Post {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post): Post {
        $post->delete();
        return $post;
    }
}
