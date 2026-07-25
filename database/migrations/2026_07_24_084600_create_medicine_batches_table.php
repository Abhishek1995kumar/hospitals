<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_medicine_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id');
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, where part type = 2 or 3 or 4 (supplier/vendor ki id)');
            $table->unsignedBigInteger('vendor_id')->nullable()->comment('This id will getting from suppliers table id where party_type=4');
            $table->unsignedBigInteger('medicine_id')->comment('This id will getting from medicines table id');
            $table->string('batch_number')->comment('e.g., BATCH-2026-X01');
            $table->date('mfg_date')->nullable()->comment('drug manufacturing date')->nullable();
            $table->date('expiry_date')->comment('Crucial for FEFO Sorting!')->nullable();
            $table->integer('purchase_qty')->comment('Total received')->nullable();
            $table->integer('current_qty')->comment('Available stock')->nullable(); 
            $table->decimal('unit_cost_price', 10, 2)->comment('Purchase price')->nullable(); 
            $table->decimal('unit_mrp', 10, 2)->comment('Maximum Retail Price')->nullable();
            $table->decimal('selling_price', 10, 2)->comment('Selling price')->nullable();
            $table->decimal('tax_percentage', 5, 2)->default(0.00)->nullable();
            $table->timestamps();            
            // Indexing for Fast FEFO Queries
            $table->index('customer_id');
            $table->index('pharmacy_supplier_id');
            $table->index('medicine_id');
            $table->index('expiry_date');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_medicine_batches');
    }
};
