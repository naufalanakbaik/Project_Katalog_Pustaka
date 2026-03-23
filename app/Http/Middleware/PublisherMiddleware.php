<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublisherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/PublisherMiddleware.php

    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'publisher') {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses sebagai publisher');
    }
}
