<?php

namespace App\Http\Middleware;

use App\Models\Barbearia;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $slug = $request->route("slug");
        $barbearia = Barbearia::where("slug", $slug)->first();
        if($user && $barbearia->owner_id === $user->id) {
            return $next($request);
        } else {
            return redirect()->back();
        }

    }
}
