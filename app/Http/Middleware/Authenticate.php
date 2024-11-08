<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()){
            if ($request->routeIs('admin.*')) {
                session()->flash('fail', 'You must login first');
                return route('admin.login'); 
            }

            if ($request->routeIs('seller.*')) {
                session()->flash('fail', 'You must login first');
                return route('seller.login');
            }

            if ($request->routeIs('buyer.*')) {
                session()->flash('fail', 'You must login first');
                return route('buyer.login');
            }
        }

        // Return null when the request expects JSON (like in API requests)
        return null;
    }
}
