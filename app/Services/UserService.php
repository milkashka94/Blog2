<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function createUser($data)
    {
        if (!Auth::user()->hasPermission('roles-management')) {
            unset($data['role_id']);
        }
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function getUser($id)
    {
        return $this->userRepository->getUser($id);
    }

    public function updateUser($data, $id)
    {
        $userdata = $data->validated();

        if (!Auth::user()->hasPermission('roles-management')) {
            unset($userdata['role_id']);
        }

        if($data['password'] == null) {
            $userdata['password'] = $this->getUser($id)->password;
        } else {
            $userdata['password'] = Hash::make($data['password']);
        }

        if($data['name'] == $this->getUser($id)->name) {
            $userdata['name'] = $this->getUser($id)->name;
        } else {
            if($this->userRepository->searchUser('name', $data['name']) == null) {
                $userdata['name'] = $data['name'];
            } else {
                return redirect()->back()->with('unique_login', 'имя не уникально');
            }
        }

        if($data['email'] == $this->getUser($id)->email) {
            $userdata['email'] = $this->getUser($id)->email;
        } else {
            if($this->userRepository->searchUser('email', $data['email']) == null) {
                $userdata['email'] = $data['email'];
            } else {
                return redirect()->back()->with('unique_email', 'email не уникален');
            }
        }

        if ($data->hasFile('avatar')) {
            $userdata['avatar'] = $this->updateAvatar($id, $data['avatar'], isset($data['deleteimg']));
        } else {
            $userdata['avatar'] = $this->updateAvatar($id, $data['avatar'] = false, isset($data['deleteimg']));
        }
        return $this->userRepository->updateUser($userdata, $id);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    public function updateAvatar($id, $image, $save)
    {
        $avatar = $this->userRepository->getUserAvatar($id);
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

    public function getUsersByGroup($id)
    {
        return $this->userRepository->getUsersByGroup($id);
    }
}
