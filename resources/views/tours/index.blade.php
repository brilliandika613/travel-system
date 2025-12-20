@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Paket Tour</h2>
    <p class="text-center text-muted">Nikmati pengalaman perjalanan tak terlupakan ke destinasi terbaik di Indonesia</p>

    <!-- Tombol Toggle -->
    <div class="d-flex justify-content-center mb-4">
    <a href="{{ route('tours.byType', 'domestic') }}"
       class="btn {{ request()->is('paket-tour/kategori/domestic') ? 'btn-primary' : 'btn-outline-primary' }} me-2">
        📍 Tour Domestik
    </a>

    <a href="{{ route('tours.byType', 'international') }}"
       class="btn {{ request()->is('paket-tour/kategori/international') ? 'btn-primary' : 'btn-outline-primary' }}">
        🌐 Tour Internasional
    </a>
</div>

    <!-- Daftar Paket Tour -->
    <div id="tourContainer" class="row g-4 mt-2">
        @foreach($tours as $tour)
        <div class="col-md-4 tour-item" data-type="{{ $tour->type }}">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/image/' . $tour->name . '.jpg') }}" class="card-img-top" alt="{{ $tour->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-info mb-2">{{ ucfirst($tour->category) }}</span>
                    <h5 class="card-title">{{ $tour->name }}</h5>
                    <p class="text-muted small">
                        <i class="fas fa-map-marker-alt me-1"></i> {{ $tour->location }}<br>
                        <i class="far fa-clock me-1"></i> {{ $tour->duration_days }} Hari {{ $tour->duration_nights }} Malam<br>
                        <i class="fas fa-users me-1"></i> Min. {{ $tour->min_people }} Orang
                    </p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <i class="fas fa-star text-warning"></i> {{ $tour->rating }}
                                <small>({{ $tour->reviews_count }} ulasan)</small>
                            </div>
                            <div>
                                <strong>Mulai dari</strong><br>
                                <span class="text-primary fw-bold">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>/orang
                            </div>
                        </div>
                        <a href="{{ route('tours.show', $tour->slug) }}" class="btn btn-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnDomestic = document.getElementById('btnDomestic');
        const btnInternational = document.getElementById('btnInternational');
        const tourContainer = document.getElementById('tourContainer');

        // Fungsi filter berdasarkan type
        function filterTours(type) {
            const items = document.querySelectorAll('.tour-item');
            items.forEach(item => {
                if (type === 'all' || item.dataset.type === type) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Event listener untuk tombol
        btnDomestic.addEventListener('click', function() {
            btnDomestic.classList.add('active');
            btnInternational.classList.remove('active');
            filterTours('domestic');
        });

        btnInternational.addEventListener('click', function() {
            btnInternational.classList.add('active');
            btnDomestic.classList.remove('active');
            filterTours('international');
        });
    });
</script>
@endpush
@endsection
