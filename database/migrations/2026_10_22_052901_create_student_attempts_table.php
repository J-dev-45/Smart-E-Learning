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
        Schema::create('student_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignUuid('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');

            $table->foreignUuid('module_id')
                ->nullable()
                ->constrained('modules')
                ->onDelete('cascade');

            $table->enum('type_of_assessment', ['activity', 'quiz', 'exam']);
            $table->integer('attempts_count')->default(1);

            $table->timestamp('started_at');
            $table->timestamp('ends_at');          
            $table->timestamp('finished_at')->nullable();   

            $table->timestamps();

            $table->index(['user_id', 'subject_id', 'module_id', 'type_of_assessment']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attempts');
    }
};
