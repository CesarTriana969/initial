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
        Schema::create('service_counties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('service_state_id'); 
            $table->timestamps();

            $table->foreign('service_state_id')
                ->references('id')
                ->on('service_states')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_counties');
    }
};
