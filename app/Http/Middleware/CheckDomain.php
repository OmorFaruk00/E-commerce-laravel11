<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Get central domains from configuration
         $centralDomains = config('tenancy.central_domains', []);
        //  dd($centralDomains);

         // Normalize the current host
         $currentHost = strtolower(str_replace('www.', '', $request->getHost()));
 
         // Check if the current host matches any central domain
         if (!in_array($currentHost, $centralDomains)) {
             abort(403, 'Access denied. Central domain only.');
         }
 
         return $next($request);
    }
}
