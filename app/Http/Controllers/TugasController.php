<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'mata_kuliah' => 'required',
            'deadline' => 'required|date',
            'waktu_deadline' => 'required',
            'status' => 'required',
        ]);

        Tugas::create($request->all());
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Tugas $tuga)
    {
        return view('tugas.edit', compact('tuga'));
    }

    public function update(Request $request, Tugas $tuga)
    {
        $request->validate([
            'judul' => 'required',
            'mata_kuliah' => 'required',
            'deadline' => 'required|date',
            'waktu_deadline' => 'required',
            'status' => 'required',
        ]);

        $tuga->update($request->all());
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();
        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }
}
