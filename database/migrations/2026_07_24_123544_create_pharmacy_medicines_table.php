<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id');
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, where part type = 2 or 3 (supplier)')->nullable();
            $table->unsignedBigInteger('category_id')->comment('This id will getting from pharmacy_categories table id, where part type = 2 or 3 (supplier)')->nullable();
            $table->string('brand_name')->comment('e.g., Crocin 500mg');
            $table->string('generic_name')->comment('e.g., Paracetamol');
            $table->string('hsn_code')->nullable()->comment('Tax/GST Code');
            $table->tinyInteger('drug_type')->default(1)->comment('1=OTC, 2=SCHEDULE_H, 3=SCHEDULE_H1, 4=NARCOTIC');
            $table->string('unit_of_measure')->comment('e.g., Strip, Bottle, Box');
            $table->integer('min_reorder_level')->default(10)->comment('Low stock alert threshold'); 
            $table->string('rack_number')->nullable()->comment('Physical location in pharmacy');
            $table->string('shelf_number')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->timestamps();
            $table->index(['customer_id', 'pharmacy_supplier_id']);
            $table->index('brand_name');
            $table->index('generic_name');
            $table->index('hsn_code');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_medicines');
    }
};
