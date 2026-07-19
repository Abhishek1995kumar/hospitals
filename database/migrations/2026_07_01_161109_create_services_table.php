<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->nullable()->commit('hospital/customer ki firm location'); // kis hospital/customer ki firm location hai
            $table->unsignedBigInteger('hospital_id')->nullable()->commit('hospital/customer ke hospital'); // kis hospital/customer ka service hai
            $table->unsignedBigInteger('parent_id')->nullable()->commit('parent service id'); // category support (nullable)
            $table->string('name');
            $table->string('slug')->unique(); // pregnancy-care
            $table->string('route')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0)->commit('0=default, 1=first, 2=second, 3=third');
            $table->boolean('is_visible')->default(true);
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
            // $table->foreign('firm_id')->references('id')->on('firms')->onDelete('set null');
            // $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('set null');
            // $table->foreign('parent_id')->references('id')->on('services')->onDelete('set null');
            // $table->index(['firm_id', 'hospital_id', 'parent_id']);
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
