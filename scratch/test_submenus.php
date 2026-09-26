<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;

echo "=== CHECKING MENU ITEMS & CHILDREN IN DATABASE ===\n";
$headerItems = MenuItem::with('children')->where('menu_id', 1)->whereNull('parent_id')->orderBy('sort_order')->get();

foreach($headerItems as $item) {
    echo "Tab: {$item->title} (ID: {$item->id}, Active: {$item->is_active}, Order: {$item->sort_order})\n";
    foreach($item->children as $child) {
        echo "   ↳ Submenu: {$child->title} (ID: {$child->id}, URL: {$child->url}, Active: {$child->is_active}, Order: {$child->sort_order})\n";
    }
}

echo "\n=== TESTING FRONTEND DROPDOWN HTML OUTPUT ===\n";
$html = view('layouts.app')->render();
echo "Rendered app.blade.php without errors! Length: " . strlen($html) . "\n";

// Check if Internship, Events, Gallery, Blogs, Testimonials, FAQs appear under Resources
foreach(['Internship', 'Events', 'Gallery', 'Blogs', 'Testimonials', 'FAQs'] as $sub) {
    if (str_contains($html, $sub)) {
        echo " [OK] '$sub' is rendered in navigation\n";
    } else {
        echo " [FAIL] '$sub' is MISSING in navigation\n";
    }
}
