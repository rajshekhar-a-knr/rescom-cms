<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower(trim((string) $value));
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) return true;

        $direct = $this->permissions()->where('name', $permission)->exists();
        if ($direct) return true;

        return \App\Models\RolePermission::where('role', $this->role)
            ->whereHas('permission', function ($q) use ($permission) {
                $q->where('name', $permission);
            })
            ->exists();
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return media_url($this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=3b82f6&color=fff';
    }
}
