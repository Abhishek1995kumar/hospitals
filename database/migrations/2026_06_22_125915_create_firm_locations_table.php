<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('firms', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('hospital_id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('address')->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->timestamps();
            $table->softDeletes();
            $table->index('name');
            $table->index('code');
            $table->index('hospital_id');
        });
    }


    public function down(): void {
        Schema::dropIfExists('firms');
    }
};
