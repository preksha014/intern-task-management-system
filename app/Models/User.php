<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Role relationships
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    // Check if user has role
    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    // Check if user has permission
    public function hasPermission($permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Get cached permissions from request if available
        $request = request();
        if ($request && $request->attributes->has('permissions')) {
            $cachedPermissions = $request->attributes->get('permissions');
            
            // Get user role IDs
            $userRoleIds = $this->roles->pluck('id')->toArray();
            
            // Check if any of the user's roles have the requested permission
            foreach ($cachedPermissions as $cachedPermission) {
                if ($cachedPermission->name === $permission) {
                    // Check if any of the permission's roles match user's roles
                    $permissionRoleIds = $cachedPermission->roles->pluck('id')->toArray();
                    if (count(array_intersect($userRoleIds, $permissionRoleIds)) > 0) {
                        return true;
                    }
                }
            }
            return false;
        }
        // Fallback to database query if cached permissions are not available
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin' || $this->hasRole('admin');
    }

    // Check if user is intern
    public function isIntern()
    {
        return $this->role === 'intern' || $this->hasRole('intern');
    }

    // Admin relationship
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function isSuperAdmin()
    {
        return $this->admin && $this->admin->isSuperAdmin();
    }

    // Intern relationship
    public function intern()
    {
        return $this->hasOne(Intern::class);
    }

    // Comments relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Tasks created by user admin
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'intern_id');
    }
}