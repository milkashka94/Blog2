<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->title = 'Пользователь';
        $role_user->save();

        $role_admin = new Role();
        $role_admin->title = 'Администратор';
        $role_admin->save();
    }
}
