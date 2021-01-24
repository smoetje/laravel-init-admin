<?php

namespace Smoetje\LaravelInitAdmin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InitApplication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->method() === 'GET' && !\App\Models\User::where('is_admin', true)->first()) {
            return redirect()->route('init_application');
        }
        return $next($request);
    }
}
