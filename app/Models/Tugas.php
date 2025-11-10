<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = ['user_id','course_id','judul','description','deadline','status'];

    protected $casts = [
        'deadline'    => 'datetime',
        'description' => 'encrypted',   // deskripsi terenkripsi
    ];

    public function course(){ return $this->belongsTo(Course::class,'course_id'); }
    public function scopeForUser($q,$uid){ return $q->where('user_id',$uid); }

    // Opsional: alias supaya $tugas->title tetap bisa dipakai di Blade
    public function getTitleAttribute(){ return $this->judul; }
    public function setTitleAttribute($v){ $this->attributes['judul'] = $v; }
}
