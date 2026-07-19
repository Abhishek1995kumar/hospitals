<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->decimal('price',10,2);
            $table->integer('duration_days')->nullable();
            $table->integer('max_hospitals')->nullable();
            $table->integer('max_firms')->nullable();
            $table->integer('max_users')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Current, 0=History');
            $table->timestamps();
        });
    }


    public function down(): void {
        Schema::dropIfExists('plans');
    }
};
