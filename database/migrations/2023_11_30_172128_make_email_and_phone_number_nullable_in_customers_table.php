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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('birth_day')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('zip_code')->nullable()->change();
            $table->string('address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('first_name')->nullable(false)->change();
            $table->string('birth_day')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('state')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
        });
    }
};
