<?php

use App\MultidomainApplication;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

// Configure the multidomain application with environment path
return MultidomainApplication::configure(
    basePath: dirname(__DIR__),
    environmentPath: dirname(__DIR__) . DIRECTORY_SEPARATOR . 'envs'
)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register front middleware alias - uses FrontModulesMiddleware to dynamically resolve module-specific Front middleware
        $middleware->alias([
            'front' => \App\Http\Middleware\FrontModulesMiddleware::class,
            'sw_permission' => \Modules\Software\Http\Middleware\SwPermission::class,
            'initialize_user' => \Modules\Software\Http\Middleware\InitializeUser::class,
            'lang' => \Modules\Generic\Http\Middleware\Lang::class,
            'sw_customer' => \Modules\Software\Http\Middleware\RedirectCustomerIfNotAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
