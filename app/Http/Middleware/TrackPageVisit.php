<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use App\Services\GeolocationService;

class TrackPageVisit
{
    protected array $excludePrefixes = [
        'admin',
        'storage',
        'css',
        'js',
        'images',
    ];

    protected array $excludeExact = [
        'favicon.ico',
        'sitemap.xml',
        'robots.txt',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!$request->isMethod('get') && !$request->isMethod('head')) {
            return $response;
        }

        $path = ltrim($request->path(), '/');
        if (in_array($path, $this->excludeExact, true)) {
            return $response;
        }

        foreach ($this->excludePrefixes as $prefix) {
            if ($request->is($prefix . '*')) {
                return $response;
            }
        }

        $ip = $this->getClientIp($request) ?? $request->ip();
        $location = app(GeolocationService::class)->getLocation($ip);

        PageVisit::create([
            'path' => $request->path() === '/' ? '/' : '/' . $request->path(),
            'full_url' => $request->fullUrl(),
            'referrer' => $request->headers->get('referer'),
            'ip' => $ip,
            'user_agent' => $request->userAgent(),
            'device_type' => $this->detectDeviceType($request->userAgent()),
            'country' => $location['country'] ?? null,
            'state' => $location['state'] ?? null,
            'city' => $location['city'] ?? null,
            'district' => $location['district'] ?? null,
            'latitude' => $location['latitude'] ?? null,
            'longitude' => $location['longitude'] ?? null,
            'visited_at' => now(),
        ]);

        return $response;
    }

    private function getClientIp(Request $request): ?string
    {
        $candidates = [];
        $headerKeys = [
            'CF-Connecting-IP',
            'True-Client-IP',
            'X-Real-IP',
            'X-Forwarded-For',
        ];

        foreach ($headerKeys as $key) {
            $value = $request->headers->get($key);
            if (!$value) {
                continue;
            }
            foreach (explode(',', $value) as $part) {
                $ip = trim($part);
                if ($ip !== '') {
                    $candidates[] = $ip;
                }
            }
        }

        $candidates[] = $request->ip();

        foreach ($candidates as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }

        return $request->ip();
    }

    private function detectDeviceType(?string $userAgent): string
    {
        $ua = strtolower($userAgent ?? '');
        if ($ua === '') return 'unknown';
        if (preg_match('/mobile|android|iphone|ipad|ipod|blackberry|phone|opera mini|iemobile|wpdesktop/', $ua)) {
            return 'mobile';
        }
        return 'desktop';
    }
}
