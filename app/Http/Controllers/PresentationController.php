<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PresentationController extends Controller
{
    /**
     * Map of product slug keywords to their single canonical presentation file.
     */
    protected array $slugMap = [
        'leap'                         => 'leap-presentation.html',
        'edxcore'                      => 'edxcore-presentation.html',
        'relcore'                      => 'relcore-presentation.html',
        'mktcore'                      => 'mktcore-presentation.html',
        'shopcore'                     => 'mktcore-presentation.html',
        'webcore'                      => 'webcore-presentation.html',
        'opscore'                      => 'opscore-presentation.html',
        'isaakshi'                     => 'isaakshi-presentation.html',
        'i-saakshi'                    => 'isaakshi-presentation.html',
        'parent-mobile-app'            => 'parent-mobile-app-presentation.html',
        'parent-web-app'               => 'parent-web-app-presentation.html',
        'teacher-mobile-app'           => 'teacher-mobile-app-presentation.html',
        'teacher-web-app'              => 'teacher-web-app-presentation.html',
        'career-development-skills'    => 'career-development-skills-presentation.html',
        'personal-development-skills'  => 'personal-development-skills-presentation.html',
        'cbsc-skills'                  => 'cbsc-skills-presentation.html',
        'rescom'                       => 'knr-presentation.html',
        'rescom-presentation'          => 'knr-presentation.html',
        'rescom-tech'                  => 'knr-presentation.html',
        'knr'                          => 'knr-presentation.html',
        'knr-presentation'             => 'knr-presentation.html',
        'knr-tech'                     => 'knr-presentation.html',
        'corporate'                    => 'knr-presentation.html',
        'corporate-presentation'       => 'knr-presentation.html',
    ];

    /**
     * Display the specified product presentation.
     */
    public function show(string $slug = 'rescom-presentation')
    {
        $dir = resource_path('views/presentations');
        
        // Normalize path/slug: strip leading folders or path traversal
        $raw = trim($slug);
        $raw = str_replace('\\', '/', $raw);
        $basename = basename($raw); // e.g. "edxcore-presentation.html" or "edxcore"
        
        // Check direct file with basename (e.g. edxcore-presentation.html)
        if (file_exists($dir . DIRECTORY_SEPARATOR . $basename) && is_file($dir . DIRECTORY_SEPARATOR . $basename)) {
            return $this->serveHtml($dir . DIRECTORY_SEPARATOR . $basename);
        }
        
        // Strip .html extension
        $noExt = preg_replace('/\.html$/i', '', $basename);
        $cleanSlug = Str::slug($noExt);

        // 1. Direct file match with .html
        $directFile = $dir . DIRECTORY_SEPARATOR . $noExt . '.html';
        if (file_exists($directFile) && is_file($directFile)) {
            return $this->serveHtml($directFile);
        }
        $directSlugFile = $dir . DIRECTORY_SEPARATOR . $cleanSlug . '.html';
        if (file_exists($directSlugFile) && is_file($directSlugFile)) {
            return $this->serveHtml($directSlugFile);
        }

        // 2. Direct map match
        if (isset($this->slugMap[$cleanSlug])) {
            $file = $dir . DIRECTORY_SEPARATOR . $this->slugMap[$cleanSlug];
            if (file_exists($file)) {
                return $this->serveHtml($file);
            }
        }
        if (isset($this->slugMap[$noExt])) {
            $file = $dir . DIRECTORY_SEPARATOR . $this->slugMap[$noExt];
            if (file_exists($file)) {
                return $this->serveHtml($file);
            }
        }

        // 3. Prefix/keyword matching against map
        foreach ($this->slugMap as $key => $fileName) {
            if (Str::startsWith($cleanSlug, $key) || Str::contains($cleanSlug, $key) || Str::contains($noExt, $key)) {
                $file = $dir . DIRECTORY_SEPARATOR . $fileName;
                if (file_exists($file)) {
                    return $this->serveHtml($file);
                }
            }
        }

        abort(404, "Presentation for '{$slug}' not found.");
    }

    /**
     * Serve raw HTML with proper headers.
     */
    protected function serveHtml(string $filePath)
    {
        return response(file_get_contents($filePath), 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Frame-Options' => 'SAMEORIGIN'
        ]);
    }
}
