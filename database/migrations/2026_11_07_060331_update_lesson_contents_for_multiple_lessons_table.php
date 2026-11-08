<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            DO $$
            DECLARE
                constraint_name TEXT;
            BEGIN
                SELECT con.conname
                INTO constraint_name
                FROM pg_constraint con
                JOIN pg_class rel
                    ON rel.oid = con.conrelid
                JOIN pg_attribute att
                    ON att.attrelid = rel.oid
                    AND att.attnum = ANY(con.conkey)
                WHERE rel.relname = 'lesson_contents'
                    AND con.contype = 'u'
                    AND att.attname = 'topic_id'
                LIMIT 1;

                IF constraint_name IS NOT NULL THEN
                    EXECUTE format(
                        'ALTER TABLE lesson_contents DROP CONSTRAINT %I',
                        constraint_name
                    );
                END IF;
            END $$;
        ");

        Schema::table('lesson_contents', function (Blueprint $table) {
            $table->unsignedInteger('order')
                ->default(0)
                ->after('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_contents', function (Blueprint $table) {
            $table->dropColumn('order');

            $table->unique('topic_id');
        });
    }
};