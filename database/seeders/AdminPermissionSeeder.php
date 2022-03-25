<?php

namespace Database\Seeders;

use App\Models\Roles_permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '1';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '2';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '3';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '4';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '5';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '6';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '7';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '8';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '9';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '10';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '11';
        $permission->save();

        $permission = new Roles_permissions();
        $permission->role_id = '2';
        $permission->permission_id = '12';
        $permission->save();
    }
}
