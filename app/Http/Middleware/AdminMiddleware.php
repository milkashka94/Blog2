<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {

        $userperms = [];

        foreach(Auth::user()->role->permissions as $persmission) {
            $userperms[] = $persmission->slug;
        }

        $allow = collect(array_intersect($permissions, $userperms));

        if ((Auth::check()) and ($allow->isNotEmpty()) and (Auth::user()->hasPermission('moderate-posts'))) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
