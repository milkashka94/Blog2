<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionSernice;

    public function __construct(RoleService $roleService,
                                PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionSernice = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->getAll();
        return view('admin.pages.roles.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionSernice->getAll();
        return view('admin.pages.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->roleService->createRole($request);
        return redirect()->route('admin.roles.index')->with('success', 'Роль создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleService->getRole($id);
        $permissions = $this->permissionSernice->getAll();
        return view('admin.pages.roles.edit', compact('role', 'permissions'));
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
        $this->roleService->updateRole($request, $id);
        return redirect()->route('admin.roles.index')->with('success', 'Роль изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->roleService->deleteRole($id);
    }
}
