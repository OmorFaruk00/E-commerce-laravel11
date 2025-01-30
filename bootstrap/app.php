<?php

use App\Console\Commands\TestCommand;
use App\Http\Middleware\CheckDomain;
use App\Http\Middleware\CommonAccessMiddleware;
use App\Http\Middleware\TestMiddlewere;
use App\Http\Middleware\TokenAuthMiddleware;
use App\Http\Middleware\LoggedInMiddlewere;
use App\Http\Middleware\RedirectToApps;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'CommonAccessMiddleware'=>CommonAccessMiddleware::class,
            'logged_in'=>LoggedInMiddlewere::class,
            'redirect_to_apps'=>RedirectToApps::class,
            'auth'=>TokenAuthMiddleware::class,
            'check_domain'=>CheckDomain::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        TestCommand::class, // Add your custom command here
    ])
    ->create();
