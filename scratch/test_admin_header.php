<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

view()->share('errors', new \Illuminate\Support\ViewErrorBag);

$settings = App\Models\Setting::where('group', 'header')->get()->keyBy('key');
$headerMenu = App\Models\Menu::firstOrCreate(['location' => 'header'], ['name' => 'Main Navigation', 'is_active' => 1]);
$menuItems = App\Models\MenuItem::with(['children' => fn($q) => $q->orderBy('sort_order')->orderBy('id')])
    ->where('menu_id', $headerMenu->id)
    ->whereNull('parent_id')
    ->orderBy('sort_order')
    ->orderBy('id')
    ->get();
$parentMenuItems = App\Models\MenuItem::where('menu_id', $headerMenu->id)
    ->whereNull('parent_id')
    ->orderBy('sort_order')
    ->get();

$viewHtml = view('admin.pages.settings.header', compact('settings', 'headerMenu', 'menuItems', 'parentMenuItems'))->render();
echo "Admin Header Settings view rendered successfully! Length: " . strlen($viewHtml) . "\n";
echo "Contains 'SUBMENU'? " . (str_contains($viewHtml, 'SUBMENU') ? 'YES' : 'NO') . "\n";
echo "Contains 'Internship'? " . (str_contains($viewHtml, 'Internship') ? 'YES' : 'NO') . "\n";
echo "Contains 'Events'? " . (str_contains($viewHtml, 'Events') ? 'YES' : 'NO') . "\n";
echo "Contains 'Gallery'? " . (str_contains($viewHtml, 'Gallery') ? 'YES' : 'NO') . "\n";
echo "Contains 'Blogs'? " . (str_contains($viewHtml, 'Blogs') ? 'YES' : 'NO') . "\n";
echo "Contains 'Testimonials'? " . (str_contains($viewHtml, 'Testimonials') ? 'YES' : 'NO') . "\n";
echo "Contains 'FAQs'? " . (str_contains($viewHtml, 'FAQs') ? 'YES' : 'NO') . "\n";
