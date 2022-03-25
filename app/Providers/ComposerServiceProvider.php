<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.includes.menu', function ($view) {
            //подсчёт постов ожидающих модерации для админки
            $view->with('moderation_posts', Post::where('is_published', '=', '0')->count());
        });

        view()->composer('admin.pages.index', function ($view) {
            $view->with('posts', Post::count());    //подсчёт кол-ва постов для главной админки
            $view->with('comments', Comment::count());  //подсчёт кол-ва комментов для главной админки
            $view->with('users', User::count());    //подсчёт кол-ва юзеров для главной админки
        });
    }
}
