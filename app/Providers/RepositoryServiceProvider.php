<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
