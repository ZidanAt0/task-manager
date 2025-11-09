<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika sudah sesuai konvensi Laravel)
    protected $table = 'tugas';

    // Menentukan field yang bisa diisi secara massal
    protected $fillable = [
        'judul',
        'mata_kuliah',
        'deadline',
        'waktu_deadline',
        'status',
    ];
}
