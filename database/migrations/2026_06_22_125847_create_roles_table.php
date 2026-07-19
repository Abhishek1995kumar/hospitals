<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->string('name');
            $table->string('code'); // SYSTEM / CUSTOMER
            $table->tinyInteger('is_full_access')->default(0)->comment('0=Super Admin/Customer Admin/ Hospital Admin, 1=Normal Employee'); // Default Role
            $table->tinyInteger('scope')->default(0)->comment('0=SYSTEM,1=CUSTOMER'); // Default Role
            $table->boolean('is_system')->default(true)->comment('0=Default/System Generated Role, 1=Custom Role'); // Delete nahi hoga
            $table->boolean('protected_role')->default(false)->comment('customer admin ya super admin delete nahi hoga'); // Priorityz  x 
            $table->integer('role_priority');
            $table->tinyInteger('status')->default(1)->comment("0=inactive, 1=active");
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('customer_id');
            $table->index('hospital_id');
            $table->index('firm_id');
        });
    }

    
    public function down(): void {
        Schema::dropIfExists('roles');
    }
};
