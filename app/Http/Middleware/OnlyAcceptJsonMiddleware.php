<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAcceptJsonMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod('post')) return $next($request);


        $header = $request->header('Content-Type');
        if ($header != 'application/json') {
            return response()->json([], 415);
        }

        return $next($request);
    }
}
