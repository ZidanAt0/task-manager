<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('tugas','course_id')) {
                $table->foreignId('course_id')
                      ->nullable()
                      ->after('user_id')           // sesuaikan posisi kolommu
                      ->constrained('courses')
                      ->nullOnDelete();
            }
            if (!Schema::hasColumn('tugas','description')) {
                $table->text('description')->nullable()->after('title');
            }
        });
    }
    public function down(): void {
        Schema::table('tugas', function (Blueprint $table) {
            if (Schema::hasColumn('tugas','course_id')) {
                $table->dropConstrainedForeignId('course_id');
            }
            if (Schema::hasColumn('tugas','description')) {
                $table->dropColumn('description');
            }
        });
    }
};
