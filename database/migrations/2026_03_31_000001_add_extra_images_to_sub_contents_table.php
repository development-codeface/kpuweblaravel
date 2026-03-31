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
        Schema::table('sub_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_contents', 'image_2')) {
                $table->string('image_2')->nullable()->after('image');
            }

            if (!Schema::hasColumn('sub_contents', 'image_3')) {
                $table->string('image_3')->nullable()->after('image_2');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_contents', function (Blueprint $table) {
            if (Schema::hasColumn('sub_contents', 'image_3')) {
                $table->dropColumn('image_3');
            }

            if (Schema::hasColumn('sub_contents', 'image_2')) {
                $table->dropColumn('image_2');
            }
        });
    }
};
