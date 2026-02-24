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
        Schema::create('director_blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('director_contents_id');
            $table->string('heading')->nullable();
            $table->string('designation')->nullable();
            $table->string('image')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director_blogs');
    }
};
