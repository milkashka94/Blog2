<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Comment\StoreRequest;
use App\Http\Requests\User\Comment\UpdateRequest;
use App\Services\CategoryService;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentService->getAll();
        return view('user.pages.comments.list', compact('comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($postId, StoreRequest $request)
    {
        $this->commentService->addComment($postId, $request->validated());
        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $comment = $this->commentService->getComment($id);
        return view('user.pages.comments.edit', compact('comment'));
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
        $this->commentService->updateComment($request->validated(), $id);
        return redirect()->route('index')->with('success', 'Комментарий изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((Auth::check()) and (Auth::user()->hasPermission('delete-comments'))) {
            $this->commentService->deleteComment($id);
            return redirect()->back()->with('success', 'Комментарий удален');
        } else {
            return redirect()->back();
        }
    }
}
