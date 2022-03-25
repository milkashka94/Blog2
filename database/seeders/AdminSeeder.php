<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'Admin@admin.adm';
        $user->avatar = 'images/avatars/noavatar.png';
        $user->role_id = '2';
        $user->password = Hash::make('123456789');
        $user->save();
    }
}
