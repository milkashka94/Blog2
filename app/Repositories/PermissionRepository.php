<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll()
    {
        return Permission::pluck('title', 'id')
            ->all();
    }
}
