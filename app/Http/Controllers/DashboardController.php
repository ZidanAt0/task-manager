<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas; // import model Tugas

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data tugas
        $tugas = Tugas::all();

        // Kirim data ke view dashboard
        return view('dashboard', compact('tugas'));
    }
}
