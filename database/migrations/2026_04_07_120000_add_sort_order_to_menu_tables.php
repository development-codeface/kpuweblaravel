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
        if (Schema::hasTable('menu_items') && !Schema::hasColumn('menu_items', 'sort_order')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('url');
            });
        }

        if (Schema::hasTable('sub_menus') && !Schema::hasColumn('sub_menus', 'sort_order')) {
            Schema::table('sub_menus', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('url');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('menu_items') && Schema::hasColumn('menu_items', 'sort_order')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasTable('sub_menus') && Schema::hasColumn('sub_menus', 'sort_order')) {
            Schema::table('sub_menus', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};
