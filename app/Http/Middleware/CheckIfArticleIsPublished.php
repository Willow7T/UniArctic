<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Article;
use Symfony\Component\HttpFoundation\Response;

class CheckIfArticleIsPublished
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $article = Article::find($request->id);

        if (!$article || (!$article->published 
        && auth()->user()->role_id != 3 
        && auth()->user()->role_id != 2
        && auth()->user()->role_id != 1
        && auth()->user()->id != $article->author_id
        )){
            // Redirect or show error
            abort(404, 'Article is not published');
        }

        return $next($request);
    }
}
