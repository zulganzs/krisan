<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     * Set the application locale based on session
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            \Illuminate\Support\Facades\Log::info('SetLocale Middleware: Setting locale to ' . $locale);
            if (in_array($locale, ['en', 'id'])) {
                App::setLocale($locale);
            }
        } else {
            \Illuminate\Support\Facades\Log::info('SetLocale Middleware: No locale in session');
        }

        return $next($request);
    }
}
