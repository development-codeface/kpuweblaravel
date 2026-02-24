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
        Schema::create('about_mid_sub_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_mid_content_id')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_mid_sub_contents');
    }
};
