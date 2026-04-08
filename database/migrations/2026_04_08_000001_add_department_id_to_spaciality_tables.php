<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'spaciality_banners',
        'spaciality_blogs',
        'spaciality_contents',
        'spaciality_features',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'department_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->unsignedBigInteger('department_id')->nullable()->index();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'department_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropIndex(['department_id']);
                    $table->dropColumn('department_id');
                });
            }
        }
    }
};
