<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function createUser($data);
    public function getUser($id);
    public function updateUser($data, $id);
    public function deleteUser($id);
    public function getUserAvatar($id);
    public function searchUser($field, $param);
    public function getUsersByGroup($id);
}
