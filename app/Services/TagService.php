<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(array $data): Tag {
        if(Tag::where('name', $data['name'])->exists()) {
            throw new \Exception('Existe uma tag com esse nome');
        }

        if(Tag::where('slug', $data['slug'])->exists()) {
            throw new \Exception('Existe uma tag com esse slug');
        }
        return Tag::create($data);
    }

    public function update(array $data, Tag $tag): Tag {
        if(Tag::where('name', $data['name'])->exists()) {
            throw new \Exception('Existe uma tag com esse nome');
        }

        if(Tag::where('slug', $data['slug'])->exists()) {
            throw new \Exception('Existe uma tag com esse slug');
        }
        $tag->update($data);
        return $tag;
    }

    public function delete(Tag $tag): Tag {
        $tag->delete();
        return $tag;
    }
}
