<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $guarded = [];

    protected $hidden = [
        'password',
        'default_password',
        'remember_token',
    ];

    
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function roles() { 
        return $this->belongsToMany( Role::class, 'user_roles', 'user_id', 'role_id' ); 
    }
}
