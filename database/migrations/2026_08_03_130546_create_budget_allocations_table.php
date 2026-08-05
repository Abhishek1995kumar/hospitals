<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('budget_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('department_id')->nullable();
            $table->integer('budget_id')->nullable();
            $table->integer('cost_center_id')->nullable();
            $table->decimal('allocated_amount', 15, 2)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('budget_allocations');
    }


};
