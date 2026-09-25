<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = DB::select('SHOW TABLES');
$dbName = DB::getDatabaseName();
$key = 'Tables_in_' . $dbName;

echo "Scanning database: $dbName\n";

foreach ($tables as $tableObj) {
    $tableName = $tableObj->$key ?? array_values((array)$tableObj)[0];
    $cols = Schema::getColumnListing($tableName);
    foreach ($cols as $col) {
        try {
            $rows = DB::table($tableName)->where($col, 'LIKE', '%knr%')->get();
            if ($rows->count() > 0) {
                echo "\nTable: $tableName, Column: $col ({$rows->count()} matches)\n";
                foreach ($rows as $row) {
                    $id = $row->id ?? $row->key ?? 'N/A';
                    $val = (string)$row->$col;
                    $short = strlen($val) > 100 ? substr($val, 0, 100) . '...' : $val;
                    echo "  ID/Key {$id}: $short\n";
                }
            }
        } catch (\Exception $e) {}
    }
}
