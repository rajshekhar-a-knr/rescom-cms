<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "Checking menu_items schema...\n";

Schema::table('menu_items', function (Blueprint $table) {
    if (!Schema::hasColumn('menu_items', 'item_type')) {
        $table->string('item_type')->nullable()->default('link')->after('icon');
        echo "Added column 'item_type'\n";
    }
    if (!Schema::hasColumn('menu_items', 'section')) {
        $table->string('section')->nullable()->default('main')->after('item_type');
        echo "Added column 'section'\n";
    }
    if (!Schema::hasColumn('menu_items', 'badge_text')) {
        $table->string('badge_text')->nullable()->after('section');
        echo "Added column 'badge_text'\n";
    }
});

// Ensure menus table has Header and Footer
$headerMenu = DB::table('menus')->where('location', 'header')->first();
if (!$headerMenu) {
    $headerId = DB::table('menus')->insertGetId([
        'name' => 'Main Navigation',
        'location' => 'header',
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Created header menu ID: $headerId\n";
} else {
    $headerId = $headerMenu->id;
}

$footerMenu = DB::table('menus')->where('location', 'footer')->first();
if (!$footerMenu) {
    $footerId = DB::table('menus')->insertGetId([
        'name' => 'Footer Links',
        'location' => 'footer',
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Created footer menu ID: $footerId\n";
} else {
    $footerId = $footerMenu->id;
}

// Seed/Update default Header items if none or legacy
$headerCount = DB::table('menu_items')->where('menu_id', $headerId)->count();
echo "Current header items count: $headerCount\n";

// Let's make sure the standard header tabs exist with proper item_type
$defaultHeaderTabs = [
    ['title' => 'About', 'url' => '/about', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 1, 'is_active' => 1],
    ['title' => 'Products', 'url' => '/portfolio', 'item_type' => 'dropdown_products', 'target' => '_self', 'badge_text' => null, 'sort_order' => 2, 'is_active' => 1],
    ['title' => 'Services', 'url' => '/services', 'item_type' => 'dropdown_services', 'target' => '_self', 'badge_text' => null, 'sort_order' => 3, 'is_active' => 1],
    ['title' => 'Resources', 'url' => '#', 'item_type' => 'dropdown_resources', 'target' => '_self', 'badge_text' => null, 'sort_order' => 4, 'is_active' => 1],
    ['title' => 'Careers', 'url' => '/careers', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 5, 'is_active' => 1],
    ['title' => 'Contact', 'url' => '/contact', 'item_type' => 'link', 'target' => '_self', 'badge_text' => null, 'sort_order' => 6, 'is_active' => 1],
    ['title' => 'Presentation', 'url' => '/presentations/rescom-presentation', 'item_type' => 'presentation', 'target' => '_blank', 'badge_text' => 'Live', 'sort_order' => 7, 'is_active' => 1],
];

// If header has old sample items, let's refresh to standard default items
DB::table('menu_items')->where('menu_id', $headerId)->delete();
foreach ($defaultHeaderTabs as $item) {
    DB::table('menu_items')->insert(array_merge($item, [
        'menu_id' => $headerId,
        'parent_id' => null,
        'section' => 'main',
        'icon' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]));
}
echo "Populated default Header items.\n";

// Seed default Footer items organized by section
DB::table('menu_items')->where('menu_id', $footerMenu->id)->delete();

$defaultFooterItems = [
    // Services Section
    ['title' => 'Web Development', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 1, 'is_active' => 1],
    ['title' => 'Mobile App Development', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 2, 'is_active' => 1],
    ['title' => 'Cloud Solutions', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 3, 'is_active' => 1],
    ['title' => 'Cybersecurity', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 4, 'is_active' => 1],
    ['title' => 'AI & Machine Learning', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 5, 'is_active' => 1],
    ['title' => 'Digital Transformation', 'url' => '/services', 'item_type' => 'link', 'section' => 'services', 'sort_order' => 6, 'is_active' => 1],

    // Company Section
    ['title' => 'Corporate Presentation', 'url' => '/presentations/rescom-presentation', 'item_type' => 'presentation', 'section' => 'company', 'target' => '_blank', 'badge_text' => 'Live', 'sort_order' => 1, 'is_active' => 1],
    ['title' => 'About Us', 'url' => '/about', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 2, 'is_active' => 1],
    ['title' => 'Our Products', 'url' => '/portfolio', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 3, 'is_active' => 1],
    ['title' => 'Blog & Insights', 'url' => '/blog', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 4, 'is_active' => 1],
    ['title' => 'Gallery', 'url' => '/gallery', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 5, 'is_active' => 1],
    ['title' => 'Events', 'url' => '/events', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 6, 'is_active' => 1],
    ['title' => 'Careers', 'url' => '/careers', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 7, 'is_active' => 1],
    ['title' => 'Contact Us', 'url' => '/contact', 'item_type' => 'link', 'section' => 'company', 'sort_order' => 8, 'is_active' => 1],

    // Policies Section
    ['title' => 'Privacy Policy', 'url' => '/privacy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 1, 'is_active' => 1],
    ['title' => 'Website Terms and Conditions', 'url' => '/terms', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 2, 'is_active' => 1],
    ['title' => 'Anti-SPAM Policy', 'url' => '/legal/anti-spam-policy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 3, 'is_active' => 1],
    ['title' => 'License Agreement', 'url' => '/legal/license-agreement', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 4, 'is_active' => 1],
    ['title' => 'Cookies Policy', 'url' => '/legal/cookies-policy', 'item_type' => 'link', 'section' => 'policies', 'sort_order' => 5, 'is_active' => 1],
];

foreach ($defaultFooterItems as $item) {
    DB::table('menu_items')->insert(array_merge([
        'menu_id' => $footerMenu->id,
        'parent_id' => null,
        'target' => '_self',
        'badge_text' => null,
        'icon' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ], $item));
}
echo "Populated default Footer items.\n";
echo "Done!\n";
