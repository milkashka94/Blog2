<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
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
            $tags = $this->tagService->getAll();
            return view('user.pages.tags.list', compact('tags'));
        } else {
            $posts = $this->tagService->getPosts($id);
            return view('user.pages.tags.posts', compact('posts'));
        }
    }
}
