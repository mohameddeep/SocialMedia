<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->query('lang', 'en');
        if ($lang === 'ar') {
            app()->setLocale('ar');
            Session::put('locale', $lang);
        } else {
            app()->setLocale('en');
            Session::put('locale', $lang);
        }
        return $next($request);
    }
}
