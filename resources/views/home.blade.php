@extends('layouts.app')

@section('content')
<div class="py-4">
  {{-- Header kecil --}}
  <div class="mb-3">
    <h1 class="h4 mb-1">Ringkasan</h1>
    <p class="text-muted mb-0">Ikhtisar cepat progres dan tenggat tugas Anda.</p>
  </div>

  {{-- Kartu metrik --}}
  <div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Mata Kuliah</div>
          <div class="h4 m-0">{{ $totalCourses }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Total Tugas</div>
          <div class="h4 m-0">{{ $totalTasks }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Selesai</div>
          <div class="h4 m-0">{{ $doneTasks }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Belum Selesai</div>
          <div class="h4 m-0">{{ $pendingTasks }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Progress --}}
  <div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title m-0">Progress Tugas</h5>
        <span class="small text-muted">{{ $progressPercent }}%</span>
      </div>
      <div class="progress" role="progressbar" aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" style="width: {{ $progressPercent }}%"></div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    {{-- Due soon --}}
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title">Jatuh Tempo 7 Hari</h5>
          @if($dueSoon->isEmpty())
            <p class="text-muted mb-0">Tidak ada tugas dalam 7 hari ke depan.</p>
          @else
            <ul class="list-group list-group-flush">
              @foreach($dueSoon as $t)
                <li class="list-group-item px-0">
                  <div class="d-flex justify-content-between">
                    <div>
                      <div class="fw-semibold">{{ $t->title }}</div>
                      <div class="small text-muted">
                        {{ $t->course?->name ?? '—' }} •
                        Deadline: {{ optional($t->deadline)->format('d M Y H:i') ?? '-' }}
                      </div>
                    </div>
                    <div class="text-end">
                      <a href="{{ url('/tugas/'.$t->id.'/edit') }}" class="btn btn-sm btn-outline-primary">Ubah</a>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>

    {{-- Overdue --}}
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title">Terlambat</h5>
          @if($overdue->isEmpty())
            <p class="text-muted mb-0">Tidak ada tugas terlambat 🎉</p>
          @else
            <ul class="list-group list-group-flush">
              @foreach($overdue as $t)
                <li class="list-group-item px-0">
                  <div class="d-flex justify-content-between">
                    <div>
                      <div class="fw-semibold">{{ $t->title }}</div>
                      <div class="small text-muted">
                        {{ $t->course?->name ?? '—' }} •
                        Deadline: {{ optional($t->deadline)->format('d M Y H:i') ?? '-' }}
                      </div>
                    </div>
                    <div class="text-end">
                      <a href="{{ url('/tugas/'.$t->id.'/edit') }}" class="btn btn-sm btn-outline-danger">Tandai / Ubah</a>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>

    {{-- Recent --}}
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0">Terbaru Dibuat</h5>
            <div class="d-flex gap-2">
              <a href="{{ url('/tugas/create') }}" class="btn btn-sm btn-primary">Tambah Tugas</a>
              <a href="{{ route('mata-kuliah.index') }}" class="btn btn-sm btn-outline-secondary">Kelola Mata Kuliah</a>
            </div>
          </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Judul</th>
                  <th>Mata Kuliah</th>
                  <th>Deadline</th>
                  <th>Status</th>
                  <th width="120">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recent as $t)
                  <tr>
                    <td>{{ $t->title }}</td>
                    <td>{{ $t->course?->name ?? '—' }}</td>
                    <td>{{ optional($t->deadline)->format('d M Y H:i') ?? '-' }}</td>
                    <td>
                      <span class="badge {{ $t->status === 'done' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($t->status) }}
                      </span>
                    </td>
                    <td>
                      <div class="d-flex gap-2">
                        <a href="{{ url('/tugas/'.$t->id.'/edit') }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        {{-- Sesuaikan dengan route destroy tugas kalau ada --}}
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="text-center text-muted">Belum ada tugas.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
