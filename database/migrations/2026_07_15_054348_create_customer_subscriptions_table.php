<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customer_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('invoice_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('amount',10,2);
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('payment_gateway')->comment('1=Razorpay, 2=Stripe, 3=Cash, 4=Bank Transfer, 5=Mango Pay');
            $table->tinyInteger('payment_status')->default(1)->comment('1=Success, 2=Pending, 3=Failed');
            $table->tinyInteger('status')->default(1)->comment('1=Current, 0=History');
            $table->timestamps();

        });
    }


    public function down(): void {
        Schema::dropIfExists('customer_subscriptions');
    }
};
