<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\GarbageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GarbageRepository implements GarbageRepositoryInterface
{
    public function __construct(Post $post,
                                User $user,
                                Comment $comment)
    {
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
    }

    public function trashedPosts()
    {
        return $this->post
            ->onlyTrashed()
            ->paginate(10);
    }

    public function trashedComments()
    {
        return $this->comment
            ->onlyTrashed()
            ->paginate(10);
    }

    public function trashedUsers()
    {
        return $this->user
            ->onlyTrashed()
            ->paginate(10);
    }

    public function getPost($id)
    {
        return $this->post
            ->where('id', $id)
            ->onlyTrashed()
            ->firstOrFail();
    }

    public function updatePost($data, $tags = null, $id)
    {
        $post = $this->getPost($id);
        try {
            DB::BeginTransaction();
            $post->update($data);
            $post->tags()->sync($tags);
            DB::commit();
            return redirect()->route('posts.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function getPostImage($id)
    {
        return $this->getPost($id)->image;
    }

    public function restorePost($id)
    {
        $post = $this->getPost($id);
        return $post->restore();
    }

    public function deletePost($id)
    {
        $post = $this->getPost($id);
        return $post->forceDelete();
    }

    public function getUser($id)
    {
        return $this->user
            ->where('id', $id)
            ->onlyTrashed()
            ->firstOrFail();
    }

    public function updateUser($data, $id)
    {
        return $this->getUser($id)->update($data);
    }

    public function getUserAvatar($id)
    {
        return $this->getUser($id)->avatar;
    }

    public function restoreUser($id)
    {
        $user = $this->getUser($id);
        return $user->restore();
    }

    public function deleteUser($id)
    {
        $post = $this->getUser($id);
        return $post->forceDelete();
    }

    public function getComment($id)
    {
        return $this->comment
            ->where('id', $id)
            ->onlyTrashed()
            ->firstOrFail();
    }

    public function updateComment($data, $id)
    {
        return $this->getComment($id)->update($data);
    }

    public function deleteComment($id)
    {
        $comment = $this->getComment($id);
        return $comment->forceDelete();
    }

    public function restoreComment($id)
    {
        $comment = $this->getComment($id);
        return $comment->restore();
    }
}
