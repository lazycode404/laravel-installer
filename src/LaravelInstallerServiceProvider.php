<?php

namespace LazyCode404\laravelwebinstaller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;
use LazyCode404\laravelwebinstaller\middleware\SetupMiddleware;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Check if the installation is complete and redirect if not
        if (!$this->isInstallationComplete() && !$this->app->runningInConsole()) {
            $this->app['router']->get('/', function () {
                return redirect('/setup/start');
            });
        }
        $this->app['router']->middlewareGroup('web', [
            SetupMiddleware::class,
        ]);
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
        $this->publishes([
            __DIR__.'/config' => config_path('installer.php'),
        ], 'laravelinstaller');
    }
    private function isInstallationComplete()
    {
        // Replace this with your logic to check if the installation is complete.
        return config('installer.setup_completed', false);
    }
}
