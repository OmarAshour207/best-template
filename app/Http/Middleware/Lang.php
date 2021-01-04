<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Lang
{

    public function handle($request, Closure $next)
    {
        if (session('lang') == null) {
            session()->put('lang', config('app.locale'));
//            $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
//            foreach ($userLanguages as $userLanguage) {
//                if (array_key_exists($userLanguage, config('locales.languages'))) {
//                    app()->setLocale($userLanguage);
//                    setlocale(LC_TIME, config('locales.languages')[$userLanguage]['unicode']);
//                    Carbon::setLocale(config('locales.languages')[$userLanguage]['lang']);
//                    session()->put('lang', app()->getLocale());
//                    break;
//                }
//            }
        }
        app()->setlocale(session('lang', config('app.locale')));
        return $next($request);
    }
}
