<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

function printTableInfo($tableName, $modelClass) {
    echo "==================== TABLE: {$tableName} ====================\n";
    echo "Columns: " . implode(', ', Schema::getColumnListing($tableName)) . "\n";
    $items = $modelClass::all();
    echo "Count: " . $items->count() . "\n";
    foreach($items as $item) {
        $attrs = $item->toArray();
        echo "ID: {$item->id} | Title: " . ($attrs['title'] ?? $attrs['name'] ?? 'N/A') . "\n";
        foreach($attrs as $k => $v) {
            if (str_contains($k, 'img') || str_contains($k, 'image') || str_contains($k, 'photo') || str_contains($k, 'gallery') || str_contains($k, 'icon') || str_contains($k, 'thumbnail')) {
                echo "  $k: " . (is_array($v) ? json_encode($v) : $v) . "\n";
            }
        }
    }
    echo "\n";
}

printTableInfo('portfolios', App\Models\Portfolio::class);
printTableInfo('services', App\Models\Service::class);
printTableInfo('blog_posts', App\Models\BlogPost::class);
printTableInfo('demo_products', App\Models\DemoProduct::class);
printTableInfo('gallery_items', App\Models\GalleryItem::class);
