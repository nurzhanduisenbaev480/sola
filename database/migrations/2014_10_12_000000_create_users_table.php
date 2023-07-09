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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('visible_password')->nullable();
            $table->string('from_company')->nullable();
            $table->string('from_city')->nullable();
            $table->string('from_phone')->nullable();
            $table->string('from_address')->nullable();
            $table->string('from_site')->nullable();
            $table->string('type')->nullable();
            $table->string('company_type')->nullable();
            $table->string('iin')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_real_address')->nullable();
            $table->string('bin')->nullable();
            $table->string('bik')->nullable();
            $table->string('payment_card')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('director_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('author')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
