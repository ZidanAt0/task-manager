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
                ['mata_kuliah' => 'Pemrograman Web Lanjut', 'jam' => '07:00 - 09:30', 'ruangan' => 'Lab R1'],
                ['mata_kuliah' => 'Sistem Interaksi', 'jam' => '09:30 - 12:00', 'ruangan' => 'GIK C'],
            ],
            'Selasa' => [
                ['mata_kuliah' => 'Sistem Informasi Geografis', 'jam' => '07:00 - 09:30', 'ruangan' => 'MIPAT A'],
                ['mata_kuliah' => 'Sistem Pakar', 'jam' => '13:00 - 15:30', 'ruangan' => 'Lab 1'],
            ],
            'Rabu' => [
                ['mata_kuliah' => 'Pengenalan Pola', 'jam' => '09:30 - 12:00', 'ruangan' => 'GIK C'],
                ['mata_kuliah' => 'Pengenalan Pola (R)', 'jam' => '13:00 - 15:30', 'ruangan' => 'GIK C'],
            ],
            'Kamis' => [
                ['mata_kuliah' => 'Pemrograman Mobile', 'jam' => '07:00 - 09:30', 'ruangan' => 'Lab 3'],
                ['mata_kuliah' => 'Metodologi Penelitian', 'jam' => '13:00 - 15:30', 'ruangan' => 'GIK L2'],
            ],
            'Jumat' => [
                ['mata_kuliah' => 'Pancasila', 'jam' => '09:30 - 12:00', 'ruangan' => 'GIK L2'],
            ],
        ];

        return view('schedules.index', compact('schedules'));
    }
}
