<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category
            ->paginate(10);
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function getCategory($id)
    {
        return $this->category
            ->where('id', $id)
            ->firstOrFail();
    }

    public function updateCategory($data, $id)
    {
        return $this->getCategory($id)->update($data);
    }

    public function deleteCategory($id)
    {
        $this->getCategory($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена');
    }

    public function getPosts($id)
    {
        return $this
            ->getCategory($id)
            ->posts()
            ->where('is_published', '=', '1')
            ->paginate(10);
    }
}
