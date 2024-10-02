<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();
        $tenant = Tenant::where('domain', $domain)->first();
        if (!$tenant) {
            (new TenantService())->switchToDefault();
            return $next($request);
        }
        (new TenantService())->switchToTenant($tenant);
        return $next($request);
    }
}
