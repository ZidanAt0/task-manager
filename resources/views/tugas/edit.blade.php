@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Tugas</h3>

    <form action="{{ route('tugas.update', $tuga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Tugas</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $tuga->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control" value="{{ $tuga->mata_kuliah }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="deadline" class="form-label">Tanggal Deadline</label>
                <input type="date" name="deadline" id="deadline" class="form-control" value="{{ $tuga->deadline }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="waktu_deadline" class="form-label">Waktu Deadline</label>
                <input type="time" name="waktu_deadline" id="waktu_deadline" class="form-control" value="{{ $tuga->waktu_deadline }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Belum Selesai" {{ $tuga->status == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="Selesai" {{ $tuga->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
