<?php

namespace App\Modules\Cakorinas\app\Http\Middleware;

use App\Exceptions\ApplicationClosed;
use App\Modules\Cakorinas\Models\Setting;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class UnderMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->is('operate') && !request()->is('operate/*')
        &&
            !request()->is(app()->getLocale('lang').'') && !request()->is(app()->getLocale('lang').'/*')
        ) {

            $setting = Cache::store('file')->get('mainSettings');
            if (!$setting) {
                $setting = Setting::first();
                Cache::store('file')->put('mainSettings',$setting, 600 );
            }
            $under_maintenance = $setting->under_maintenance;
            if ($under_maintenance) {
//                throw new ApplicationClosed();
            }
            View::share('mainSettings', $setting);
        }
        return $next($request);
    }

}

