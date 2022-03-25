<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->BelongsTo(Role::class, 'role_id', 'id');
    }

    public function hasPermission($slug) {
        $permissions = Auth::user()->role->permissions;
        foreach ($permissions as $permission) {
            if ($permission->slug === $slug) {
                return true;
            }
        }
        return false;
    }
}
