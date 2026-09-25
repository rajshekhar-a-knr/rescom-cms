<?php

if (!function_exists('setting')) {
    /**
     * Get a site setting value by key.
     */
    function setting(string $key, $default = null): mixed
    {
        static $settings = null;

        if ($settings === null) {
            try {
                $settings = \Illuminate\Support\Facades\Cache::remember(
                    'settings.all',
                    3600,
                    fn () => \App\Models\Setting::pluck('value', 'key')->toArray()
                );
            } catch (\Exception $e) {
                $settings = [];
            }
        }

        if (!array_key_exists($key, $settings)) {
            return $default;
        }

        $val = $settings[$key];
        if (($val === '' || $val === null) && $default !== null) {
            return $default;
        }

        return $val;
    }
}

if (!function_exists('clear_settings_cache')) {
    function clear_settings_cache(): void
    {
        try {
            \Illuminate\Support\Facades\Cache::forget('settings.all');
        } catch (\Exception $e) {
            // Ignore cache errors; settings will still load directly.
        }
    }
}

if (!function_exists('recaptcha_site_key')) {
    function recaptcha_site_key(): string
    {
        return trim((string) setting('recaptcha_site_key', env('RECAPTCHA_SITE_KEY')));
    }
}

if (!function_exists('verify_recaptcha_response')) {
    function verify_recaptcha_response(\Illuminate\Http\Request $request): bool
    {
        $recaptchaSecret = trim((string) setting('recaptcha_secret_key', env('RECAPTCHA_SECRET_KEY')));

        if ($recaptchaSecret === '' || !$request->filled('g-recaptcha-response')) {
            return false;
        }

        try {
            $verify = \Illuminate\Support\Facades\Http::asForm()
                ->timeout(8)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $recaptchaSecret,
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip(),
                ]);
        } catch (\Throwable $e) {
            return false;
        }

        return (bool) ($verify->json('success') ?? false);
    }
}

if (!function_exists('admin_url')) {
    function admin_url(string $path = ''): string
    {
        return url('/admin' . ($path ? '/' . ltrim($path, '/') : ''));
    }
}

if (!function_exists('format_file_size')) {
    function format_file_size(int $bytes): string
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }
}

if (!function_exists('reading_time')) {
    function reading_time(string $content): int
    {
        $wordCount = str_word_count(strip_tags($content));
        return (int) ceil($wordCount / 200);
    }
}

if (!function_exists('media_url')) {
    function media_url(?string $value): string
    {
        if (!$value) return '';
        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        $spacesBase = env('DO_SPACES_PATH');
        if ($spacesBase) {
            return rtrim($spacesBase, '/') . '/' . ltrim($value, '/');
        }

        return \Illuminate\Support\Facades\Storage::url($value);
    }
}

if (!function_exists('upload_to_storage')) {
    function upload_to_storage(\Illuminate\Http\UploadedFile $file, string $type): string
    {
        $companyCode = env('COMPANY_CODE', 'SITE');
        $academicYear = date('Y');
        $storageService = app(\App\Services\SchoolStorageService::class);
        $safeFileName = $storageService->generateSafeFilename($file->getClientOriginalName(), $companyCode);
        $uploadPath = $file->getRealPath();

        $mime = (string) $file->getMimeType();
        $isImage = str_starts_with($mime, 'image/');
        $skipConvert = in_array($mime, ['image/svg+xml', 'image/gif'], true);
        $alreadyWebp = $mime === 'image/webp' || str_ends_with(strtolower($file->getClientOriginalName()), '.webp');
        if ($alreadyWebp) {
            $safeFileName = preg_replace('/\.[A-Za-z0-9]+$/', '.webp', $safeFileName);
        }

        $totalFiles = 0;
        $totalBytes = 0;
        try {
            foreach ($_FILES as $group) {
                if (is_array($group['size'] ?? null)) {
                    foreach ($group['size'] as $sz) { $totalFiles++; $totalBytes += (int) $sz; }
                } elseif (isset($group['size'])) {
                    $totalFiles++; $totalBytes += (int) $group['size'];
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }
        $batchTooLarge = $totalFiles > 4 || $totalBytes > 20 * 1024 * 1024;
        $sizeBytes = (int) $file->getSize();
        $canConvert = class_exists(\Intervention\Image\ImageManagerStatic::class);
        if ($isImage && !$skipConvert && !$alreadyWebp && $canConvert && !$batchTooLarge) {
            try {
                $tmp = tempnam(sys_get_temp_dir(), 'webp_');
                if (!$tmp) {
                    throw new \RuntimeException('Temp file create failed');
                }
                $webpPath = $tmp . '.webp';
                @rename($tmp, $webpPath);
                $img = \Intervention\Image\ImageManagerStatic::make($file->getRealPath());
                $maxDim = $sizeBytes > 6 * 1024 * 1024 ? 1280 : 1600;
                if ($img->width() > $maxDim || $img->height() > $maxDim) {
                    $img->resize($maxDim, $maxDim, function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    });
                }
                $quality = $sizeBytes > 6 * 1024 * 1024 ? 60 : 70;
                $img->encode('webp', $quality)->save($webpPath);

                $safeFileName = preg_replace('/\.[A-Za-z0-9]+$/', '.webp', $safeFileName);
                $uploadPath = $webpPath;
            } catch (\Exception $e) {
                // Fallback to original file if conversion fails
            }
        }

        $uploadResult = $storageService->uploadFile(
            $companyCode,
            $academicYear,
            $type,
            $uploadPath,
            $safeFileName,
            'public-read'
        );

        if (!$uploadResult['success']) {
            throw new \RuntimeException($uploadResult['message'] ?? 'File upload failed.');
        }

        if (isset($webpPath) && is_string($webpPath) && file_exists($webpPath)) {
            @unlink($webpPath);
        }

        return $uploadResult['url'];
    }
}
