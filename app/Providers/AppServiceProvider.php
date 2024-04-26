<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission; // Adjust the namespace according to your application structure
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('path.public', function() {
            return base_path().'/public_html';
          });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
