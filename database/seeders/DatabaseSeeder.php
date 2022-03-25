<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        Role::factory('15')->create();
        User::factory('80')->create();
        Category::factory('30')->create();
        Tag::factory('80')->create();
        Post::factory('200')->create();
        Comment::factory('300')->create();
        $this->call(AdminPermissionSeeder::class);
        Post_tag::factory('200')->create();
    }
}
