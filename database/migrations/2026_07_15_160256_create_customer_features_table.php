<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->comment('id getting from modules table');
            $table->string('feature_name');
            $table->string('feature_slug');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->timestamps();
        });
    }


    public function down(): void {
        Schema::dropIfExists('features');
    }
};
