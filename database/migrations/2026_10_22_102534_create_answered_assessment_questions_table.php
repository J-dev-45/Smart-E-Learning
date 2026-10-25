<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answered_assessment_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignUuid('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->foreignUuid('module_id')
                ->nullable()
                ->constrained('modules')
                ->nullOnDelete();

            $table->foreignUuid('question_id')
                ->constrained('questions')
                ->cascadeOnDelete();

            $table->enum('type_of_assessment', ['quiz', 'exam']);

            $table->text('user_answer')->nullable();
            $table->text('correct_answer');
            $table->text('explanation');
            $table->boolean('is_correct')->default(false);

            $table->timestamps();

            $table->index(
                ['user_id', 'subject_id'],
                'answered_assessment_questions_user_subject_index'
            );

            $table->index(
                ['user_id', 'module_id'],
                'answered_assessment_questions_user_module_index'
            );

            $table->index(
                ['user_id', 'question_id'],
                'answered_assessment_questions_user_question_index'
            );

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answered_assessment_questions');
    }
};