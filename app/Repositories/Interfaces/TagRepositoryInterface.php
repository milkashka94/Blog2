<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function getAll();
    public function createTag($data);
    public function getTag($id);
    public function updateTag($data, $id);
    public function deleteTag($id);
    public function TagsForPost();
    public function getPosts($id);
}
