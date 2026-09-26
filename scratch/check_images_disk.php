<?php

$paths = [
    'public/blog/home-buying-checklist.jpg',
    'public/blog/arch-trends-2025.jpg',
    'public/blog/waterproofing-guide.jpg',
    'public/blog/blr-investment-2025.jpg',
    'public/blog/rera-karnataka-guide.jpg',
    'public/storage/blog/home-buying-checklist.jpg',
    'public/images/blog/home-buying-checklist.jpg',
    'public/portfolio/serene-heights-1.jpg',
    'public/storage/portfolio/serene-heights-1.jpg',
];

foreach ($paths as $p) {
    $full = __DIR__ . '/../' . $p;
    echo "Checking $p: " . (file_exists($full) ? "EXISTS (" . filesize($full) . " bytes)" : "NOT FOUND") . "\n";
}
