<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\PageVisit;
use Illuminate\Support\Carbon;

$start = microtime(true);

// 1. Overview counts
$totalVisits = PageVisit::count();
$uniqueVisitors = PageVisit::distinct('ip')->count('ip');
$todayVisits = PageVisit::whereDate('visited_at', Carbon::today())->count();
$yesterdayVisits = PageVisit::whereDate('visited_at', Carbon::yesterday())->count();
$growth = $yesterdayVisits > 0 ? round((($todayVisits - $yesterdayVisits) / $yesterdayVisits) * 100, 1) : null;

// 2. State Breakdown
$stateBreakdown = PageVisit::selectRaw("state, country, count(*) as total, count(distinct ip) as unique_ips")
    ->whereNotNull('state')
    ->where('state', '!=', '')
    ->groupBy('state', 'country')
    ->orderByDesc('total')
    ->limit(20)
    ->get();

// 3. District / City Breakdown
$cityDistrictBreakdown = PageVisit::selectRaw("
    coalesce(nullif(district,''), city, 'Unknown') as place_name,
    city,
    state,
    country,
    avg(latitude) as lat,
    avg(longitude) as lon,
    count(*) as total,
    count(distinct ip) as unique_ips
")
    ->where(function($q) {
        $q->whereNotNull('city')->where('city', '!=', '')
          ->orWhereNotNull('district')->where('district', '!=', '');
    })
    ->groupBy('place_name', 'city', 'state', 'country')
    ->orderByDesc('total')
    ->limit(25)
    ->get();

// 4. Country Breakdown
$countryBreakdown = PageVisit::selectRaw("country, count(*) as total, count(distinct ip) as unique_ips")
    ->whereNotNull('country')
    ->where('country', '!=', '')
    ->groupBy('country')
    ->orderByDesc('total')
    ->limit(15)
    ->get();

// 5. Geo Coordinates for Map
$geoPoints = PageVisit::selectRaw("
    city,
    state,
    country,
    latitude as lat,
    longitude as lng,
    count(*) as total
")
    ->whereNotNull('latitude')
    ->whereNotNull('longitude')
    ->groupBy('city', 'state', 'country', 'latitude', 'longitude')
    ->orderByDesc('total')
    ->limit(100)
    ->get();

$elapsed = round((microtime(true) - $start) * 1000, 2);

echo "Benchmark completed in {$elapsed} ms\n";
echo "Total visits: {$totalVisits} | Unique: {$uniqueVisitors}\n";
echo "Top States count: " . $stateBreakdown->count() . " | Top 1: " . json_encode($stateBreakdown->first()) . "\n";
echo "Top Places count: " . $cityDistrictBreakdown->count() . " | Top 1: " . json_encode($cityDistrictBreakdown->first()) . "\n";
echo "Top Countries count: " . $countryBreakdown->count() . " | Top 1: " . json_encode($countryBreakdown->first()) . "\n";
echo "Geo map points: " . $geoPoints->count() . " | Top 1: " . json_encode($geoPoints->first()) . "\n";
