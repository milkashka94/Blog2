<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id = null)
    {
        if ($id == null) {
            $categories = $this->categoryService->getAll();
            return view('user.pages.categories.list', compact('categories'));
        } else {
            $posts = $this->categoryService->getPosts($id);
            return view('user.pages.categories.posts', compact('posts'));
        }
    }
}
