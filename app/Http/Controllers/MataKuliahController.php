<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;

class MataKuliahController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index(Request $r)
    {
        $q = $r->query('q');

        $courses = Course::forUser(auth()->id())
            ->when($q, fn($qr) => $qr->where(function($w) use($q){
                // Postgres case-insensitive search
                $w->where('name','ilike',"%$q%")
                  ->orWhere('code','ilike',"%$q%")
                  ->orWhere('dosen_pengampu','ilike',"%$q%");
            }))
            ->orderBy('semester')->orderBy('name')
            ->paginate(10)->withQueryString();

        return view('mata_kuliah.index', [
            'title'   => 'Mata Kuliah • CTM',
            'courses' => $courses,
            'q'       => $q,
        ]);
    }

    public function create()
    {
        return view('mata_kuliah.create', ['title' => 'Tambah Mata Kuliah • CTM']);
    }

    public function store(StoreMataKuliahRequest $request)
    {
        Course::create($request->validated() + ['user_id' => auth()->id()]);

        return redirect()->route('mata-kuliah.index')
            ->with('success','Mata kuliah berhasil ditambahkan.');
    }

    public function edit($course)
    {
        $course = Course::forUser(auth()->id())->findOrFail($course);

        return view('mata_kuliah.edit', [
            'title'  => 'Edit Mata Kuliah • CTM',
            'course' => $course,
        ]);
    }

    public function update(UpdateMataKuliahRequest $request, $course)
    {
        $course = Course::forUser(auth()->id())->findOrFail($course);

        $course->update($request->validated());

        return redirect()->route('mata-kuliah.index')
            ->with('success','Mata kuliah berhasil diperbarui.');
    }

    public function destroy($course)
    {
        $course = Course::forUser(auth()->id())->findOrFail($course);
        $course->delete();

        return redirect()->route('mata-kuliah.index')
            ->with('success','Mata kuliah dihapus.');
    }
}
