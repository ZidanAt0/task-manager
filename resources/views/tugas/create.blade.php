@extends('layouts.app')

@section('content')
  <h1 class="h4 mb-3">Tambah Tugas Baru</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Periksa input:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form method="POST" action="{{ route('tugas.store') }}">
        @csrf

        {{-- Judul --}}
        <div class="mb-3">
          <label class="form-label">Judul Tugas</label>
          <input type="text" name="title"
                 class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title') }}" required autofocus>
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Mata Kuliah (Dropdown) --}}
        <div class="mb-3">
          <label class="form-label">Mata Kuliah</label>
          <select name="course_id"
                  class="form-select @error('course_id') is-invalid @enderror" required>
            <option value="" hidden>Pilih mata kuliah...</option>
            @foreach ($courses as $c)
              <option value="{{ $c->id }}" @selected(old('course_id')==$c->id)>
                {{ $c->name }} (S{{ $c->semester }}) — {{ $c->dosen_pengampu }}
              </option>
            @endforeach
          </select>
          @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Deskripsi / Catatan --}}
        <div class="mb-3">
          <label class="form-label">Deskripsi / Catatan</label>
          <textarea name="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Detail tugas, link referensi, catatan penting...">{{ old('description') }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Tanggal & Waktu deadline --}}
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Tanggal Deadline</label>
            <input type="date" name="deadline_date"
                   class="form-control @error('deadline_date') is-invalid @enderror"
                   value="{{ old('deadline_date') }}">
            @error('deadline_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Waktu Deadline</label>
            <input type="time" name="deadline_time"
                   class="form-control @error('deadline_time') is-invalid @enderror"
                   value="{{ old('deadline_time') }}">
            @error('deadline_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- Status --}}
        <div class="mb-3 mt-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Belum Selesai" @selected(old('status')=='Belum Selesai' || old('status')=='pending')>
              Belum Selesai
            </option>
            <option value="Selesai" @selected(old('status')=='Selesai' || old('status')=='done')>
              Selesai
            </option>
          </select>
          @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-success">Simpan</button>
          <a href="{{ route('tugas.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
