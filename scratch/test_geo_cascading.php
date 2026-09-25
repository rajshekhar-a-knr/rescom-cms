<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\PageVisit;

// 1. Build hierarchy from DB
$rawLocations = PageVisit::select('country', 'state', 'city', 'district')
    ->whereNotNull('country')
    ->where('country', '!=', '')
    ->whereNotNull('state')
    ->where('state', '!=', '')
    ->groupBy('country', 'state', 'city', 'district')
    ->get();

$geoHierarchy = [];
foreach ($rawLocations as $loc) {
    $c = trim($loc->country);
    $s = trim($loc->state);
    $p = trim($loc->district ?: $loc->city);

    if (!$c || !$s) continue;

    if (!isset($geoHierarchy[$c])) {
        $geoHierarchy[$c] = [];
    }
    if (!isset($geoHierarchy[$c][$s])) {
        $geoHierarchy[$c][$s] = [];
    }
    if ($p && !in_array($p, $geoHierarchy[$c][$s])) {
        $geoHierarchy[$c][$s][] = $p;
    }
}

// Enhance Karnataka with full district list
$karnatakaDistricts = [
    'Bengaluru', 'Bengaluru Rural', 'Mysuru', 'Hubballi', 'Dharwad', 'Mangaluru', 
    'Belagavi', 'Shivamogga', 'Tumakuru', 'Davanagere', 'Ballari', 'Vijayapura', 
    'Kalaburagi', 'Udupi', 'Mandya', 'Hassan', 'Chikkamagaluru', 'Kodagu', 
    'Kolar', 'Chikkaballapura', 'Chitradurga', 'Bagalkote', 'Gadag', 'Haveri', 
    'Koppal', 'Raichur', 'Bidar', 'Yadgir', 'Chamarajanagar', 'Ramanagara', 
    'Uttara Kannada', 'Vijayanagara', 'Gubbi', 'Sāgar'
];

if (!isset($geoHierarchy['India'])) {
    $geoHierarchy['India'] = [];
}
if (!isset($geoHierarchy['India']['Karnataka'])) {
    $geoHierarchy['India']['Karnataka'] = [];
}
$geoHierarchy['India']['Karnataka'] = array_values(array_unique(array_merge($geoHierarchy['India']['Karnataka'], $karnatakaDistricts)));
sort($geoHierarchy['India']['Karnataka']);

// Also sort all state lists & places
foreach ($geoHierarchy as $country => &$states) {
    ksort($states);
    foreach ($states as $state => &$places) {
        sort($places);
    }
}

echo "Hierarchy built successfully!\n";
echo "India States: " . implode(', ', array_keys($geoHierarchy['India'])) . "\n\n";
echo "Karnataka Districts (" . count($geoHierarchy['India']['Karnataka']) . "): " . implode(', ', $geoHierarchy['India']['Karnataka']) . "\n";
