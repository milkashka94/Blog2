<?php

namespace App\Http\Controllers\Admin\Garbage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Garbage\Users\UpdateRequest;
use App\Services\GarbageService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $garbageService;

    public function __construct(GarbageService $garbageService,
                                RoleService $roleService)
    {
        $this->garbageService = $garbageService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->garbageService->trashedUsers();
        return view('admin.pages.garbage.users.list', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->garbageService->getUser($id);
        $roles = $this->roleService->getAll();
        return view('admin.pages.garbage.users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->garbageService->getUser($id);
        $roles = $this->roleService->getAll();
        return view('admin.pages.garbage.users.edit', compact('user', 'roles'));
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
        $this->garbageService->updateUser($request, $id);
        return redirect()->route('admin.garbage.users.index')->with('success', 'Пользователь изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->garbageService->deleteUser($id);
        return redirect()->route('admin.garbage.users.index')->with('success', 'Пользователь удален безвозвратно');
    }

    public function restore($id)
    {
        $this->garbageService->restoreUser($id);
        return redirect()->route('admin.garbage.users.index')->with('success', 'Пользователь восстановлен');
    }
}
