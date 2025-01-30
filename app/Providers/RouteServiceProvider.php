<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use PSpell\Config;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     * 
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        parent::boot();

        
        // Customizations or bindings can be added here
    }

    /**
     * Configure the routes for the application.
     */
    public function map(): void
    {
        $this->routes(function () {
            // Central domain routes
            Route::middleware('web')
                ->domain(config('tenancy.central_domains')[0]) // Central domain
                ->group(base_path('routes/web.php'));
    
            // Tenant routes
            Route::middleware([
                'web',
                \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
                \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
            ])
            ->group(base_path('routes/tenant.php'));
        });
    }

    public function  centralDomain():array
    {
        return Config('tenancy.central_domains');

        
    }
}
