<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserTypeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        $routeName = $request->route()->getName();
        //  Check if the route is permitted for the user's usertype
        $isRouteAllowed = \App\Models\ComponentPermission::where('usertype_id', $user->usertype->id)
            ->whereHas('component', function ($query) use ($routeName) {
                $query->where('component_path', $routeName);
            })
            ->exists();

        // Allow or deny access
        if ($isRouteAllowed) {
            return $next($request); // User has permission → proceed
        }

        // Deny access if the user does not have permission
        abort(403, 'You do not have permission to access this page.');
    }
}
