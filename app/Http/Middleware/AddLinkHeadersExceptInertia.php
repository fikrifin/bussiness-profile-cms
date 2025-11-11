<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets as FrameworkAddLinkHeaders;

class AddLinkHeadersExceptInertia
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Let the request be handled first
        $response = $next($request);

        // Skip adding preload Link headers for Inertia partial JSON responses
        if ($request->header('X-Inertia')) {
            return $response;
        }

        // Delegate to the framework middleware to append Link headers
        $middleware = app(FrameworkAddLinkHeaders::class);
        return $middleware->handle($request, fn () => $response);
    }
}
