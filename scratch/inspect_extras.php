<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CLIENTS ===\n";
foreach(App\Models\Client::all() as $c) {
    echo "Client: {$c->name} | Logo: {$c->logo}\n";
}

echo "\n=== TESTIMONIALS ===\n";
foreach(App\Models\Testimonial::all() as $t) {
    echo "Testimonial: {$t->client_name} | Photo: {$t->client_photo}\n";
}

echo "\n=== TEAM MEMBERS ===\n";
foreach(App\Models\TeamMember::all() as $tm) {
    echo "Team: {$tm->name} | Photo: {$tm->photo}\n";
}
