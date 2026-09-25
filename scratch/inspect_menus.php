<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "MENUS columns:\n";
print_r(Schema::getColumnListing('menus'));

echo "\nMENUS data:\n";
print_r(DB::table('menus')->get()->toArray());

echo "\nMENU_ITEMS columns:\n";
print_r(Schema::getColumnListing('menu_items'));

echo "\nMENU_ITEMS data:\n";
print_r(DB::table('menu_items')->get()->toArray());
