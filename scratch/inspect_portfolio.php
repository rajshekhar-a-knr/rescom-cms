<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/portfolio/webcore-cms-content-management-system', 'GET')
);
echo "Status: " . $response->getStatusCode() . "\n";

$p = \App\Models\Portfolio::where('slug', 'leap-learners-educators-administrator-parents')->first();
echo "Title: " . $p->title . "\n";
echo "Description raw:\n" . $p->description . "\n";
echo "Challenge raw:\n" . $p->challenge . "\n";
echo "Solution raw:\n" . $p->solution . "\n";
echo "Results raw:\n" . $p->results . "\n";

