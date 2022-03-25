<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function createCategory($data);
    public function getCategory($id);
    public function updateCategory($data, $id);
    public function deleteCategory($id);
    public function getPosts($id);
}
