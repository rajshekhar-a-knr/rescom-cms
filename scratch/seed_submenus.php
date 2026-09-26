<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;

$resourcesParent = MenuItem::where('menu_id', 1)
    ->where(function($q) {
        $q->where('title', 'Resources')
          ->orWhere('item_type', 'dropdown_resources');
    })
    ->first();

if (!$resourcesParent) {
    echo "Resources parent not found. Creating Resources parent tab...\n";
    $resourcesParent = MenuItem::create([
        'menu_id' => 1,
        'title' => 'Resources',
        'url' => '#',
        'item_type' => 'dropdown_resources',
        'target' => '_self',
        'sort_order' => 4,
        'is_active' => 1,
        'section' => 'main'
    ]);
}

echo "Found/Created Resources Parent (ID: {$resourcesParent->id})\n";

// Sub items to insert if not existing
$subItems = [
    ['title' => 'Internship', 'url' => '/internship', 'icon' => 'fas fa-graduation-cap', 'sort_order' => 1, 'is_active' => 1],
    ['title' => 'Events', 'url' => '/events', 'icon' => 'fas fa-calendar-alt', 'sort_order' => 2, 'is_active' => 1],
    ['title' => 'Gallery', 'url' => '/gallery', 'icon' => 'fas fa-images', 'sort_order' => 3, 'is_active' => 1],
    ['title' => 'Blogs', 'url' => '/blog', 'icon' => 'fas fa-newspaper', 'sort_order' => 4, 'is_active' => 1],
    ['title' => 'Testimonials', 'url' => '/testimonials', 'icon' => 'fas fa-comment-dots', 'sort_order' => 5, 'is_active' => 1],
    ['title' => 'FAQs', 'url' => '/faqs', 'icon' => 'fas fa-question-circle', 'sort_order' => 6, 'is_active' => 1],
];

foreach ($subItems as $sub) {
    $existing = MenuItem::where('menu_id', 1)
        ->where('parent_id', $resourcesParent->id)
        ->where('title', $sub['title'])
        ->first();
    
    if ($existing) {
        $existing->update($sub);
        echo "Updated Submenu: {$sub['title']} (ID: {$existing->id})\n";
    } else {
        $new = MenuItem::create(array_merge($sub, [
            'menu_id' => 1,
            'parent_id' => $resourcesParent->id,
            'target' => '_self',
            'item_type' => 'link',
            'section' => 'main'
        ]));
        echo "Created Submenu: {$sub['title']} (ID: {$new->id})\n";
    }
}
