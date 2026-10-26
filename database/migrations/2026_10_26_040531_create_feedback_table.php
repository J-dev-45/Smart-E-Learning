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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('student_name');

            $table->foreignUuid('question_id')
                ->nullable()
                ->constrained('questions')
                ->nullOnDelete();

            $table->text('feedback_message');

            $table->string('replied_by')->nullable();
            $table->text('reply_message')->nullable();

            $table->enum('status', ['New', 'Unread', 'Done'])
                ->default('New');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
