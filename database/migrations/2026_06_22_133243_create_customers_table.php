<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id',20)->unique();
            $table->string('customer_slug')->unique();
            $table->string('customer_name');
            $table->string('email')->unique();
            $table->string('mobile_no',100)->nullable();
            $table->string('alternate_mobile',100)->nullable();
            $table->string('website')->nullable();
            $table->integer('max_hospitals')->default(1);
            $table->integer('max_users')->default(50);
            $table->integer('max_firms')->default(1);
            $table->unsignedBigInteger('current_plan_id')->nullable();
            $table->boolean('is_trial')->default(1)->nullable();
            $table->date('trial_end_date')->nullable();
            $table->tinyInteger('subscription_status')->default(1)->comment('1=Active, 2=Expired, 3=Suspended');
            $table->date('subscription_start_date')->nullable();
            $table->date('subscription_end_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->date('next_billing_date')->nullable();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->json('details')->nullable();
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('customers');
    }


};
