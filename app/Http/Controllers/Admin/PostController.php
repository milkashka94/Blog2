<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Services\PostService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    protected $postService;
    protected $categoryService;
    protected $tagService;

    public function __construct(PostService $postService,
                                CategoryService $categoryService,
                                TagService $tagService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('admin.pages.posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->TagsForPost();
        return view('admin.pages.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->postService->createPost($request);
        return redirect()->route('admin.posts.index')->with('success', 'Пост создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->getPost($id);
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->TagsForPost();
        return view('admin.pages.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->postService->updatePost($request, $id);
        return redirect()->route('admin.posts.index')->with('success', 'Пост изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('admin.posts.index')->with('success', 'Пост удален');
    }

    public function moderationList()
    {
        $posts = $this->postService->postsInModeration();
        return view('admin.pages.posts.moderation.list', compact('posts'));
    }

    public function checkPost($id)
    {
        $post = $this->postService->getPost($id);
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->TagsForPost();
        return view('admin.pages.posts.moderation.moderate', compact('post', 'categories', 'tags'));
    }

    public function allow($id)
    {
        $this->postService->allowPost($id);
        return redirect()->route('admin.posts.moderate.index')->with('success', 'Пост опубликован');
    }

}
