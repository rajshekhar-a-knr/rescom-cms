<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\RolePermission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $all = Permission::pluck('id', 'name');

        // Super Admin: all permissions
        foreach ($all as $id) {
            RolePermission::updateOrCreate(['role' => 'superadmin', 'permission_id' => $id]);
        }

        // Admin: most permissions except user management and settings manage
        $adminAllowed = $all->except([
            'users.create','users.edit','users.delete',
            'settings.manage',
        ]);
        foreach ($adminAllowed as $id) {
            RolePermission::updateOrCreate(['role' => 'admin', 'permission_id' => $id]);
        }

        // Editor: view + edit content modules only
        $editorAllowedNames = [
            'dashboard.view',
            'blog.view','blog.create','blog.edit',
            'demo-products.view','demo-products.create','demo-products.edit',
            'pages.view','pages.create','pages.edit',
            'gallery.view','gallery.create','gallery.edit',
            'events.view','events.create','events.edit',
            'faqs.view','faqs.create','faqs.edit',
            'chatbot.view','chatbot.create','chatbot.edit',
            'chatbot.queries.view','chatbot.queries.edit',
            'media.view','media.create',
            'profile.manage',
        ];
        foreach ($editorAllowedNames as $name) {
            if (!$all->has($name)) continue;
            RolePermission::updateOrCreate(['role' => 'editor', 'permission_id' => $all[$name]]);
        }
    }
}
