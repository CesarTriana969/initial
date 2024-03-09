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
        Schema::create('quote_site_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('site_service_id');
            $table->timestamps();
        
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('site_service_id')->references('id')->on('site_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_site_service');
    }
};
