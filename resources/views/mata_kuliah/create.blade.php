@extends('layouts.app')

@section('content')
  <h1 class="h4 mb-3">Tambah Mata Kuliah</h1>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form method="POST" action="{{ route('mata-kuliah.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama Mata Kuliah</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Kode (opsional)</label>
          <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror">
          @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Dosen Pengampu</label>
          <input type="text" name="dosen_pengampu" value="{{ old('dosen_pengampu') }}" class="form-control @error('dosen_pengampu') is-invalid @enderror">
          @error('dosen_pengampu') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Semester</label>
          <input type="number" name="semester" min="1" max="8" value="{{ old('semester') }}" class="form-control @error('semester') is-invalid @enderror">
          @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary">Simpan</button>
          <a href="{{ route('mata-kuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
@endsection
