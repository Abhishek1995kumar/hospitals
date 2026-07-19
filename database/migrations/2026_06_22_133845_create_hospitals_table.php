<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('hospital_id')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('license_no')->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->integer('total_beds')->default(0);
            $table->integer('total_icu_beds')->default(0);
            $table->integer('total_operation_theatres')->default(0);
            $table->integer('total_ambulances')->default(0);
            $table->integer('total_wards')->default(0);
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();  
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->boolean('is_24x7')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_emergency')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_icu')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_pharmacy')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_blood_bank')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_lab')->default(0)->comment('0=No, 1=Yes');
            $table->boolean('has_ambulance')->default(0)->comment('0=No, 1=Yes');
            $table->tinyInteger('is_hospital_clinic')->default(1)->comment('1=Hospital, 2=Clinic');
            $table->tinyInteger('hospital_type')->comment('1=General, 2=Speciality, 3=Multi Speciality, 4=Clinic, 5=Diagnostic Center')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
