<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Closure;
use Session;
use App;
use Config;


class Language
{
    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(in_array(Session::get('my_locale'), ['en', 'id'])){
            $language = Session::get('my_locale', Config::get('app.locale'));
            App::setLocale($language);
        }
        return $next($request);
    }
}
