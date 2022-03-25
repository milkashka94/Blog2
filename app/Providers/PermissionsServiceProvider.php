<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
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
        Blade::directive('checkpermission', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$permission})): ?>";
        });

        Blade::directive('endcheck', function ($permission) {
            return "<?php endif; ?>";
        });
    }
}
