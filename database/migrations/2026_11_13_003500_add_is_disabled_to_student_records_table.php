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
        if (Schema::hasTable('student_records') && ! Schema::hasColumn('student_records', 'is_disabled')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->boolean('is_disabled')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('student_records') && Schema::hasColumn('student_records', 'is_disabled')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->dropColumn('is_disabled');
            });
        }
    }
};

