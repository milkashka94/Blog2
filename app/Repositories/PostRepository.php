<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post
            ->where('is_published', '=', '1')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getPost($id)
    {
        $post = $this->post
            ->where('id', $id)
            ->firstOrFail();
        $post->timestamps = false;
        $views = $post->views++;
        $post->update(['views' => $views]);
        return $post;
    }

    public function createPost($data, $tags = null)
    {
        try {
            DB::BeginTransaction();
            $post = Post::create($data);
            $post->tags()->sync($tags);
            DB::commit();
            return redirect()->route('posts.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
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

    public function deletePost($id)
    {
        return $this->getPost($id)->delete();
    }

    public function getPostImage($id)
    {
        return $this->getPost($id)->image;
    }

    public function postsInModeration()
    {
        return $this->post
            ->where('is_published', '=', '0')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function allowPost($id)
    {
        $post = $this->getPost($id);
        $post->update(['is_published' => '1']);
    }

    public function viewedPosts()
    {
        return $this->post
            ->where('is_published', '=', '1')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
    }

    public function discussedPosts()
    {
        return $this->post
            ->withCount('comments')
            ->where('is_published', '=', '1')
            ->orderBy('comments_count', 'desc')
            ->limit(5)
            ->get();
    }

}
