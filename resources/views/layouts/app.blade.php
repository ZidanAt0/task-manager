<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'College Task Manager' }}</title>

  <!-- Bootstrap, Icons, dan Font -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ===== GLOBAL ===== */
    body {
      background: linear-gradient(135deg, #7AA6F9 0%, #C084FC 100%);
      background-attachment: fixed;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .gradient-title {
      background: linear-gradient(90deg, #C084FC, #7AA6F9, #60A5FA);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
    }

    /* ===== NAVBAR ===== */
    .navbar {
      background: rgba(255, 255, 255, 0.15) !important;
      backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.25);
      padding: 0.8rem 0;
    }
    .navbar-brand {
      font-weight: 700;
      color: #fff !important;
      letter-spacing: 0.5px;
    }
    .nav-link {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 500;
      margin: 0 6px;
      transition: 0.3s;
    }
    .nav-link:hover, .nav-link.active {
      color: #fff !important;
      text-shadow: 0 0 10px rgba(255,255,255,0.6);
    }

    /* ===== BUTTONS ===== */
    .btn-primary {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 10px;
      transition: 0.3s ease;
    }
    .btn-primary:hover {
      opacity: 0.9;
      transform: scale(1.04);
    }
    .btn-outline-light {
      border-radius: 10px;
      border-color: rgba(255,255,255,0.8);
      color: #fff;
    }
    .btn-outline-light:hover {
      background: rgba(255,255,255,0.85);
      color: #2575fc;
    }

    /* ===== CARD GLASS ===== */
    .card {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(15px);
      border-radius: 18px;
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #fff;
      box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    /* ===== CONTAINER ===== */
    .container-narrow { max-width: 960px; }

    /* ===== FLASH MESSAGE ===== */
    .alert {
      border-radius: 16px;
      backdrop-filter: blur(10px);
      border: none;
      color: #fff;
      text-align: center;
    }
    .alert-success { background: rgba(46, 204, 113, 0.85); }
    .alert-danger { background: rgba(231, 76, 60, 0.85); }

    /* ===== FOOTER ===== */
    footer {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
      color: rgba(255,255,255,0.85);
      text-align: center;
      font-size: 0.9rem;
      padding: 1rem 0;
      margin-top: auto;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* ===== SCROLLBAR ===== */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.4);
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      .nav-link { margin: 4px 0; }
      .btn-primary, .btn-outline-light { font-size: 0.85rem; }
    }
  </style>
</head>

<body>
  <!-- ===== NAVBAR ===== -->
  <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
    <div class="container container-narrow">
      <a class="navbar-brand" href="{{ url('/') }}">CTM</a>

      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('tugas*') ? 'active' : '' }}" href="{{ url('/tugas') }}">Tugas</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('mata-kuliah*') ? 'active' : '' }}" href="{{ route('mata-kuliah.index') }}">Mata Kuliah</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('schedules*') ? 'active' : '' }}" href="{{ url('/schedules') }}">Jadwal</a></li>
        </ul>

        <div class="d-flex gap-2 align-items-center">
          @auth
            <span class="small text-white">Hi, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
          @else
            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- ===== FLASH MESSAGE ===== -->
  <div class="container container-narrow mt-4">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
  </div>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="container container-narrow py-4">
    @yield('content')
  </div>

  <!-- ===== FOOTER ===== -->
  <footer>
    <p class="mb-0">© {{ date('Y') }} College Task Manager — All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
