<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEMO PRODUCTS ===\n";
foreach(App\Models\DemoProduct::all() as $dp) {
    echo "ID: {$dp->id} | Title: {$dp->title} | Img: {$dp->image}\n";
}

echo "\n=== HERO BANNERS ===\n";
foreach(App\Models\HeroBanner::all() as $hb) {
    echo "ID: {$hb->id} | Title: {$hb->title} | Img: {$hb->image}\n";
}

echo "\n=== GALLERY ITEMS ===\n";
foreach(App\Models\GalleryItem::all() as $gi) {
    echo "ID: {$gi->id} | Title: {$gi->title} | Img: {$gi->image}\n";
}
