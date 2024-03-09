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
        Schema::create('email_validations', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('code');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_validations');
    }
};
