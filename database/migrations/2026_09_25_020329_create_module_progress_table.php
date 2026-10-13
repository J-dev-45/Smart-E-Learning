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
        Schema::create('module_progress', function (Blueprint $table) {
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

            $table->double('progress')
                ->default(0);

            $table->enum('status', ['open', 'locked', 'passed'])
                ->default('locked');

            $table->boolean('has_passed')
                ->default(false);

            $table->timestamps();

            $table->unique(
                ['user_id', 'module_id'],
                'module_progress_user_module_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_progress');
    }
};