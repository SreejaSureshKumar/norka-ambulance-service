<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthRedirector
{
    public function getRedirectRoute()
    {
        $user = Auth::user();
        // Ensure the user exists and has a usertype
        if (!$user || !$user->usertype) {
            return config('customredirects.redirects.default');
        }
        // Get the usertype ID
        $usertype_id = is_object($user->usertype) ? $user->usertype->id : $user->usertype;

        // Fetch the usertype name from the 'user_types' array in the config
        $user_types = config('customredirects.user_types');
        $usertype_name = array_search($usertype_id, $user_types);

        // Fetch the route using the usertype name from the 'redirects' array
        $redirects = config('customredirects.redirects');
        // If usertype_name is not found, fallback to 'default'
        $usertype_name = $usertype_name ?: 'default';

        

        // Fetch the route using the usertype name
        $route = $redirects[$usertype_name] ?? $redirects['default'];
        

        return $route;
    }
}
