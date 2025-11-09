@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 m-0">📊 Dashboard</h1>
    </div>

    <div class="row g-3">
        <!-- Card Welcome -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title mb-2">Selamat Datang 👋</h5>
                    <p class="text-muted mb-0">Kelola dan pantau semua tugas Anda dengan mudah!</p>
                </div>
            </div>
        </div>

        <!-- Card Getting Started -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">Mulai Gunakan Aplikasi</h5>
                    <p class="text-muted mb-4">
                        Berikut langkah cepat untuk memulai mengelola tugas Anda:
                    </p>

                    <div class="row g-3">
                        <!-- Card ke Daftar Tugas -->
                        <div class="col-md-6">
                            <a href="{{ route('tugas.index') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 h-100 hover-card d-flex align-items-center">
                                    <div class="me-3 text-primary fs-3">
                                        <i class="bi bi-list-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Lihat Semua Tugas</h6>
                                        <p class="text-muted small mb-0">Pantau seluruh daftar tugas Anda.</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card ke Tambah Tugas -->
                        <div class="col-md-6">
                            <a href="{{ route('tugas.create') }}" class="text-decoration-none">
                                <div class="p-3 border rounded-3 h-100 hover-card d-flex align-items-center">
                                    <div class="me-3 text-success fs-3">
                                        <i class="bi bi-plus-circle"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Tambah Tugas Baru</h6>
                                        <p class="text-muted small mb-0">Buat dan atur jadwal tugas baru.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Daftar Tugas -->
    <div class="row g-3 mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="card-title m-0">📅 Daftar Tugas Terbaru</h5>
                        <a href="{{ route('tugas.index') }}" class="text-decoration-none small text-primary">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    @if(isset($tugas) && $tugas->isEmpty())
                        <p class="text-muted text-center my-4">
                            <i class="bi bi-clipboard-x fs-3 d-block mb-2"></i>
                            Belum ada tugas yang dibuat.
                        </p>
                    @elseif(isset($tugas))
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Mata Kuliah</th>
                                        <th>Deadline</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tugas->take(5) as $t)
                                        <tr>
                                            <td class="fw-semibold">{{ $t->judul }}</td>
                                            <td>{{ $t->mata_kuliah }}</td>
                                            <td>{{ \Carbon\Carbon::parse($t->deadline)->format('d M Y') }}</td>
                                            <td>{{ $t->waktu_deadline ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $t->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ ucfirst($t->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Efek Hover -->
<style>
.hover-card {
    transition: all 0.25s ease-in-out;
    background-color: #fff;
}
.hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection
