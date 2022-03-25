<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user
            ->orderby('id','desc')
            ->paginate(10);
    }

    public function createUser($data)
    {
        return $this->user->create($data);
    }

    public function getUser($id)
    {
        return $this->user
            ->where('id', $id)
            ->firstOrFail();
    }

    public function updateUser($data, $id)
    {
        $this->getUser($id)->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Изменения внесены');
    }

    public function deleteUser($id)
    {
        return $this->getUser($id)->delete();
    }

    public function getUserAvatar($id)
    {
        return $this->getUser($id)->avatar;
    }

    public function searchUser($field, $param)
    {
        return $this->user
            ->where($field, $param)
            ->first();
    }

    public function getUsersByGroup($id)
    {
        return $this->user->where('role_id', $id)->paginate(10);
    }
}
