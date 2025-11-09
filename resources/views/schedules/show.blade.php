@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3>{{ $schedule->title }}</h3>
  <p><strong>Mata Kuliah:</strong> {{ $schedule->course_name ?? '-' }}</p>
  <p><strong>Deadline:</strong> {{ $schedule->deadline?->format('Y-m-d H:i') ?? '-' }}</p>
  <p><strong>Status:</strong> {{ ucfirst(str_replace('_',' ', $schedule->status)) }}</p>
  <p><strong>Deskripsi:</strong></p>
  <div class="border p-3">{{ $schedule->description }}</div>

  <a href="{{ route('schedules.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
