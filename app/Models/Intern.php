<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Intern extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'department',
    ];

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tasks assigned to this intern
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_intern');
    }
}
