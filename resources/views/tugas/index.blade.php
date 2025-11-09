@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 m-0">📚 Daftar Tugas Kuliah</h1>
        <a href="{{ route('tugas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Tugas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Tanggal Deadline</th>
                            <th scope="col">Waktu Deadline</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $t->judul }}</td>
                                <td>{{ $t->mata_kuliah }}</td>
                                <td>{{ \Carbon\Carbon::parse($t->deadline)->format('d M Y') }}</td>
                                <td>{{ $t->waktu_deadline }}</td>
                                <td>
                                    <span class="badge {{ $t->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('tugas.edit', $t->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('tugas.destroy', $t->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Yakin hapus tugas ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-clipboard-x fs-3 d-block mb-2"></i>
                                    Belum ada tugas yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection
