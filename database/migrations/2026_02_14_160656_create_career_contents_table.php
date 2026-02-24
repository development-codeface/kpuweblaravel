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
        Schema::create('career_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pages_id')->nullable();
            $table->string('title');
            $table->string('job_type')->nullable();      // Full Time / Part Time
            $table->string('work_mode')->nullable();     // On Site / Remote / Hybrid
            $table->string('salary_min')->nullable();
            $table->string('salary_max')->nullable();
            $table->string('salary_type')->nullable();   // week / month / year
            $table->string('location')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_contents');
    }
};
