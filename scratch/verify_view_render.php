<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use App\Models\User;

// Login as first admin user to pass auth in view/layout
$user = User::first();
if ($user) {
    auth()->login($user);
}

view()->share('errors', new \Illuminate\Support\ViewErrorBag());
$controller = new DashboardController();
$request = Request::create('/admin/website-visits', 'GET');
app()->instance('request', $request);

$response = $controller->websiteVisits();
$html = $response->render();

echo "Render Success! HTML length: " . strlen($html) . " bytes\n";
echo "Contains 'Global Telemetry Command': " . (strpos($html, 'Global Telemetry Command') !== false ? 'YES' : 'NO') . "\n";
echo "Contains 'State-Wise Matrix': " . (strpos($html, 'State-Wise Matrix') !== false ? 'YES' : 'NO') . "\n";
echo "Contains 'telemetryMap': " . (strpos($html, 'telemetryMap') !== false ? 'YES' : 'NO') . "\n";
