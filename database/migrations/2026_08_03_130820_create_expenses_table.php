<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('cost_center_id')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('reference_no')->nullable();
            $table->date('expense_date');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('expenses');
    }
};
