<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'dashboard' => ['view'],
            'banners' => ['view','create','edit','delete'],
            'services' => ['view','create','edit','delete'],
            'portfolio' => ['view','create','edit','delete'],
            'demo-products' => ['view','create','edit','delete'],
            'blog' => ['view','create','edit','delete'],
            'team' => ['view','create','edit','delete'],
            'testimonials' => ['view','create','edit','delete'],
            'clients' => ['view','create','edit','delete'],
            'stats' => ['view','create','edit','delete'],
            'faqs' => ['view','create','edit','delete'],
            'gallery' => ['view','create','edit','delete'],
            'events' => ['view','create','edit','delete'],
            'technologies' => ['view','create','edit','delete'],
            'pages' => ['view','create','edit','delete'],
            'legal-pages' => ['view','create','edit','delete'],
            'about' => ['view','edit'],
            'jobs' => ['view','create','edit','delete'],
            'job-applications' => ['view','edit'],
            'contacts' => ['view','edit','delete'],
            'media' => ['view','create','delete'],
            'settings' => ['manage'],
            'users' => ['view','create','edit','delete'],
            'permissions' => ['view','edit'],
            'newsletter' => ['view','edit'],
            'activity' => ['view'],
            'chatbot' => ['view','create','edit','delete'],
            'chatbot.queries' => ['view','edit'],
            'profile' => ['manage'],
        ];

        foreach ($modules as $module => $caps) {
            foreach ($caps as $cap) {
                $name = $module . '.' . $cap;
                Permission::updateOrCreate(
                    ['name' => $name],
                    ['label' => ucfirst($cap) . ' ' . str_replace(['-', '.'], ' ', $module), 'group' => $module]
                );
            }
        }
    }
}
