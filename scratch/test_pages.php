<?php
$pages = [
    '/',
    '/portfolio',
    '/portfolio/serene-heights-whitefield',
    '/services',
    '/services/residential-property-sales-leasing',
    '/blog',
    '/blog/ultimate-checklist-first-time-home-buyers-bengaluru',
    '/gallery'
];

foreach($pages as $path) {
    $ch = curl_init('http://127.0.0.1:8000' . $path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "$path => HTTP $code (length: " . strlen($html) . ")\n";
    
    // Check if unsplash images appear in HTML
    preg_match_all('/src="([^"]*unsplash[^"]*)"/i', $html, $matches);
    echo "  Found " . count($matches[1]) . " unsplash image(s) rendered\n";
}
