<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()?->getName();
        if (!$routeName || !str_starts_with($routeName, 'admin.')) {
            return $next($request);
        }

        // If permissions tables are empty (not seeded yet), do not block access.
        if (\App\Models\Permission::count() === 0) {
            return $next($request);
        }

        $permission = $this->resolvePermission($routeName);
        if (!$permission) {
            return $next($request);
        }

        $user = $request->user();
        // If role has no permissions assigned yet, allow access (until configured).
        if ($user && \App\Models\RolePermission::where('role', $user->role)->count() === 0) {
            return $next($request);
        }
        if ($user && $user->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'You do not have permission to access this module.');
    }

    private function resolvePermission(string $routeName): ?string
    {
        $name = Str::after($routeName, 'admin.');

        if ($name === 'dashboard') return 'dashboard.view';
        if (str_starts_with($name, 'settings')) return 'settings.manage';
        if (str_starts_with($name, 'activity-logs')) return 'activity.view';
        if (str_starts_with($name, 'website-visits')) return 'activity.view';
        if (str_starts_with($name, 'profile')) return 'profile.manage';
        if (str_starts_with($name, 'chatbot.queries')) {
            return str_contains($name, 'respond') || str_contains($name, 'convert')
                ? 'chatbot.edit'
                : 'chatbot.view';
        }

        $parts = explode('.', $name);
        $module = $parts[0] ?? '';
        $action = $parts[1] ?? 'index';

        $map = [
            'index' => 'view',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'edit',
            'update' => 'edit',
            'toggle' => 'edit',
            'reorder' => 'edit',
            'status' => 'edit',
            'preview' => 'view',
            'destroy' => 'delete',
            'export' => 'edit',
            'reply' => 'edit',
            'reset-password' => 'edit',
            'settings' => 'edit',
        ];

        $capability = $map[$action] ?? 'view';
        if ($module === '') return null;

        return $module . '.' . $capability;
    }
}
