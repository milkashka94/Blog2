<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getAll()
    {
        return $this->comment
            ->paginate(10);
    }

    public function addComment($data)
    {
        return Comment::create($data);
    }

    public function deleteComment($id)
    {
        return $this->getComment($id)->delete();
    }

    public function getComment($id)
    {
        return $this->comment
            ->where('id', $id)
            ->firstOrFail();
    }

    public function updateComment($data, $id)
    {
        return $this->getComment($id)->update($data);
    }
}
