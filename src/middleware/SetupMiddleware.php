<?php

namespace LazyCode404\laravelwebinstaller\middleware;

use Artisan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class SetupMiddleware
{
    /**
     * Handle an incoming request.5
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_KEY') === null || empty(env('APP_KEY'))  && empty(config('app.key'))){
           Artisan::call('key:generate');
           Artisan::call('config:cache');
        }
        $setupCompleted = Config::get('installer.setup_completed');
        if(!$setupCompleted){
            $setupUrl = Config::get('installer.setup_url');
            return Redirect::to($setupUrl);
        }
        return $next($request);
    }
}
