<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;

$internship = MenuItem::find(46);
echo "Initial Internship status: " . ($internship->is_active ? 'Active' : 'Inactive') . "\n";

// Toggle to inactive
$internship->update(['is_active' => 0]);
$htmlInactive = view('layouts.app')->render();
$hasInternshipInactive = str_contains($htmlInactive, 'href="http://localhost/internship"') || str_contains($htmlInactive, 'href="/internship"');
echo "When Inactive, is /internship in navigation? " . ($hasInternshipInactive ? 'YES (Error)' : 'NO (Correctly Hidden)') . "\n";

// Toggle back to active
$internship->update(['is_active' => 1]);
$htmlActive = view('layouts.app')->render();
$hasInternshipActive = str_contains($htmlActive, 'href="http://localhost/internship"') || str_contains($htmlActive, 'href="/internship"');
echo "When Active, is /internship in navigation? " . ($hasInternshipActive ? 'YES (Correctly Shown)' : 'NO (Error)') . "\n";
