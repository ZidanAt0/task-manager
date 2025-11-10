@extends('layouts.app')

@section('content')
<div class="py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 m-0 text-gradient">📚 Daftar Tugas Kuliah</h1>
    <a href="{{ route('tugas.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Tugas
    </a>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          {{-- 🔮 HEADER UNGU GRADIENT --}}
          <thead class="text-white table-header-ungu">
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
          @forelse ($tugas as $t)
            @php
              $isDone = in_array($t->status, ['Selesai','done']);
              $deadDT = $t->deadline
                        ? $t->deadline->timezone(config('app.timezone'))
                        : null;
            @endphp

            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="fw-semibold">{{ $t->judul }}</td>
              <td>{{ $t->course->name ?? '—' }}</td>
              <td>{{ $deadDT ? $deadDT->format('d M Y') : '—' }}</td>
              <td>{{ $deadDT ? $deadDT->format('H:i')   : '—' }}</td>

              <td>
                <span class="badge {{ $isDone ? 'bg-success' : 'bg-warning text-dark' }}">
                  {{ $isDone ? 'Selesai' : 'Belum Selesai' }}
                </span>
              </td>

              <td>
                <a href="{{ route('tugas.edit', $t->id) }}"
                   class="btn btn-sm btn-outline-primary me-1">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>

                <form action="{{ route('tugas.destroy', $t->id) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus tugas ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger">
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

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

{{-- 🌈 Style tambahan --}}
<style>
  /* Header tabel ungu gradasi */
  .table-header-ungu {
    background: linear-gradient(90deg, #8B5CF6 0%, #A78BFA 100%);
  }

  /* Supaya sudut atas tabel halus */
  .table-header-ungu th:first-child {
  }
  .table-header-ungu th:last-child {
  }

  /* Hover lembut untuk baris tabel */
  tbody tr:hover {
    background-color: rgba(139, 92, 246, 0.08);
  }
</style>
@endsection
