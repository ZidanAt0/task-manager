@extends('layouts.app')
@section('content')
  <h1 class="h4">Home (Protected)</h1>
  <p>Hanya user yang login yang bisa melihat halaman ini.</p>

  <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button class="btn btn-outline-danger btn-sm">Logout</button>
</form>

@endsection
