<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Allow scripts from Vite and inline scripts
        $csp = "script-src 'self' 'unsafe-inline' 'wasm-unsafe-eval' 'inline-speculation-rules' http://127.0.0.1:5173;";

        // Add or set the Content-Security-Policy header
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
