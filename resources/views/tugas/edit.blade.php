@extends('layouts.app')

@section('content')
<h1 class="h4 mb-3">Edit Tugas</h1>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
  </div>
@endif

@php
  $d = optional($tugas->deadline);
  $deadlineDate = old('deadline_date', $tugas->deadline ? $tugas->deadline->format('Y-m-d') : null);
  $deadlineTime = old('deadline_time', $tugas->deadline ? $tugas->deadline->format('H:i') : null);
@endphp

<div class="card border-0 shadow-sm">
  <div class="card-body">
    <form method="POST" action="{{ route('tugas.update', $tugas->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Judul Tugas</label>
        <input type="text" name="title" value="{{ old('title', $tugas->title) }}"
               class="form-control @error('title') is-invalid @enderror" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Mata Kuliah</label>
        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
          <option value="" hidden>Pilih mata kuliah...</option>
          @foreach ($courses as $c)
            <option value="{{ $c->id }}" @selected(old('course_id', $tugas->course_id) == $c->id)>
              {{ $c->name }} (S{{ $c->semester }}) — {{ $c->dosen_pengampu }}
            </option>
          @endforeach
        </select>
        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi / Catatan</label>
        <textarea name="description" rows="4"
          class="form-control @error('description') is-invalid @enderror">{{ old('description', $tugas->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Tanggal Deadline</label>
          <input type="date" name="deadline_date" value="{{ $deadlineDate }}"
                 class="form-control @error('deadline_date') is-invalid @enderror">
          @error('deadline_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Waktu Deadline</label>
          <input type="time" name="deadline_time" value="{{ $deadlineTime }}"
                 class="form-control @error('deadline_time') is-invalid @enderror">
          @error('deadline_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="mb-3 mt-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
          <option value="Belum Selesai"
            @selected(old('status', $tugas->status) == 'Belum Selesai' || old('status', $tugas->status) == 'pending')>
            Belum Selesai
          </option>
          <option value="Selesai"
            @selected(old('status', $tugas->status) == 'Selesai' || old('status', $tugas->status) == 'done')>
            Selesai
          </option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('tugas.index') }}" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
