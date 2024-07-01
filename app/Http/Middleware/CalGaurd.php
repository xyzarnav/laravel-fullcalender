<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CalGaurd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Fetch all user IDs from the panel_admins table
        $adminUserIds = \Illuminate\Support\Facades\DB::table('panel_admins')->pluck('user_id')->toArray();

        // Check if the user is logged in and their user ID is in the panel_admins table
        if (auth()->check() && in_array(auth()->user()->id, $adminUserIds)) {
            // User is authenticated and is a panel admin, proceed with the request
            return $next($request);
        } else {
            // User is not authenticated or not a panel admin, redirect them
            return redirect('/')->with('error', 'You do not have access to this page.');
        }
    }
}
