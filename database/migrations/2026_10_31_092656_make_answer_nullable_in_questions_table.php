<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE questions ALTER COLUMN answer DROP NOT NULL');
    }

    public function down(): void
    {
        DB::statement("UPDATE questions SET answer = '' WHERE answer IS NULL");
        DB::statement('ALTER TABLE questions ALTER COLUMN answer SET NOT NULL');
    }
};