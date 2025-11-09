@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Jadwal</h3>
    <a href="{{ route('schedules.create') }}" class="btn btn-success">Tambah Jadwal</a>
  </div>

  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>Judul</th>
        <th>Mata Kuliah</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
      <tr>
        <td>{{ $schedule->title }}</td>
        <td>{{ $schedule->course_name ?? '-' }}</td>
        <td>{{ $schedule->deadline?->format('Y-m-d H:i') ?? '-' }}</td>
        <td>{{ ucfirst(str_replace('_',' ', $schedule->status)) }}</td>
        <td class="d-flex gap-1">
          <a href="{{ route('schedules.show', $schedule) }}" class="btn btn-outline-info btn-sm">
            Lihat
          </a>
          <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-outline-warning btn-sm">
            Edit
          </a>
          <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
