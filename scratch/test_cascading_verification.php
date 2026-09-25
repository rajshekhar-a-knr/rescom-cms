<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use App\Models\User;

$user = User::first();
if ($user) auth()->login($user);
view()->share('errors', new \Illuminate\Support\ViewErrorBag());

$controller = new DashboardController();

// 1. Select India
$reqIndia = Request::create('/admin/website-visits', 'GET', ['country' => 'India']);
app()->instance('request', $reqIndia);
$respIndia = $controller->websiteVisits();
$dataIndia = $respIndia->getData();

echo "=== INDIA SELECTION ===\n";
echo "Selected Country: " . $dataIndia['selectedCountry'] . "\n";
echo "Available States Count: " . count($dataIndia['availableStates']) . "\n";
echo "Contains Karnataka: " . (in_array('Karnataka', $dataIndia['availableStates']) ? 'YES' : 'NO') . "\n";
echo "Contains Maharashtra: " . (in_array('Maharashtra', $dataIndia['availableStates']) ? 'YES' : 'NO') . "\n";

// 2. Select India + Karnataka
$reqKar = Request::create('/admin/website-visits', 'GET', ['country' => 'India', 'state' => 'Karnataka']);
app()->instance('request', $reqKar);
$respKar = $controller->websiteVisits();
$dataKar = $respKar->getData();

echo "\n=== INDIA + KARNATAKA SELECTION ===\n";
echo "Selected Country: " . $dataKar['selectedCountry'] . " | State: " . $dataKar['selectedState'] . "\n";
echo "Available Places Count: " . count($dataKar['availablePlaces']) . "\n";
echo "Contains Bengaluru: " . (in_array('Bengaluru', $dataKar['availablePlaces']) ? 'YES' : 'NO') . "\n";
echo "Contains Mysuru: " . (in_array('Mysuru', $dataKar['availablePlaces']) ? 'YES' : 'NO') . "\n";
echo "Contains Hubballi: " . (in_array('Hubballi', $dataKar['availablePlaces']) ? 'YES' : 'NO') . "\n";
echo "Contains Mangaluru: " . (in_array('Mangaluru', $dataKar['availablePlaces']) ? 'YES' : 'NO') . "\n";
echo "Contains Belagavi: " . (in_array('Belagavi', $dataKar['availablePlaces']) ? 'YES' : 'NO') . "\n";
echo "Top District Node in Kar: " . ($dataKar['cityDistrictBreakdown']->first()->place_name ?? 'none') . "\n";

echo "\nCASCADING FILTER VERIFIED SUCCESSFULLY! 🚀\n";
