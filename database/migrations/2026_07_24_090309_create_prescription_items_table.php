<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_prescription_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id')->nullable();
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, where part type = 2 or 3 (supplier)');
            $table->unsignedBigInteger('prescription_id')->comment('id getting from prescriptions table')->nullable();
            $table->unsignedBigInteger('medicine_id')->comment('Doctor chose medicine, id getting from medicines table')->nullable();
            $table->string('dosage')->comment('e.g., 500mg')->nullable();
            $table->string('frequency')->comment('e.g., 1-0-1 (Subah-Shaam)')->nullable();
            $table->integer('duration_days')->comment('e.g., 5 Days')->nullable();
            $table->integer('total_qty_prescribed')->comment('e.g., 10 Tablets')->nullable();
            $table->string('instructions')->nullable()->comment('e.g., After food')->nullable();
            $table->timestamps();
            $table->index('customer_id');
            $table->index('pharmacy_supplier_id');
            $table->index('medicine_id');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_prescription_items');
    }
};
