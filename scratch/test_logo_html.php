<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$ch = curl_init('http://127.0.0.1:8000/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

echo "HTTP Request OK, HTML length: " . strlen($html) . "\n";
if (str_contains($html, 'class="logo-stack"')) {
    echo "Found logo-stack\n";
}
if (str_contains($html, 'class="logo-image"')) {
    echo "Found logo-image\n";
}
if (str_contains($html, 'class="logo-tagline"')) {
    echo "Found logo-tagline\n";
}
preg_match('/<div class="logo-stack">(.*?)<\/div>/s', $html, $m);
if (!empty($m[0])) {
    echo "Rendered Logo Stack:\n" . trim($m[0]) . "\n";
}
