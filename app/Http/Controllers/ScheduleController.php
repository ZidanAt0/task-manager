<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Jadwal tetap dari Senin–Jumat
        $schedules = [
            'Senin' => [
                ['mata_kuliah' => 'Pemrograman Web Lanjut', 'jam' => '07:00 - 09:30', 'ruangan' => 'Lab 2'],
                ['mata_kuliah' => 'Kecerdasan Buatan', 'jam' => '09:30 - 12:00', 'ruangan' => 'Ruang 301'],
            ],
            'Selasa' => [
                ['mata_kuliah' => 'Basis Data', 'jam' => '07:00 - 09:30', 'ruangan' => 'Ruang 205'],
                ['mata_kuliah' => 'Sistem Operasi', 'jam' => '13:00 - 15:30', 'ruangan' => 'Lab 1'],
            ],
            'Rabu' => [
                ['mata_kuliah' => 'Analisis dan Perancangan Sistem', 'jam' => '09:30 - 12:00', 'ruangan' => 'Ruang 202'],
            ],
            'Kamis' => [
                ['mata_kuliah' => 'Pemrograman Mobile', 'jam' => '07:00 - 09:30', 'ruangan' => 'Lab 3'],
                ['mata_kuliah' => 'Metodologi Penelitian', 'jam' => '13:00 - 15:30', 'ruangan' => 'Ruang 303'],
            ],
            'Jumat' => [
                ['mata_kuliah' => 'Etika Profesi', 'jam' => '09:30 - 12:00', 'ruangan' => 'Ruang 201'],
            ],
        ];

        return view('schedules.index', compact('schedules'));
    }
}
