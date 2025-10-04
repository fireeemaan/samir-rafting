<?php

namespace App\Http\Middleware;

use App\Jobs\StoreVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);


        if ($request->method() !== 'GET' || !$request->acceptsHtml()) {
            return $response;
        }
        Log::info('Logged!');

        $ua = $request->userAgent() ?? '';
        $isBot = preg_match('/bot|spider|crawler|preview|slurp|curl|wget/i', $ua) === 1;

        $ip = $request->ip() ?? '0.0.0.0';
        $ipHash = hash('sha256', $ip . config('app.key'));
        $path = Str::limit($request->path(), 255, '');
        $throttleKey = "vlog:{$ipHash}:{$path}:" . now()->format('YmdHi');

        if (! Cache::add($throttleKey, 1, now()->addMinutes(1))) {
            return $response;
        }

        StoreVisit::dispatch([
            'occurred_at'  => now()->toImmutable(),
            'user_id'      => optional($request->user())->getKey(),
            'session_id'   => $request->session()->getId(),
            'ip_hash'      => $ipHash,
            'path'         => '/' . ltrim($path, '/'),
            'method'       => $request->method(),
            'referer'      => Str::limit($request->headers->get('referer', ''), 255, ''),
            'utm_source'   => $request->query('utm_source'),
            'utm_medium'   => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
            'is_bot'       => $isBot,
            'ua'           => Str::limit($ua, 255, ''),
        ]);

        return $response;
    }
}
