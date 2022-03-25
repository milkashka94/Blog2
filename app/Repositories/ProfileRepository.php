<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->profile = $user;
    }

    public function getProfile($name)
    {
        return User::where('name', '=', $name)->firstOrFail();
    }

    public function updateProfile($data, $name)
    {
        return $this->getProfile($name)->update($data);
    }

    public function getUserAvatar($name)
    {
        return $this->getProfile($name)->avatar;
    }

    public function searchUser($field, $param)
    {
        return $this->profile
            ->where($field, $param)
            ->first();
    }
}
