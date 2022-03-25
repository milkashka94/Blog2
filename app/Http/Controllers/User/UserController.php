<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAll();
        $roles = $this->roleService->rolesList();
        return view('user.pages.users.list', compact('users', 'roles'));
    }


    public function roles($id)
    {
        $users = $this->userService->getUsersByGroup($id);
        $roles = $this->roleService->rolesList();
        return view('user.pages.users.list', compact('users', 'roles'));
    }
}
