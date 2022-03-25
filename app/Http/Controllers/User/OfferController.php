<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\StoreRequest;
use App\Http\Requests\User\Post\UpdateRequest;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\TagService;
use Illuminate\Http\Request;

class OfferController extends Controller
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
        return view('user.pages.posts.offer', compact('categories', 'tags'));
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
        return redirect()->route('posts.index')->with('success', 'Пост поступил на проверку');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->getPost($id);
        return view('pages.user.posts.single', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        return redirect()->route('user.posts.moderate')->with('success', 'Пост изменен');
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
        return redirect()->route('user.posts.moderate')->with('success', 'Пост удален');
    }

}
