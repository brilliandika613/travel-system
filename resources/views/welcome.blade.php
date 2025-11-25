@extends('layouts.app')

@section('content')
<body>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-overlay">
        <h1 class="display-4">Jelajahi Keindahan Indonesia</h1>
        <p class="lead">Temukan pengalaman perjalanan tak terlupakan ke destinasi terbaik di Indonesia</p>
        <a href="#tours" class="btn btn-light btn-lg mt-3">Lihat Paket Tour</a>
    </div>
</section>

<!-- Paket Tour -->
<section id="tours" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
        <span class="badge bg-primary mb-3">Paket Tour Terbaik</span>
        <h5>Paket Tour Pilihan</h5>
        <p class="text-muted">Nikmati pengalaman perjalanan tak terlupakan dengan paket tour terbaik kami</p>
        </div>

        <div class="row g-4">
            @foreach($tours as $tour)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $tour->image_url ? asset('storage/' . $tour->image_url) : 'https://via.placeholder.com/400x300?text=' . urlencode($tour->name) }}" 
                         class="card-img-top" alt="{{ $tour->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5>{{ $tour->name }}</h5>
                        <p><small>{{ $tour->location }}</small></p>
                        <p>Rp {{ number_format($tour->price, 0, ',', '.') }}/orang</p>
                        <a href="{{ route('tours.show', $tour->slug) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('tours.index') }}" class="btn btn-outline-primary">Lihat Semua Paket</a>
        </div>
    </div>
</section>

<!-- Galeri Destinasi -->
<section id="destinasi" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-3">Galeri Destinasi</span>
            <h5>Destinasi Populer</h5>
            <p class="text-muted">Jelajahi berbagai destinasi menakjubkan di seluruh Indonesia</p>
        </div>

        <div class="row g-4">
            @foreach($destinations as $destination)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    <img src="{{ $destination->image_url }}" 
                         class="card-img-top" 
                         alt="{{ $destination->name }}"
                         style="height: 300px; object-fit: cover;">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="text-white mb-1">{{ $destination->name }}</h5>
                        <p class="text-white small mb-0">{{ $destination->category ?? 'Destinasi' }}</p>
                    </div>
                    <!-- Optional: Link ke detail -->
                    <a href="/destinasi/{{ $destination->slug }}" class="stretched-link"></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimoni Carousel - Desain Minimalis -->
<section id="testimonials" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-3">Testimoni</span>
            <h5>Apa Kata Mereka?</h5>
            <p class="text-muted">Dengarkan pengalaman pelanggan kami yang telah menikmati perjalanan bersama Meity Travel</p>
        </div>

        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($testimonials as $index => $testimonial)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm border-0 p-4">
                                <div class="d-flex align-items-start">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0 me-3">
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px; font-size: 1.1rem;">
                                            {{ substr($testimonial->name, 0, 1) }}
                                        </div>
                                    </div>

                                    <!-- Konten -->
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">{{ $testimonial->name }}</h5>
                                        <p class="text-muted mb-2">{{ $testimonial->city }}</p>
                                        <div class="mb-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                        <blockquote class="mb-3">
                                            “{{ $testimonial->comment }}”
                                        </blockquote>
                                        <a href="/paket-tour/{{ $testimonial->tour->slug ?? '#' }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            {{ $testimonial->tour->name ?? 'Paket Tour' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigasi Titik & Panah -->
            <div class="text-center mt-4">
                <!-- Titik Indikator -->
                <div class="d-flex justify-content-center mb-3">
                    @foreach($testimonials as $index => $testimonial)
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}" 
                            class="mx-1 rounded-circle {{ $index == 0 ? 'bg-primary' : 'bg-secondary' }}" 
                            style="width: 10px; height: 10px; padding: 0;"></button>
                    @endforeach
                </div>

                <!-- Panah Kiri & Kanan -->
                
            </div>
        </div>
    </div>
</section>
@endsection