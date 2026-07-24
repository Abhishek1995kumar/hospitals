<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->integer('firm_id')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->string('user_id', 30)->unique();
            $table->integer('senior_user_id')->nullable();
            $table->integer('is_system')->default(0)->comment('0=Super admin employee, 1=customer company employee');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone',100);
            $table->string('password');
            $table->string('default_password')->nullable();
            $table->integer('wrong_password_atempted')->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->tinyInteger('user_type')->default(7)->comment("1=super admin, 2=admin, 3=customer admin, 4=customer hospital admin, 5=hr, 6=manager, 7=leader, 8=employee");
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->tinyInteger('otp_verified')->default(1)->comment("0=no, 1=yes");
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['customer_id','hospital_id']);
            $table->index(['firm_id']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Schema::create('social_media', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('firm_id');
        //     $table->integer('customer_id')->unsigned();
        //     $table->integer('user_id')->unsigned();
        //     $table->text('url')->nullable();
        //     $table->integer('created_by')->nullable();
        //     $table->integer('updated_by')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('social_media');
    }
};
