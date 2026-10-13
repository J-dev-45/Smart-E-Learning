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
        Schema::create('answered_topic_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignUuid('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade');

            $table->foreignUuid('question_id')
                ->constrained('questions')
                ->onDelete('cascade');

            $table->text('user_answer');
            $table->text('correct_answer');
            $table->text('explanation');
            $table->timestamps();

            $table->index(
                ['user_id', 'topic_id'],
                'answered_questions_user_topic_index'
            );

            $table->unique(
                ['user_id', 'question_id'],
                'answered_topic_pretest_user_question_unique'
            );
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answered_topic_questions');
    }
};