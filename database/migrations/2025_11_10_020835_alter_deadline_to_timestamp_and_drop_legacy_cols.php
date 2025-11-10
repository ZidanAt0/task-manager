<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::table('tugas', function (Blueprint $table) {
        // ubah deadline jadi datetime (akan menjadi 'timestamp without time zone' di Postgres)
        if (Schema::hasColumn('tugas', 'deadline')) {
            $table->dateTime('deadline')->nullable()->change();
        }

        // buang kolom lama bila masih ada
        if (Schema::hasColumn('tugas', 'waktu_deadline')) {
            $table->dropColumn('waktu_deadline');
        }
        if (Schema::hasColumn('tugas', 'mata_kuliah')) {
            $table->dropColumn('mata_kuliah');
        }
    });
}


    public function down(): void {
        Schema::table('tugas', function (Blueprint $table) {
            // rollback seadanya
            if (Schema::hasColumn('tugas', 'deadline')) {
                $table->date('deadline')->nullable()->change();
            }
            if (!Schema::hasColumn('tugas', 'waktu_deadline')) {
                $table->time('waktu_deadline')->nullable();
            }
            if (!Schema::hasColumn('tugas', 'mata_kuliah')) {
                $table->string('mata_kuliah')->nullable();
            }
        });
    }
};
