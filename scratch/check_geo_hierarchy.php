<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\PageVisit;

$countries = PageVisit::whereNotNull('country')->where('country', '!=', '')->distinct()->orderBy('country')->pluck('country');
echo "Countries (" . $countries->count() . "):\n" . json_encode($countries->take(10)) . "\n\n";

$indiaStates = PageVisit::where('country', 'India')->whereNotNull('state')->where('state', '!=', '')->distinct()->orderBy('state')->pluck('state');
echo "India States (" . $indiaStates->count() . "):\n" . json_encode($indiaStates) . "\n\n";

$karPlaces = PageVisit::where('state', 'Karnataka')
    ->selectRaw("coalesce(nullif(district,''), city) as place")
    ->whereNotNull('city')
    ->where('city', '!=', '')
    ->distinct()
    ->orderBy('place')
    ->pluck('place');
echo "Karnataka Places (" . $karPlaces->count() . "):\n" . json_encode($karPlaces) . "\n\n";

// Let's also check full country -> state -> city mapping structure
$geoHierarchy = [];
$rows = PageVisit::select('country', 'state', 'city', 'district')
    ->whereNotNull('country')
    ->where('country', '!=', '')
    ->whereNotNull('state')
    ->where('state', '!=', '')
    ->groupBy('country', 'state', 'city', 'district')
    ->get();

foreach ($rows as $r) {
    $c = $r->country;
    $s = $r->state;
    $p = $r->district ?: $r->city;
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

echo "Total Countries in hierarchy: " . count($geoHierarchy) . "\n";
echo "India states count: " . (isset($geoHierarchy['India']) ? count($geoHierarchy['India']) : 0) . "\n";
if (isset($geoHierarchy['India']['Karnataka'])) {
    echo "Karnataka places: " . json_encode($geoHierarchy['India']['Karnataka']) . "\n";
}
