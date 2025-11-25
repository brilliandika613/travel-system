<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: #1a1a2e;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #16213e;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card-header {
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="text-center mb-4">
        <h5>MEITY TRAVEL</h5>
        <small>Admin Panel</small>
    </div>
    <hr>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
    <a href="{{ route('admin.tours.index') }}" class="{{ request()->routeIs('tours.*') ? 'active' : '' }}">
        <i class="fas fa-box me-2"></i> Paket Tour
    </a>
    <a href="{{ route('destinations.index') }}" class="{{ request()->routeIs('destinations.*') ? 'active' : '' }}">
        <i class="fas fa-mountain me-2"></i> Destinasi
    </a>
    <a href="{{ route('testimonials.index') }}" class="{{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
        <i class="fas fa-comment me-2"></i> Testimoni
    </a>
    <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check me-2"></i> Booking
    </a>
    <a href="{{ route('photos.index') }}" class="{{ request()->routeIs('photos.*') ? 'active' : '' }}">
        <i class="fas fa-images me-2"></i> Galeri Foto
    </a>
    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
        <i class="fas fa-file-alt me-2"></i> Laporan
    </a>
    <a href="{{ route('settings.edit') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
        <i class="fas fa-cog me-2"></i> Pengaturan
    </a>
    <hr>
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn text-white w-100 text-start">
            <i class="fas fa-sign-out-alt me-2"></i> Keluar
        </button>
    </form>
</div>

<!-- Main Content -->
<div class="content">
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container-fluid">
            <h4>@yield('title')</h4>
            <span class="text-muted">Halo, {{ Auth::user()->name }} (Admin)</span>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>