<?php

namespace App\Http\Controllers\Admin\Garbage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Garbage\Comments\UpdateRequest;
use App\Services\GarbageService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $garbageService;

    public function __construct(GarbageService $garbageService)
    {
        $this->garbageService = $garbageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->garbageService->trashedComments();
        return view('admin.pages.garbage.comments.list', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = $this->garbageService->getComment($id);
        return view('admin.pages.garbage.comments.edit', compact('comment'));
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
        $this->garbageService->updateComment($request->validated(), $id);
        return redirect()->route('admin.garbage.comments.index')->with('success', 'Комментарий изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->garbageService->deleteComment($id);
        return redirect()->route('admin.garbage.comments.index')->with('success', 'Комментарий удален безвозвратно');
    }

    public function restore($id)
    {
        $this->garbageService->restoreComment($id);
        return redirect()->route('admin.garbage.comments.index')->with('success', 'Комментарий восстановлен');
    }
}
