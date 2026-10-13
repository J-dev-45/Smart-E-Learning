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
        Schema::create('topic_pretest', function (Blueprint $table) {
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

            $table->boolean('has_passed')
                ->default(false);

            $table->timestamps();

            $table->unique(
                ['user_id', 'topic_id'],
                'topic_pretest_user_topic_unique'
            );

            $table->index(
                ['user_id', 'module_id'],
                'topic_pretest_user_module_index'
            );

            $table->index(
                ['user_id', 'subject_id'],
                'topic_pretest_user_subject_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_pretest');
    }
};