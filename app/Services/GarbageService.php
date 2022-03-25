<?php

namespace App\Services;

use App\Repositories\GarbageRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GarbageService
{
    protected $garbageRepository;

    public function __construct(GarbageRepository $garbageRepository)
    {
        $this->garbageRepository = $garbageRepository;
    }

    public function trashedPosts()
    {
        return $this->garbageRepository->trashedPosts();
    }

    public function trashedUsers()
    {
        return $this->garbageRepository->trashedUsers();
    }

    public function trashedComments()
    {
        return $this->garbageRepository->trashedComments();
    }

    public function getPost($id)
    {
        return $this->garbageRepository->getPost($id);
    }

    public function updatePost($data, $id)
    {
        $postdata = $data->validated();
        $tags = $data->tags;

        if ($data->hasFile('image')) {
            $postdata['image'] = $this->updatePostImage($id, $data['image'], isset($data['deleteimg']));
        } else {
            $postdata['image'] = $this->updatePostImage($id, $data['image'] = false, isset($data['deleteimg']));
        }

        return $this->garbageRepository->updatePost($postdata, $tags, $id);
    }

    public function updatePostImage($id, $image, $save)
    {
        $postimage = $this->garbageRepository->getPostImage($id); //поиск картинки по ид
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

    public function restorePost($id)
    {
        return $this->garbageRepository->restorePost($id);
    }

    public function deletePost($id)
    {
        return $this->garbageRepository->deletePost($id);
    }

    public function getUser($id)
    {
        return $this->garbageRepository->getUser($id);
    }

    public function updateUser($data, $id)
    {
        //Здесь нужно проверить не null ли пароль (если null - оставить старый)
        //И чекнуть имя на уникальность (если отличается от текущего)
        $userdata = $data->validated();
        $userdata['password'] = Hash::make($data['password']);
        if ($data->hasFile('avatar')) {
            $userdata['avatar'] = $this->updateAvatar($id, $data['avatar'], isset($data['deleteimg']));
        } else {
            $userdata['avatar'] = $this->updateAvatar($id, $data['avatar'] = false, isset($data['deleteimg']));
        }
        return $this->garbageRepository->updateUser($userdata, $id);
    }

    public function updateAvatar($id, $image, $save)
    {
        $avatar = $this->garbageRepository->getUserAvatar($id);
        if ($image) {
            //Пришло новое изображение, загружаем
            $image = Storage::disk('public')->put('/images/avatars', $image);
        } else {
            if ($avatar == 'images/avatars/noavatar.png') {
                //изображение не пришло, но его и небыло ранее
                $image = 'images/avatars/noavatar.png';
            } else {
                //изображение не пришло, присутствует ранее загруженное
                if ($save) {
                    $image = 'images/avatars/noavatar.png';
                } else {
                    $image = $avatar;
                }
            }
        }
        return $image;
    }

    public function restoreUser($id)
    {
        return $this->garbageRepository->restoreUser($id);
    }

    public function deleteUser($id)
    {
        return $this->garbageRepository->deleteUser($id);
    }

    public function getComment($id)
    {
        return $this->garbageRepository->getComment($id);
    }

    public function updateComment($data, $id)
    {
        return $this->garbageRepository->updateComment($data, $id);
    }

    public function deleteComment($id)
    {
        return $this->garbageRepository->deleteComment($id);
    }

    public function restoreComment($id)
    {
        return $this->garbageRepository->restoreComment($id);
    }
}
