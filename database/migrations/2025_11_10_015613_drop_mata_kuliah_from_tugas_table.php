<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('tugas', function (Blueprint $table) {
            if (Schema::hasColumn('tugas', 'mata_kuliah')) {
                $table->dropColumn('mata_kuliah');
            }
        });
    }
    public function down(): void {
        Schema::table('tugas', function (Blueprint $table) {
            // kalau perlu rollback, buat kembali sebagai nullable
            if (!Schema::hasColumn('tugas', 'mata_kuliah')) {
                $table->string('mata_kuliah')->nullable();
            }
        });
    }
};
