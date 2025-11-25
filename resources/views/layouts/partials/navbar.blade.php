
                
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">MEITY TRAVEL</a>

        <!-- Toggle untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}#home">Beranda</a>
                </li>

                <!-- Dropdown Paket Tour -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('paket-tour*') ? 'active' : '' }}" href="#" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Paket Tour
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('tours.byType', 'domestic') }}">
                                <i class="fas fa-map-marker-alt me-2"></i> Tour Domestik
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('tours.byType', 'international') }}">
                                <i class="fas fa-globe me-2"></i> Tour Internasional
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#destinasi">Destinasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#testimonials">Testimoni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.show') }}">Kontak</a>
                </li>
            </ul>

            <!-- Right Side: Auth -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Halo, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('booking.history') }}"><i class="fas fa-history me-2"></i> Riwayat</a></li>
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{route('dashboard')}}"><i class="fas fa-lock me-2"></i> Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-primary ms-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>        