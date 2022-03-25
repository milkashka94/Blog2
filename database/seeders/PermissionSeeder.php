<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edit_users = new Permission();
        $edit_users->title = 'Редактирование пользователей';
        $edit_users->slug = 'edit-users';
        $edit_users->save();

        $delete_users = new Permission();
        $delete_users->title = 'Удаление пользователей';
        $delete_users->slug = 'delete-users';
        $delete_users->save();

        $create_comments = new Permission();
        $create_comments->title = 'Создание комментариев';
        $create_comments->slug = 'create-comments';
        $create_comments->save();

        $update_comments = new Permission();
        $update_comments->title = 'Редактирование комментариев';
        $update_comments->slug = 'update-comments';
        $update_comments->save();

        $delete_comments = new Permission();
        $delete_comments->title = 'Удаление комментариев';
        $delete_comments->slug = 'delete-comments';
        $delete_comments->save();

        $create_posts = new Permission();
        $create_posts->title = 'Добавление постов';
        $create_posts->slug = 'creation-posts';
        $create_posts->save();

        $posts_without_moderation = new Permission();
        $posts_without_moderation->title = 'Добавление постов без проверки';
        $posts_without_moderation->slug = 'posts-without-moderation';
        $posts_without_moderation->save();

        $update_posts = new Permission();
        $update_posts->title = 'Редактирование постов';
        $update_posts->slug = 'update-posts';
        $update_posts->save();

        $delete_posts = new Permission();
        $delete_posts->title = 'Удаление постов';
        $delete_posts->slug = 'delete-posts';
        $delete_posts->save();

        $moderate_posts = new Permission();
        $moderate_posts->title = 'Проверка постов';
        $moderate_posts->slug = 'moderate-posts';
        $moderate_posts->save();

        $basket_access = new Permission();
        $basket_access->title = 'Доступ в корзину';
        $basket_access->slug = 'basket-access';
        $basket_access->save();

        $roles_management = new Permission();
        $roles_management->title = 'Управление ролями';
        $roles_management->slug = 'roles-management';
        $roles_management->save();

    }
}
