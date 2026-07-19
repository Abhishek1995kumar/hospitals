<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('name');
            $table->string('action');
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->timestamps();
            $table->softDeletes();
            $table->index(['name']);
        });
    }


    
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
