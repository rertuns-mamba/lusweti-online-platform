<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests to avoid counting API calls, form submissions, etc.
        if ($request->isMethod('GET') && !$request->is('admin/*') && !$request->is('livewire/*')) {
            PageView::create([
                'url' => $request->fullUrl(),
                'session_id' => $request->session()->getId(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'user_id' => Auth::id(),
                'viewed_at' => now(),
            ]);
        }

        return $response;
    }
}
