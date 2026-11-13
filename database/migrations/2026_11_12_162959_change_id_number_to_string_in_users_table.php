<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN id_number TYPE VARCHAR(50) USING id_number::VARCHAR(50)');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->string('id_number', 50)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN id_number TYPE INTEGER USING id_number::INTEGER');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedInteger('id_number')->change();
            });
        }
    }
};
