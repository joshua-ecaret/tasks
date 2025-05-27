<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestDuration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Start timer
        $start = microtime(true);

        // Process the request and get the response
        $response = $next($request);

        // Calculate duration in milliseconds
        $durationMs = round((microtime(true) - $start) * 1000);

        // Log method, path, and duration
        Log::info("{$request->method()} {$request->path()} took {$durationMs}ms");

        return $response;
    }
}
