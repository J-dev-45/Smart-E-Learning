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
        Schema::create('topic_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignUuid('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');

            $table->foreignUuid('module_id')
                ->constrained('modules')
                ->onDelete('cascade');

            $table->foreignUuid('topic_id')
                ->constrained('topics')
                ->onDelete('cascade');

            $table->unsignedTinyInteger('scroll_progress')
                ->default(0);

            $table->unsignedTinyInteger('question_score')
                ->default(0);

            $table->unsignedTinyInteger('progress')
                ->default(0);

            $table->boolean('has_passed')
                ->default(false);

            $table->timestamps();

            $table->unique(
                ['user_id', 'topic_id'],
                'topic_progress_user_topic_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_progress');
    }
};