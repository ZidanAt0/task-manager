@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="text-center mb-4" style="font-family: 'Segoe Script', cursive;">📚 Jadwal Semester 5</h3>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle shadow-sm">
      <thead class="table-secondary">
        <tr class="align-middle">
          <th style="width: 12%;">Waktu</th>
          <th>Senin</th>
          <th>Selasa</th>
          <th>Rabu</th>
          <th>Kamis</th>
          <th>Jumat</th>
        </tr>
      </thead>
      <tbody>
        @php
          // Daftar jam pelajaran
          $timeSlots = [
            '07:00 - 09:30',
            '09:30 - 12:00',
            '13:00 - 15:30',
            '15:50 - 17:30'
          ];
          $days = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        @endphp

        @foreach($timeSlots as $time)
          <tr>
            <th class="table-light">{{ $time }}</th>

            @foreach($days as $day)
              @php
                // Cek apakah ada jadwal pada hari dan jam ini
                $entry = collect($schedules[$day] ?? [])->firstWhere('jam', $time);
              @endphp

              @if($entry)
                <td>
                  <strong>{{ $entry['mata_kuliah'] }}</strong><br>
                  <small class="text-muted">{{ $entry['ruangan'] }}</small>
                </td>
              @else
                <td class="bg-light">—</td>
              @endif
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
