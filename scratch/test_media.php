<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "DO_SPACES_PATH: " . var_export(env('DO_SPACES_PATH'), true) . "\n";
echo "Storage::url('test.jpg'): " . \Illuminate\Support\Facades\Storage::url('test.jpg') . "\n";
echo "media_url('portfolio/test.jpg'): " . media_url('portfolio/test.jpg') . "\n";
echo "media_url('https://images.unsplash.com/photo-xxx'): " . media_url('https://images.unsplash.com/photo-xxx') . "\n";
