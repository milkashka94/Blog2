<?php

namespace App\Http\Controllers\Admin\Garbage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Garbage\Posts\UpdateRequest;
use App\Services\CategoryService;
use App\Services\GarbageService;
use App\Services\TagService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $garbageService;

    public function __construct(GarbageService $garbageService,
                                CategoryService $categoryService,
                                TagService $tagService)
    {
        $this->garbageService = $garbageService;
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
        $posts = $this->garbageService->trashedPosts();
        return view('admin.pages.garbage.posts.list', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->garbageService->getPost($id);
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->TagsForPost();
        return view('admin.pages.garbage.posts.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->garbageService->getPost($id);
        $categories = $this->categoryService->getAll();
        $tags = $this->tagService->TagsForPost();
        return view('admin.pages.garbage.posts.edit', compact('post', 'categories', 'tags'));
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
        $this->garbageService->updatePost($request, $id);
        return redirect()->route('admin.garbage.posts.index')->with('success', 'Пост изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->garbageService->deletePost($id);
        return redirect()->route('admin.garbage.posts.index')->with('success', 'Пост удален безвозвратно');
    }

    public function restore($id)
    {
        $this->garbageService->restorePost($id);
        return redirect()->route('admin.garbage.posts.index')->with('success', 'Пост восстановлен');
    }
}
