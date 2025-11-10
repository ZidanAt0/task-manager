@extends('layouts.app')

@section('content')
<div class="py-4">
  {{-- Hero / Welcome --}}
  <div class="p-4 p-md-5 mb-4 bg-white rounded-3 border shadow-sm">
    <div class="container-narrow px-0">
      <h1 class="display-6 fw-bold mb-2 gradient-title">Selamat datang di College Task Manager</h1>
      <p class="text-muted mb-0">
        Catat tugas kuliah, kelola deadline, dan tandai progres dengan mudah.
      </p>
    </div>
  </div>

  <div class="row g-3">
    {{-- Petunjuk penggunaan --}}
    <div class="col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title mb-3">Cara menggunakan</h5>
          <ol class="mb-0">
            <li>Buka menu <strong>Mata Kuliah</strong> dan tambahkan daftar mata kuliah Anda.</li>
            <li>Buka menu <strong>Tugas</strong> lalu klik <em>Tambah</em>, pilih mata kuliah terkait.</li>
            <li>Isi <strong>judul</strong>, <strong>deadline</strong>, dan <strong>status</strong> (Pending/Done).</li>
            <li>Pakai kolom <strong>cari</strong> untuk memfilter data dengan cepat.</li>
          </ol>
        </div>
      </div>
    </div>

    {{-- Tautan cepat + Catatan --}}
    <div class="col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title mb-3">Tautan cepat</h5>
          <div class="d-grid d-sm-flex gap-2">
            <a href="{{ route('mata-kuliah.index') }}" class="btn btn-primary">
              Kelola Mata Kuliah
            </a>
            <a href="{{ url('/tugas') }}" class="btn btn-outline-primary">
              Kelola Tugas
            </a>
            <a href="{{ url('/tugas/create') }}" class="btn btn-outline-secondary">
              Tambah Tugas
            </a>
          </div>
          <hr>
          <p class="small text-muted mb-0">
            Catatan: deskripsi tugas dienkripsi di database untuk menjaga privasi Anda.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
