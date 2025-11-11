<?php

namespace App\Modules\Stepfitness\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Front
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Handle language setup similar to Lang middleware
        $old_lang = $request->session()->get('lang');
        if (!$request->is('api/*') && !$request->is('operate') && !$request->is('operate/*')) {
            $systemLangs = explode(',', env('SYSTEM_LANG', 'ar,en'));
            if (!in_array($request->segment(1), $systemLangs)) {
                $defaultLang = env('DEFAULT_LANG', 'ar');
                $request->session()->put('lang', $defaultLang);
                app()->setLocale($defaultLang);

                if ($request->segment(1) == null) {
                    return redirect($request->url() . '/' . $defaultLang);
                } else {
                    return redirect(preg_replace('/' . $request->segment(1) . '/', $defaultLang . '/' . $request->segment(1), strtolower($request->url()), 1));
                }
            }
            $request->session()->put('lang', $request->segment(1));
            $current_lang = $request->session()->get('lang');
            if ($current_lang != $old_lang) {
                $request->session()->put('lang_changed', 1);
            } else {
                $request->session()->put('lang_changed', 0);
            }
            app()->setLocale($current_lang);
            View::share('lang', $request->segment(1));
        }
        
        return $next($request);
    }
}

