@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ $tour->image_url }}" class="img-fluid rounded mb-4" alt="{{ $tour->name }}">
            <h2>{{ $tour->name }}</h2>
            <p class="text-muted">
                <i class="fas fa-map-marker-alt me-2"></i> {{ $tour->location }} |
                <i class="far fa-clock me-2"></i> {{ $tour->duration_days }} Hari {{ $tour->duration_nights }} Malam |
                <i class="fas fa-users me-2"></i> Min. {{ $tour->min_people }} Orang
            </p>
            @if($tour->type === 'international')
              <div class="alert alert-danger py-1 mb-2 text-center">
                  <i class="fas fa-passport me-1"></i>
                  <strong>Dibutuhkan Passport</strong>
              </div>
            @endif
            <div class="mb-4">
                <h5>Deskripsi</h5>
                <p>{{ $tour->description }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-star text-warning me-1"></i>
                        {{ $tour->rating }} <small>({{ $tour->reviews_count }} ulasan)</small>
                    </div>
                    <h4 class="text-primary text-center">Rp {{ number_format($tour->price, 0, ',', '.') }}<br><small>/ orang</small></h4>
                    <hr>
                    @auth
                        <a href="{{ route('booking.create', $tour->slug) }}" class="btn btn-success w-100">Pesan Sekarang</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Login untuk Pesan</a>
                    @endauth
                    <hr>
                    @auth
                    <div class="mt-4">
                        <a href="{{ route('testimonials.create', $tour->slug) }}" class="btn btn-outline-primary">Beri Ulasan</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection