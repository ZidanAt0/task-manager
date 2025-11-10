<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TugasController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    public function index()
    {
        $tugas = Tugas::forUser(auth()->id())->with('course')->latest()->get();
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        $courses = Course::forUser(auth()->id())
            ->orderBy('name')
            ->get(['id','name','semester','dosen_pengampu']);

        return view('tugas.create', [
            'title'   => 'Tambah Tugas • CTM',
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        // VALIDASI: samakan dengan field pada form tugas.create
        $data = $request->validate([
            'title'          => ['required','string','max:150'],
            'course_id'      => ['required','exists:courses,id'],
            'deadline_date'  => ['nullable','date'],
            'deadline_time'  => ['nullable','date_format:H:i'],
            'status'         => ['required','in:pending,done,Belum Selesai,Selesai'],
            'description'    => ['nullable','string'],
        ]);

        // Gabungkan tanggal + jam → kolom 'deadline'
        $deadline = null;
        if ($request->filled('deadline_date')) {
            $deadline = Carbon::createFromFormat(
                'Y-m-d H:i',
                $data['deadline_date'].' '.($data['deadline_time'] ?? '00:00')
            );
        }

        // PETA status agar cocok dengan CHECK constraint di DB
        $mapToDb = [
            'pending'        => 'Belum Selesai',
            'done'           => 'Selesai',
            'Belum Selesai'  => 'Belum Selesai',
            'Selesai'        => 'Selesai',
        ];
        $statusDb = $mapToDb[$data['status']] ?? 'Belum Selesai';

        // SIMPAN — skema DB kamu pakai kolom 'judul' (bukan 'title')
        Tugas::create([
            'user_id'     => auth()->id(),
            'course_id'   => $data['course_id'],
            'judul'       => $data['title'],                // ← map ke kolom DB
            'description' => $data['description'] ?? null,  // terenkripsi via cast
            'deadline'    => $deadline,
            'status'      => $statusDb,
        ]);

        return redirect()->route('tugas.index')->with('success','Tugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tugas   = Tugas::forUser(auth()->id())->findOrFail($id);
        $courses = Course::forUser(auth()->id())->orderBy('name')
                   ->get(['id','name','semester','dosen_pengampu']);

        return view('tugas.edit', compact('tugas','courses') + ['title' => 'Edit Tugas • CTM']);
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::forUser(auth()->id())->findOrFail($id);

        $data = $request->validate([
            'title'          => ['required','string','max:150'],
            'course_id'      => ['required','exists:courses,id'],
            'deadline_date'  => ['nullable','date'],
            'deadline_time'  => ['nullable','date_format:H:i'],
            'status'         => ['required','in:pending,done,Belum Selesai,Selesai'],
            'description'    => ['nullable','string'],
        ]);

        $deadline = null;
        if ($request->filled('deadline_date')) {
            $deadline = Carbon::createFromFormat(
                'Y-m-d H:i',
                $data['deadline_date'].' '.($data['deadline_time'] ?? '00:00')
            );
        }

        $mapToDb = [
            'pending'        => 'Belum Selesai',
            'done'           => 'Selesai',
            'Belum Selesai'  => 'Belum Selesai',
            'Selesai'        => 'Selesai',
        ];
        $statusDb = $mapToDb[$data['status']] ?? 'Belum Selesai';

        $tugas->update([
            'course_id'   => $data['course_id'],
            'judul'       => $data['title'],                // ← map ke kolom DB
            'description' => $data['description'] ?? null,
            'deadline'    => $deadline,
            'status'      => $statusDb,
        ]);

        return redirect()->route('tugas.index')->with('success','Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();
        return redirect()->route('tugas.index')->with('success','Tugas berhasil dihapus.');
    }
}
