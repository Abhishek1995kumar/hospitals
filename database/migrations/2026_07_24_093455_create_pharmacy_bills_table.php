<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id')->nullable();
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, (customer ki id hogi jiska party type 1 ya 2 hoga)');
            $table->unsignedBigInteger('prescription_id')->nullable()->comment('Null if Direct Walk-in / Retail, id getting from prescriptions table'); // 
            $table->unsignedBigInteger('patient_id')->nullable()->comment('');
            $table->unsignedBigInteger('served_by_employee_id')->comment('Pharmacist User ID');
            $table->string('bill_number')->unique()->comment('bill number');
            $table->decimal('sub_total', 10, 2)->comment('sub total');
            $table->decimal('discount_amount', 10, 2)->default(0.00)->comment('discount amount');
            $table->decimal('tax_amount', 10, 2)->default(0.00)->comment('tax amount');
            $table->decimal('grand_total', 10, 2)->comment('grand total');
            $table->tinyInteger('payment_status')->default(1)->comment('1=PAID, 2=PARTIAL, 3=UNPAID');
            $table->tinyInteger('payment_mode')->default(1)->comment('1=CASH, 2=CARD, 3=UPI, 4=INSURANCE, 5=HOSPITAL_LEDGER');
            $table->timestamps();
            $table->index('customer_id');
            $table->index('pharmacy_supplier_id');
            $table->index('bill_number');
            $table->index('prescription_id');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_bills');
    }
};
