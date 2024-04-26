<?php 

// app/Providers/BladeServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('permission', function ($expression) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$expression})) : ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });
    }

    public function register()
    {
        // ...
    }
}
