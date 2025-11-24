@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Galeri Destinasi</h2>
    <p class="text-center text-muted">Jelajahi berbagai destinasi menakjubkan di seluruh Indonesia</p>

    <div class="row g-4 mt-2">
        @foreach($destinations as $destination)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ $destination->image_url }}" class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-{{ $destination->category == 'pulau' ? 'primary' : ($destination->category == 'gunung' ? 'success' : ($destination->category == 'diving' ? 'info' : 'warning')) }} mb-2">
                        {{ ucfirst($destination->category) }}
                    </span>
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    @if($destination->description)
                        <p class="card-text text-muted small">{{ Str::limit($destination->description, 100) }}</p>
                    @endif
                    <div class="mt-auto">
                        <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-outline-primary btn-sm">Jelajahi</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection