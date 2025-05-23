<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = ['name', 'slug'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'permission_role')
    //         ->using(Role::class);
    // }
}