<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Canreupload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $article = $request->route('article');
        $user = $request->user(); //dd($article->published);
        if (!$article->published && (
            $user->id == $article->author_id 
            || ($user->role_id == 3 && $user->facutly_id == $article->faculty_id))) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}
