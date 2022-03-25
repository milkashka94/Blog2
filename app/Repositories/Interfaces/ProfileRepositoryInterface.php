<?php

namespace App\Repositories\Interfaces;

interface ProfileRepositoryInterface
{
    public function getProfile($name);
    public function updateProfile($data, $name);
    public function getUserAvatar($name);
    public function searchUser($field, $param);
}
