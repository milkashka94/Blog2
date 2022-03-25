<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function getAll();
    public function getPost($id);
    public function createPost($data, $tags = null);
    public function updatePost($data, $tags = null, $id);
    public function deletePost($id);
    public function getPostImage($id);
    public function postsInModeration();
    public function allowPost($id);
    public function viewedPosts();
    public function discussedPosts();
}
