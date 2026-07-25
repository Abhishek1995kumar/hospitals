<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_bill_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id')->nullable();
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, (customer ki id hogi jiska party type 1 ya 2 hoga)');
            $table->unsignedBigInteger('pharmacy_bill_id')->nullable()->comment('id getting from pharmacy_bills table id');
            $table->unsignedBigInteger('medicine_id')->nullable()->comment('id getting from medicines table id');
            $table->unsignedBigInteger('batch_id')->nullable()->comment('id getting from medicine_batches table id, Tracked exact batch sold!');
            $table->integer('quantity')->nullable()->comment('pharmacy_bills');
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamps();
            $table->index('customer_id');
            $table->index('pharmacy_supplier_id');
            $table->index('medicine_id');
            $table->index('batch_id');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_bill_items');
    }
};
