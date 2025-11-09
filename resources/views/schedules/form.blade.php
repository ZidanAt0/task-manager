<div class="mb-3">
  <label>Judul</label>
  <input type="text" name="title" class="form-control"
         value="{{ old('title', $schedule->title ?? '') }}" required>
</div>

<div class="mb-3">
  <label>Mata Kuliah</label>
  <input type="text" name="course_name" class="form-control"
         value="{{ old('course_name', $schedule->course_name ?? '') }}">
</div>

<div class="mb-3">
  <label>Deskripsi</label>
  <textarea name="description" class="form-control" rows="4">{{ old('description', $schedule->description ?? '') }}</textarea>
</div>

{{-- Deadline: Pisahkan Tanggal dan Waktu --}}
@php
  $deadlineDate = isset($schedule->deadline) ? $schedule->deadline->format('Y-m-d') : '';
  $deadlineTime = isset($schedule->deadline) ? $schedule->deadline->format('H:i') : '';
@endphp

<div class="row mb-3">
  <div class="col-md-6">
    <label>Tanggal Deadline</label>
    <input type="date" name="deadline_date" class="form-control"
           value="{{ old('deadline_date', $deadlineDate) }}">
  </div>
  <div class="col-md-6">
    <label>Waktu Deadline</label>
    <input type="time" name="deadline_time" class="form-control"
           value="{{ old('deadline_time', $deadlineTime) }}">
  </div>
</div>

{{-- Dropdown Status --}}
<div class="mb-3">
  <label>Status</label>
  <select name="status" class="form-select">
    @foreach(['todo'=>'Belum Dikerjakan','in_progress'=>'Sedang Dikerjakan','done'=>'Selesai'] as $key => $label)
      <option value="{{ $key }}" {{ old('status', $schedule->status ?? 'todo') == $key ? 'selected' : '' }}>
        {{ $label }}
      </option>
    @endforeach
  </select>
</div>
