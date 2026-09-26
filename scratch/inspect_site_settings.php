<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "site_name: " . setting('site_name') . "\n";
echo "site_logo: " . setting('site_logo') . "\n";
echo "site_tagline: " . setting('site_tagline') . "\n";
