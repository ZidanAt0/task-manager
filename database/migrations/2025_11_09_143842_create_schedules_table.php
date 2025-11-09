<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_name')->nullable(); // nama mata kuliah
            $table->text('description')->nullable(); // deskripsi (akan dienkripsi)
            $table->timestamp('deadline')->nullable(); // deadline tugas
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo'); // status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
