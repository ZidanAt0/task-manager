@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3>Edit Jadwal</h3>
  <form action="{{ route('schedules.update', $schedule) }}" method="POST">
    @csrf
    @method('PUT')
    @include('schedules.form')
    <button class="btn btn-success">Update</button>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
