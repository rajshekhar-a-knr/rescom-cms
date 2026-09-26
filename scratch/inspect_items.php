<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== PORTFOLIOS (PRODUCTS) ===\n";
foreach(App\Models\Portfolio::all() as $p) {
    echo "ID: {$p->id} | Slug: {$p->slug}\nTitle: {$p->title}\nImage: {$p->image}\nGallery: " . json_encode($p->gallery) . "\n\n";
}

echo "=== SERVICES ===\n";
foreach(App\Models\Service::all() as $s) {
    echo "ID: {$s->id} | Slug: {$s->slug}\nTitle: {$s->title}\nImage: {$s->image}\n\n";
}

echo "=== BLOG POSTS ===\n";
foreach(App\Models\BlogPost::all() as $b) {
    echo "ID: {$b->id} | Slug: {$b->slug}\nTitle: {$b->title}\nImage: {$b->featured_image}\n\n";
}
