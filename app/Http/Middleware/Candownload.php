<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Candownload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $article = $request->route('article');
        $user = $request->user();
        if ($user->id != $article->author_id && $user->role_id != 1 && $user->role_id != 2) {
            abort(403, 'Unauthorized action.');
        }


        return $next($request);
    }
}
