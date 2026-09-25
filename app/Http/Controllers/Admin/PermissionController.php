<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('page')) {
            $request->session()->forget('success');
        }
        $users = User::where('role', '!=', 'superadmin')->orderBy('name')->get();
        $selectedUser = null;
        if ($request->filled('user_id')) {
            $selectedUser = User::find($request->input('user_id'));
        }
        if (!$selectedUser) {
            $selectedUser = $users->first();
        }

        $permissions = Permission::orderBy('group')->orderBy('name')->get()->groupBy('group');
        $assigned = $selectedUser ? $selectedUser->permissions()->pluck('permission_id')->all() : [];

        return view('admin.pages.permissions.index', compact('users', 'selectedUser', 'permissions', 'assigned'));
    }

    public function update(Request $request, string $role)
    {
        // kept for backward compatibility if needed
        if ($request->user()->role !== 'superadmin') {
            abort(403, 'Only super admins can manage roles.');
        }
        $roles = ['superadmin', 'admin', 'editor'];
        if (!in_array($role, $roles, true)) {
            return back()->with('error', 'Invalid role.');
        }
        $permissionIds = $request->input('permissions', []);
        RolePermission::where('role', $role)->delete();
        foreach ($permissionIds as $id) {
            RolePermission::create(['role' => $role, 'permission_id' => $id]);
        }
        return back()->with('success', 'Role permissions updated.');
    }

    public function updateUser(Request $request, User $user)
    {
        if ($request->user()->role !== 'superadmin') {
            abort(403, 'Only super admins can manage user rights.');
        }

        $permissionIds = $request->input('permissions', []);
        $user->permissions()->sync($permissionIds);

        return back()->with('success', 'User rights updated.');
    }
}
