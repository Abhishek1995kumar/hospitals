<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolePermission extends Model {
    // use HasFactory, SoftDeletes;
    
    protected $table = 'role_permissions';
    protected $guarded = [];
}
