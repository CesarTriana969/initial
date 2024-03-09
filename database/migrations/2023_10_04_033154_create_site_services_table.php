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
        Schema::create('site_services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description');
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->boolean('quote')->default(false);

            $table->foreignId('parent_id')->nullable()->constrained('site_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_services');
    }
};
