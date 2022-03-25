<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function createRole($data)
    {
        $roledata = $data->validated();
        $permissions = $data->permissions;
        return $this->roleRepository->createRole($roledata, $permissions);
    }

    public function getRole($id)
    {
        return $this->roleRepository->getRole($id);
    }

    public function updateRole($data, $id)
    {
        $roledata = $data->validated();
        $permissions = $data->permissions;
        return $this->roleRepository->updateRole($roledata, $permissions, $id);
    }

    public function deleteRole($id)
    {
        if ($this->getUsers($id)->count() > 0) {
            return back()->with('error', 'В данной роли имеются пользователи, удаление запрещено');
        } else {
            return $this->roleRepository->deleteRole($id);
        }
    }

    public function rolesList()
    {
        return $this->roleRepository->rolesList();
    }

    public function getUsers($id)
    {
        return $this->roleRepository->getUsers($id);
    }
}
