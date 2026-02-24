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
        Schema::create('pharmacy_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pages_id');
            $table->string('title');
            $table->string('sub_title');
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_plans');
    }
};
