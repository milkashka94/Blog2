<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function getCategory($id)
    {
        return $this->categoryRepository->getCategory($id);
    }

    public function updateCategory($data, $id)
    {
        return $this->categoryRepository->updateCategory($data, $id);
    }

    public function deleteCategory($id)
    {
        if ($this->getPosts($id)->count() > 0) {
            return back()->with('error', 'В категории имеются посты, удаление запрещено');
        } else {
            return $this->categoryRepository->deleteCategory($id);
        }
    }

    public function getPosts($id)
    {
        return $this->categoryRepository->getPosts($id);
    }
}
