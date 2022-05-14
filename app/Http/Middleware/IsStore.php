<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStore
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();
        if (! $user || ! $user->isStore() ) {
            return response()->json('unauthorized', 413);
        }

        return $next($request);
    }
}
