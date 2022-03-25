<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfile($name)
    {
        return $this->profileRepository->getProfile($name);
    }

    public function updateProfile($data, $name)
    {
        $userdata = $data->validated();

        if($data['password'] == null) {
            $userdata['password'] = $this->getProfile($name)->password;
        } else {
            $userdata['password'] = Hash::make($data['password']);
        }

        if($data['name'] == $this->getProfile($name)->name) {
            $userdata['name'] = $this->getProfile($name)->name;
        } else {
            if($this->profileRepository->searchUser('name', $data['name']) == null) {
                $userdata['name'] = $data['name'];
            } else {
                return redirect()->back()->with('unique_login', 'имя не уникально');
            }
        }

        if($data['email'] == $this->getProfile($name)->email) {
            $userdata['email'] = $this->getProfile($name)->email;
        } else {
            if($this->profileRepository->searchUser('email', $data['email']) == null) {
                $userdata['email'] = $data['email'];
            } else {
                return redirect()->back()->with('unique_email', 'email не уникален');
            }
        }

        if ($data->hasFile('avatar')) {
            $userdata['avatar'] = $this->updateAvatar($name, $data['avatar'], isset($data['deleteimg']));
        } else {
            $userdata['avatar'] = $this->updateAvatar($name, $data['avatar'] = false, isset($data['deleteimg']));
        }
        return $this->profileRepository->updateProfile($userdata, $name);
    }

    public function updateAvatar($name, $image, $save)
    {
        $avatar = $this->profileRepository->getUserAvatar($name);
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

}
