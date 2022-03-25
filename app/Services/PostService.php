<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }

    public function postsInModeration()
    {
        return $this->postRepository->postsInModeration();
    }

    public function getPost($id)
    {
        return $this->postRepository->getPost($id);
    }

    public function createPost($data)
    {
        $postdata = $data->validated();
        $postdata['author_id'] = Auth::user()->id;
        if (Auth::user()->hasPermission('posts-without-moderation')) {
            $postdata['is_published'] = 1;
        } else {
            $postdata['is_published'] = 0;
        }
        $tags = $data->tags;
        if(isset($postdata['image'])) {
            $postdata['image'] = Storage::disk('public')->put('/images', $data['image']);
        }

        return $this->postRepository->createPost($postdata, $tags);
    }

    public function updatePost($data, $id)
    {
        $postdata = $data->validated();
        $tags = $data->tags;
        $postdata['updated_by'] = Auth::user()->id;
        if ($data->hasFile('image')) {
            $postdata['image'] = $this->updatePostImage($id, $data['image'], isset($data['deleteimg']));
        } else {
            $postdata['image'] = $this->updatePostImage($id, $data['image'] = false, isset($data['deleteimg']));
        }

        return $this->postRepository->updatePost($postdata, $tags, $id);
    }

    public function deletePost($id)
    {
        return $this->postRepository->deletePost($id);
    }

    public function allowPost($id)
    {
        return $this->postRepository->allowPost($id);
    }

    public function updatePostImage($id, $image, $save)
    {
        $postimage = $this->postRepository->getPostImage($id); //поиск картинки по ид
        if ($image) {
            //Пришло новое изображение, загружаем
            $image = Storage::disk('public')->put('/images', $image);
        } else {
            if ($postimage == 'images/no_image.png') {
                //изображение не пришло, но его и небыло ранее
                $image = 'images/no_image.png';
            } else {
                //изображение не пришло, присутствует ранее загруженное
                if ($save) {
                    $image = 'images/no_image.png';
                } else {
                    $image = $postimage;
                }
            }
        }
        return $image;
    }

    public function viewedPosts()
    {
        return $this->postRepository->viewedPosts();
    }

    public function discussedPosts()
    {
        return $this->postRepository->discussedPosts();
    }
}
