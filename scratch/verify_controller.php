<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;

$controller = new DashboardController();
$request = Request::create('/admin/website-visits', 'GET');
app()->instance('request', $request);

$response = $controller->websiteVisits();

$stream = $controller->websiteVisitsStream();
echo "Stream status: " . $stream->getStatusCode() . "\n";
echo "Stream json preview: " . substr($stream->getContent(), 0, 150) . "...\n";
