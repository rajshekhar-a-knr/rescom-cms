<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== MENUS ===\n";
foreach(App\Models\Menu::all() as $m) {
    echo "Menu ID: {$m->id}, Name: {$m->name}, Location: {$m->location}\n";
}

echo "\n=== MENU ITEMS ===\n";
foreach(App\Models\MenuItem::with('children')->whereNull('parent_id')->orderBy('section')->orderBy('sort_order')->get() as $item) {
    echo "ID: {$item->id} | Section: {$item->section} | Title: {$item->title} | URL: {$item->url} | Active: {$item->is_active} | Order: {$item->sort_order}\n";
    foreach($item->children as $child) {
        echo "   -> Child ID: {$child->id} | Title: {$child->title} | URL: {$child->url} | Active: {$child->is_active} | Order: {$child->sort_order}\n";
    }
}

echo "\n=== ALL RAW MENU ITEMS ===\n";
foreach(App\Models\MenuItem::all() as $mi) {
    echo "ID: {$mi->id} | Parent: " . ($mi->parent_id ?? 'NULL') . " | Sec: {$mi->section} | Title: {$mi->title} | URL: {$mi->url} | Active: {$mi->is_active}\n";
}
