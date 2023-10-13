<?php

namespace LazyCode404\laravelwebinstaller;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use LazyCode404\laravelwebinstaller\middleware\SetupMiddleware;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('custom', SetupMiddleware::class);

    }
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishFiles();
        require_once __DIR__.'/helpers.php';
        Schema::defaultStringLength(191);
    }

    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/installer'),
        ], 'laravelinstaller');
        $this->publishes([
            __DIR__.'/database' => base_path('database/migrations'),
        ], 'laravelinstaller');
    }
}
