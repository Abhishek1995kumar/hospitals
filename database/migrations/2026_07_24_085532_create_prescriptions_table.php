<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id')->nullable();
            $table->unsignedBigInteger('pharmacy_supplier_id')->comment('This id will getting from suppliers table id, where part type = 1 or 2 (yaha pharmacy_customer ki id aayegi)');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->tinyInteger('patient_type')->comment('1=OPD, 2=IPD');
            $table->tinyInteger('status')->default(1)->comment('1=PENDING, 2=DISPENSED, 3=CANCELLED');
            $table->timestamps();
            $table->index('customer_id');
            $table->index('pharmacy_supplier_id');
            $table->index('doctor_id');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_prescriptions');
    }
};
