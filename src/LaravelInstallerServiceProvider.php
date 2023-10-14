<?php

namespace LazyCode404\laravelwebinstaller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;
use LazyCode404\laravelwebinstaller\middleware\SetupMiddleware;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if(!config('installer.setup_completed')){
            return Redirect::to('setup/start');
            $this->app['router']->aliasMiddleware('custom', SetupMiddleware::class);
        }

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
        $this->publishes([
            __DIR__.'/config' => config_path('installer.php'),
        ], 'laravelinstaller');
    }
}
