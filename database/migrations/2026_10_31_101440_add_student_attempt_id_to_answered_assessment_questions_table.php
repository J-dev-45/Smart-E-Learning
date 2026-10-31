<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('answered_assessment_questions', function (Blueprint $table) {
            $table->foreignId('student_attempt_id')
                ->nullable()
                ->after('user_id')
                ->constrained('student_attempts')
                ->cascadeOnDelete();

            $table->index(
                ['student_attempt_id', 'question_id'],
                'answered_assessment_attempt_question_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('answered_assessment_questions', function (Blueprint $table) {
            $table->dropIndex('answered_assessment_attempt_question_index');
            $table->dropForeign(['student_attempt_id']);
            $table->dropColumn('student_attempt_id');
        });
    }
};