<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('department_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->integer('firm_id')->nullable();
            $table->string('title'); // e.g., "Hospital Annual Budget 2024-2025"
            $table->string('financial_year'); // e.g., "2024-2025"
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount', 15, 2); // E.g., Total 5 Crore
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('budgets');
    }
};
