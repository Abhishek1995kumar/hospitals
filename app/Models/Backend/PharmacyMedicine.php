<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PharmacyMedicine extends Model {
    protected $table = 'pharmacy_medicines';

    protected $guarded = [];

    // Relationships
    public function supplier(): BelongsTo {
        return $this->belongsTo(PharmacySupplier::class, 'pharmacy_supplier_id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(PharmacyCategory::class, 'category_id');
    }

    public function batches(): HasMany {
        return $this->hasMany(PharmacyMedicineBatch::class, 'medicine_id');
    }

    // Active Batches Scope
    public function scopeActive($query) {
        return $query->where('status', 1);
    }


    
}
