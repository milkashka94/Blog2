<?php

namespace App\Repositories\Interfaces;

interface GarbageRepositoryInterface
{
    public function trashedPosts();
    public function getPost($id);
    public function updatePost($data, $tags = null, $id);
    public function getPostImage($id);
    public function restorePost($id);
    public function deletePost($id);
    public function trashedComments();
    public function getComment($id);
    public function updateComment($data, $id);
    public function deleteComment($id);
    public function restoreComment($id);
    public function trashedUsers();
    public function getUser($id);
    public function updateUser($data, $id);
    public function getUserAvatar($id);
    public function restoreUser($id);
    public function deleteUser($id);
}
