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
        if (!Schema::hasTable('sub_sections') || Schema::hasColumn('sub_sections', 'image')) {
            return;
        }

        Schema::table('sub_sections', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('sub_sections') || !Schema::hasColumn('sub_sections', 'image')) {
            return;
        }

        Schema::table('sub_sections', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
