<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role
            ->paginate(10);
    }

    public function getRole($id)
    {
        return $this->role
            ->where('id', $id)
            ->firstOrFail();
    }

    public function deleteRole($id)
    {
        $this->getRole($id)->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Роль удалена');
    }

    public function updateRole($data, $permissions = null, $id)
    {
        $role = $this->getRole($id);
        try {
            DB::BeginTransaction();
            $role->update($data);
            $role->permissions()->sync($permissions);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function createRole($data, $permissions = null)
    {
        try {
            DB::BeginTransaction();
            $role = Role::create($data);
            $role->permissions()->sync($permissions);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function rolesList()
    {
        return $this->role
            ->all();
    }

    public function getUsers($id)
    {
        return $this
            ->getRole($id)
            ->users()
            ->paginate(10);
    }
}
