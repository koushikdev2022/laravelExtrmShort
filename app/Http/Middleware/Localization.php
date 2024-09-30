<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('locale')){
            $locale = session()->get('locale');
            App::setLocale($locale);
        }else{
            App::setLocale('en');
            session()->put('locale', "en");
        }
        return $next($request);
    }
}
