<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(false);
            $table->date('dob');
            $table->dateTime('doj');
            $table->dateTime('dol');
            $table->longText('profile');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal_code');
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void {
        Schema::dropIfExists('user_details');
    }
};
