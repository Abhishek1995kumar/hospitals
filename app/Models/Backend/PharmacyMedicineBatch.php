<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PharmacyMedicineBatch extends Model {
    protected $table = 'pharmacy_medicine_batches';
    protected $guarded = [];

    public function medicine(): BelongsTo {
        return $this->belongsTo(PharmacyMedicine::class, 'medicine_id');
    }

    // FEFO (First Expire, First Out) Scope
    public function scopeAvailableFefo($query) {
        return $query->where('current_qty', '>', 0)
                     ->where('expiry_date', '>', now()->toDateString())
                     ->orderBy('expiry_date', 'asc');
    }


    // $availableBatches = PharmacyMedicineBatch::where('customer_id', authUser()->customer_id)
    //                     ->where('medicine_id', $medicineId)
    //                     ->availableFefo() // Uses Scope
    //                     ->get();
}
