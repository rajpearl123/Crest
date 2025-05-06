<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admins extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function isSuperAdmin() {
        return $this->role_id == 0;
    }
    public function isStaff() {
        return $this->role_id != 0;
    }

    // Relationship: Admin belongs to a Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relationship: Admin permissions via Role
    public function permissions(): BelongsToMany
    {
        return $this->role->permissions();
    }

    // Check if Admin has a specific permission
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->pluck('name')->contains($permission);
    }
    
}
