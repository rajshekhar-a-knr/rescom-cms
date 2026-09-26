<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$banners = App\Models\HeroBanner::all();
foreach($banners as $b) {
    echo "Banner {$b->id}: {$b->title}\nURL: {$b->image}\n";
    $headers = @get_headers($b->image);
    echo "Status: " . ($headers ? $headers[0] : 'Failed to connect') . "\n\n";
}
