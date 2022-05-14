<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsProfessional
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        if (! $user || ! $user->isProfessional() ) {
            return redirect()->route('unauthorized');
        }

        return $next($request);
    }
}
