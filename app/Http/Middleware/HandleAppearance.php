<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Inertia\Inertia;
=======
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
use Symfony\Component\HttpFoundation\Response;

class HandleAppearance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        Inertia::share('appearance', $request->cookie('appearance') ?? 'system');
=======
        if ($request->has('appearance') && in_array($request->appearance, ['light', 'dark'])) {
            $request->session()->put('appearance', $request->appearance);
        }
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235

        return $next($request);
    }
}
