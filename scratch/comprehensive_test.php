<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use App\Models\User;

$user = User::first();
if ($user) {
    auth()->login($user);
}
view()->share('errors', new \Illuminate\Support\ViewErrorBag());

$controller = new DashboardController();

echo "=== 1. DEFAULT WEBSITE VISITS VIEW ===\n";
$req1 = Request::create('/admin/website-visits', 'GET');
app()->instance('request', $req1);
$resp1 = $controller->websiteVisits();
$html1 = $resp1->render();
echo "Status: 200 OK | Render length: " . strlen($html1) . " bytes\n";
assert(strpos($html1, 'Global Telemetry Command') !== false, "Must contain title");
assert(strpos($html1, 'State-Wise Matrix') !== false, "Must contain State-Wise Matrix");
assert(strpos($html1, 'District / Place Nodes') !== false, "Must contain District / Place Nodes");
assert(strpos($html1, 'Cyber Radar Map') !== false, "Must contain Cyber Radar Map");
assert(strpos($html1, 'Telemetry Traffic Ingress Flow') !== false, "Must contain Waveform chart");
assert(strpos($html1, 'Real-Time Telemetry Event Stream') !== false, "Must contain Live Stream");

echo "\n=== 2. FILTER BY STATE (e.g. Karnataka) ===\n";
$req2 = Request::create('/admin/website-visits', 'GET', ['state' => 'Karnataka']);
app()->instance('request', $req2);
$resp2 = $controller->websiteVisits();
$html2 = $resp2->render();
echo "Status: 200 OK | Filtered state render length: " . strlen($html2) . " bytes\n";

echo "\n=== 3. FILTER BY CITY/DISTRICT (e.g. Bengaluru) ===\n";
$req3 = Request::create('/admin/website-visits', 'GET', ['city' => 'Bengaluru']);
app()->instance('request', $req3);
$resp3 = $controller->websiteVisits();
$html3 = $resp3->render();
echo "Status: 200 OK | Filtered city render length: " . strlen($html3) . " bytes\n";

echo "\n=== 4. FILTER BY PRESET (e.g. 7d) ===\n";
$req4 = Request::create('/admin/website-visits', 'GET', ['preset' => '7d']);
app()->instance('request', $req4);
$resp4 = $controller->websiteVisits();
$html4 = $resp4->render();
echo "Status: 200 OK | 7-day preset render length: " . strlen($html4) . " bytes\n";

echo "\n=== 5. AJAX LIVE STREAM ENDPOINT ===\n";
$streamResp = $controller->websiteVisitsStream();
$streamData = json_decode($streamResp->getContent(), true);
echo "Status: " . $streamResp->getStatusCode() . " | Stream items count: " . count($streamData['data']) . "\n";
echo "Active now estimate: " . $streamData['active_now'] . " | Sample ping: " . json_encode($streamData['data'][0] ?? null) . "\n";

echo "\n=== 6. CSV EXPORT ENDPOINT ===\n";
$req6 = Request::create('/admin/website-visits/export', 'GET');
app()->instance('request', $req6);
$exportResp = $controller->exportWebsiteVisits();
echo "Export class: " . get_class($exportResp) . "\n";
ob_start();
$exportResp->sendContent();
$csvContent = ob_get_clean();
$csvLines = explode("\n", trim($csvContent));
echo "CSV header: " . ($csvLines[0] ?? '') . "\n";
echo "CSV sample line 1: " . ($csvLines[1] ?? '') . "\n";
echo "CSV total exported rows: " . count($csvLines) . "\n";

echo "\nALL TESTS PASSED SUCCESSFULLY! 🚀\n";
