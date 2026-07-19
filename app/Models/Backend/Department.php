<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'departments';
    protected $guarded = [];
}
