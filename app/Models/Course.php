<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','dosen_pengampu','semester','user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // scope: hanya data milik user tertentu
    public function scopeForUser($q, $userId) {
        return $q->where('user_id', $userId);
    }
}
