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
        if (Schema::hasTable('contents')) {
            return;
        }

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('pages_id')->nullable();
            $table->string('button_text')->nullable();
            $table->string('heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
