<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
        // Get the current domain
        $domain = $request->getHost();

        // Find the tenant by domain
        $tenant = Tenant::where('domain', $domain)->first();

        // Check if tenant exists
        if (!$tenant) {
            // Handle case when tenant is not found (e.g., return 404 or redirect)
            abort(404, 'Tenant not found');
        }

        // Switch to the tenant
        (new TenantService())->switchToTenant($tenant);

        // Continue processing the request
        return $next($request);
    }
}
