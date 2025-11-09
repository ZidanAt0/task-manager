@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 m-0">Mata Kuliah</h1>
  <a class="btn btn-primary" href="{{ route('mata-kuliah.create') }}">Tambah</a>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-auto">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama/kode/dosen...">
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-secondary">Cari</button>
  </div>
</form>

<div class="card shadow-sm border-0">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Nama</th>
          <th>Kode</th>
          <th>Dosen Pengampu</th>
          <th>Semester</th>
          <th width="160">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($courses as $c)
          <tr>
            <td>{{ $c->name }}</td>
            <td>{{ $c->code ?? '—' }}</td>
            <td>{{ $c->dosen_pengampu }}</td>
            <td>{{ $c->semester }}</td>
            <td class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('mata-kuliah.edit', $c->id) }}">Edit</a>
              <form method="POST" action="{{ route('mata-kuliah.destroy', $c->id) }}" onsubmit="return confirm('Hapus mata kuliah ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $courses->links() }}
</div>
@endsection
