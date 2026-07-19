<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'roles';
    protected $guarded = [];

    public function permissions() { 
        return $this->belongsToMany( Permission::class, 'role_permissions', 'role_id', 'permission_id' ); 
    }
}
