<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_code')->nullable()->comment('code means IND, USA');
            $table->string('phone_code')->nullable()->comment('phone code means +91, +1');
            $table->string('currency_symbol')->nullable()->comment('symbol means ₹, $');
            $table->string('region')->nullable()->comment('region means Asia, Europe');
            $table->string('capital')->nullable()->comment('capital means New Delhi, Washington DC');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
