<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = config('project.supported_locales');
        $locale = $request->route('locale') ?: config('project.default_locale');

        if ($locale && in_array($locale, array_keys($supportedLocales))) { // 检查 locale 参数是否存在且有效
            App::setLocale($supportedLocales[$locale]['lang']);
        } else {
            App::setLocale(config('app.locale')); // 设置默认语言，例如 'en'
        }
        $request->attributes->set('locale', $locale);
        \URL::defaults(['locale' => $locale]);
        \View::share('lang', $locale);

        return $next($request);
    }
}
