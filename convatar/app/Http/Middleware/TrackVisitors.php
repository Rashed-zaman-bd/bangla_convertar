<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Count only successful public page views.
        if (
            $request->isMethod('GET') &&
            $response->isSuccessful() &&
            !$request->is('admin/*') &&
            !$request->is('login') &&
            !$request->is('register')
        ) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'page_url' => $request->path(),
            ]);
        }

        return $response;
    }
}

