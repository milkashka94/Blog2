<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getAll()
    {
        return $this->tag
            ->paginate(10);
    }

    public function createTag($data)
    {
        return Tag::create($data);
    }

    public function getTag($id)
    {
        return $this->tag
            ->where('id', $id)
            ->firstOrFail();
    }

    public function updateTag($data, $id)
    {
        return $this->getTag($id)->update($data);
    }

    public function deleteTag($id)
    {
        return $this->getTag($id)->delete();
    }

    public function TagsForPost()
    {
        return Tag::pluck('title', 'id')
            ->all();
    }

    public function getPosts($id)
    {
        return $this
            ->getTag($id)
            ->posts()
            ->where('is_published', '=', '1')
            ->paginate(10);
    }
}
