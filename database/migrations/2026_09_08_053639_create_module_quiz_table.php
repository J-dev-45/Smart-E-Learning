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
        Schema::create('module_quiz', function (Blueprint $table) {
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

            $table->boolean('is_open')
                ->default(false);
            
            $table->boolean('has_passed')
                ->default(false);

            $table->boolean('coding_passed')
                ->default(false);

            $table->boolean('questions_type_passed')
                ->default(false);

            $table->integer('scored')
                ->default(0);

            $table->timestamps();

            $table->unique(
                ['user_id', 'module_id'],
                'module_quiz_user_module_unique'
            );

            $table->index(
                ['user_id', 'subject_id'],
                'module_quiz_user_subject_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_quiz');
    }
};