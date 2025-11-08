@extends('layouts.app')

@section('content')
  <div class="py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h1 class="h4 m-0">Dashboard</h1>
    </div>

    <div class="row g-3">
      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title mb-1">Welcome 👋</h5>
            <p class="text-muted mb-0">
              Ini kerangka awal aplikasi. Nanti di sini kita tampilkan ringkasan tugas,
              due terdekat, dsb.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title">Getting Started</h5>
            <ol class="mb-0">
              <li>Tambahkan mata kuliah di menu <strong>Courses</strong>.</li>
              <li>Buat tugas di menu <strong>Tasks</strong>.</li>
              <li>Nanti deskripsi tugas akan <strong>terenkripsi</strong> otomatis.</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
