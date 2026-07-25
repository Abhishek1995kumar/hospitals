<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pharmacy_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('This id will getting from customers table id, Multi-tenant SaaS ID');
            $table->string('name')->nullable()->comment('e.g., Tablets, Syrups, Injectables');
            $table->tinyInteger('status')->default(1)->comment('0=inactive, 1=active');
            $table->timestamps();
            $table->index('customer_id');
            $table->index('name');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pharmacy_categories');
    }
};
