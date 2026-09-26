<?php

require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\BlogPost;

echo "=== 1. Products (Portfolios) ===\n";
$portfolios = Portfolio::all();
foreach ($portfolios as $p) {
    echo "  [ID: {$p->id}] {$p->title} (Slug: {$p->slug}) | Image: {$p->image} | Gallery: " . json_encode($p->gallery) . "\n";
}

echo "\n=== 2. Services ===\n";
$services = Service::all();
foreach ($services as $s) {
    echo "  [ID: {$s->id}] {$s->title} (Slug: {$s->slug}) | Image: {$s->image} | Icon: {$s->icon}\n";
}

echo "\n=== 3. Blog Posts ===\n";
$blogs = BlogPost::all();
foreach ($blogs as $b) {
    echo "  [ID: {$b->id}] {$b->title} (Slug: {$b->slug}) | Featured Image: {$b->featured_image}\n";
}
