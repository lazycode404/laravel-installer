<?php

namespace LazyCode404\laravelwebinstaller\middleware;

use Closure;
use Artisan;
use Illuminate\Http\Request;


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
        $setupStatus = setupStatus();
        if($request->is('setup/*')){
            if($setupStatus){
                return redirect('/');
            }
            return $next($request);
        }
        if(!$setupStatus){
            return redirect()->route('setup.index');
        }
        return $next($request);
    }
}
