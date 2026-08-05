<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('firm_id')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->string('code')->unique(); // e.g. CC-101
            $table->string('name');           // e.g. Medical Supplies
            $table->string('slug');
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('cost_centers');
    }
};
