<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Responses\BaseResponse as Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{
    Request
};

class Authenticate extends Middleware
{
    use Response;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! Auth::guard('api')->check()) {
            return redirect()->route('unauthenticated');
        }
    }
}
