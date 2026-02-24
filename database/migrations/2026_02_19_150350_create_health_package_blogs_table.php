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
        Schema::create('health_package_blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pages_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_package_blogs');
    }
};
