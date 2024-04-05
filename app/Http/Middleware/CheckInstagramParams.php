<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstagramParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = $request->query('code');
        $state = $request->query('state');

        if (!$code || !$state) {
            return response()->json(['error' => 'Parametros code e state sao obrigatorios.'], 400);
        }

        return $next($request);
    }
}
