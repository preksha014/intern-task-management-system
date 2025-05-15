<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LoadPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Load all permissions and store them in the request
        $permissions = Cache::remember('permissions', 60, function () {
            return Permission::with('roles')->get();
        });
        
        $request->attributes->set('permissions', $permissions);
        
        return $next($request);
    }
}
