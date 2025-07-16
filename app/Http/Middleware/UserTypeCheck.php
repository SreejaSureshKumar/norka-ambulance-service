<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class UserTypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$user_types): Response
    {
        $user_type_ids = array_map(function ($type) {
            $config_type = config("customredirects.user_types.{$type}");
            return $config_type ? $config_type : null;
        }, $user_types);

        $user_type_ids = array_filter($user_type_ids, function ($type) {
            return $type !== null;
        });

        if (in_array($request->user()->user_type, $user_type_ids)) {
            return $next($request);
        }


        return abort(403, 'Unauthorized!');
    }
}
