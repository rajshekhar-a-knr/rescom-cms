<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select('SHOW TABLES');
echo "Database tables (" . count($tables) . "):\n";
foreach ($tables as $t) {
    echo " - " . array_values((array)$t)[0] . "\n";
}
