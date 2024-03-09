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
        Schema::create('service_faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_service_id');
            $table->string('faq');
            $table->tinyInteger('column_number');
            $table->timestamps();

            $table->foreign('site_service_id')
            ->references('id')->on('site_services')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_faqs');
    }
};
