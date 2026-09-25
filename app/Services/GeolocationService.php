<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GeolocationService
{
    public function getLocation(string $ip): ?array
    {
        // Skip private/local IPs (no geolocation available)
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return null;
        }

        $cacheKey = "geolocation_{$ip}";
        return Cache::remember($cacheKey, now()->addDays(7), function () use ($ip) {
            try {
                $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}");

                if ($response->successful()) {
                    $data = $response->json();

                    if ($data['status'] === 'success') {
                        return [
                            'country' => $data['country'] ?? null,
                            'state' => $data['regionName'] ?? null,
                            'city' => $data['city'] ?? null,
                            'district' => $data['district'] ?? null,
                            'latitude' => $data['lat'] ?? null,
                            'longitude' => $data['lon'] ?? null,
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Log error if needed
            }

            return null;
        });
    }
}