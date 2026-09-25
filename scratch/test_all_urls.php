<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$legalPages = \App\Models\LegalPage::all();
foreach ($legalPages as $lp) {
    echo "ID: {$lp->id} | Title: {$lp->title} | Slug: {$lp->slug} | Active: {$lp->is_active} | Sort: {$lp->sort_order}\n";
}

