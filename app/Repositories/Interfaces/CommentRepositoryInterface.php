<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function getAll();
    public function getComment($id);
    public function addComment($data);
    public function deleteComment($id);
    public function updateComment($data, $id);
}
