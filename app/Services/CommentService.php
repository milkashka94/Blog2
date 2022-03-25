<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment($postId, $data)
    {
        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $postId;
        return $this->commentRepository->addComment($data);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->deleteComment($id);
    }

    public function getAll()
    {
        return $this->commentRepository->getAll();
    }

    public function getComment($id)
    {
        return $this->commentRepository->getcomment($id);
    }

    public function updateComment($data, $id)
    {
        $data['updated_by'] = Auth::user()->id;
        return $this->commentRepository->updateComment($data, $id);
    }

}
