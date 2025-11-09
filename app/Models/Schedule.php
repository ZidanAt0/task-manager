<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_name',
        'description',
        'deadline',
        'status',
    ];

    protected $casts = [
        'description' => 'encrypted', // otomatis enkripsi/dekripsi
        'deadline' => 'datetime',
    ];
}
