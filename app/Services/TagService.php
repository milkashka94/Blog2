<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAll()
    {
        return $this->tagRepository->getAll();
    }

    public function createTag($data)
    {
        return $this->tagRepository->createTag($data);
    }

    public function getTag($id)
    {
        return $this->tagRepository->getTag($id);
    }

    public function updateTag($data, $id)
    {
        return $this->tagRepository->updateTag($data, $id);
    }

    public function deleteTag($id)
    {
        return $this->tagRepository->deleteTag($id);
    }

    public function TagsForPost()
    {
        return $this->tagRepository->TagsForPost();
    }

    public function getPosts($id)
    {
        return $this->tagRepository->getPosts($id);
    }
}
