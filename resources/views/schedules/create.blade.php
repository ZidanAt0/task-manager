@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3>Tambah Jadwal</h3>
  <form action="{{ route('schedules.store') }}" method="POST">
    @csrf
    @include('schedules.form')
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
