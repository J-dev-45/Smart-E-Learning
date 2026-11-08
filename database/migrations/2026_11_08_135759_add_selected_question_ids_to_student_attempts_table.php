<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_attempts', function (Blueprint $table) {
            $table->json('selected_question_ids')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_attempts', function (Blueprint $table) {
            $table->dropColumn('selected_question_ids');
        });
    }
};