<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getAll();
    public function createRole($data, $permissions = null);
    public function getRole($id);
    public function updateRole($data, $permissions = null, $id);
    public function deleteRole($id);
    public function rolesList();
    public function getUsers($id);
}
