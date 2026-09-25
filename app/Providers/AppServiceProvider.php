<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    public function boot(): void
    {
        // Prefer S3 when configured and no explicit disk set.
        if (config('filesystems.default') === 'local'
            && env('AWS_ACCESS_KEY_ID')
            && env('AWS_SECRET_ACCESS_KEY')
            && env('AWS_BUCKET')) {
            config(['filesystems.default' => 's3']);
        }

        // Share nav services with header
        View::composer('layouts.app', function ($view) {
            try {
                $navServices = \App\Models\Service::where('is_active', 1)
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('id', 'asc')
                    ->take(8)
                    ->get();
                $view->with('navServices', $navServices);
            } catch (\Exception $e) {
                $view->with('navServices', collect());
            }
        });
    }
}
