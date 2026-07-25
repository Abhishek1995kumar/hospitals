<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable()->comment('This id will getting from customers table (means ye customer, super admin ka client hai)');
            $table->unsignedBigInteger('hospital_id')->nullable()->comment('This id will getting from hospitals table');
            $table->unsignedBigInteger('firm_id')->nullable()->commit('hospital/customer ki firm location');
            $table->string('company_name')->nullable();
            $table->string('name')->comment('Party/Pharmacy Customer Name');
            $table->string('slug')->nullable();
            $table->string('email')->nullable();
            $table->string('gst_no')->nullable()->unique();
            $table->string('pan_no')->nullable()->unique();
            $table->string('contact')->nullable();
            $table->string('contact_person')->comment('Supplier ke liye')->nullable();
            $table->string('drug_license_no')->comment('Supplier ke liye')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_address')->nullable();
            $table->string('address')->nullable();
            $table->decimal('opening_balance',10,2)->nullable()->comment('opening balance')->nullable();
            $table->decimal('credit_limit',10,2)->nullable()->comment('Customer ke liye, Grahak ko kitni amount tak udhar dena allow hai.')->nullable();
            $table->tinyInteger('credit_days')->nullable()->comment("Supplier ke liye")->nullable();
            $table->tinyInteger('balance_type')->default(1)->comment("1=Credit, 2=Debit")->nullable();
            $table->tinyInteger('party_type')->default(1)->comment("1=Customer, 2=Supplier, 3=Customer+Supplier, 4=Vendor, 5=Referral Doctor, 6=Manufacturer");
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->timestamps();
            $table->SoftDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_suppliers');
    }
};
