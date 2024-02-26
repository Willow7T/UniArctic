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
        $user = $request->user();
        if (!$article->published)
        {
            dd($article->published);
           if( $user->id != $article->author_id 
            && $user->role_id != 3) {
            abort(403, 'Unauthorized action.');
           
        }
        else
        {
            abort(403, 'Unauthorized action.');
        }
        
        }


        return $next($request);
    }
}
