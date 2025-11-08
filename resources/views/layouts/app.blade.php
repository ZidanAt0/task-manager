<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'College Task Manager' }}</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">

  <style>
    body { background: #f7f8fa; }
    .navbar-brand { font-weight: 700; letter-spacing:.3px; }
    .container-narrow { max-width: 980px; }
  </style>
</head>

<body>
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container container-narrow">
      <a class="navbar-brand" href="{{ url('/') }}">CTM</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/courses') }}">Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/tasks') }}">Tasks</a></li>
        </ul>

        <div class="d-flex gap-2 align-items-center">
          @auth
            <span class="small text-muted">Hi, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
          @else
            <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Login</a>
            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>



  {{-- Flash message --}}
  <div class="container container-narrow mt-3">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
