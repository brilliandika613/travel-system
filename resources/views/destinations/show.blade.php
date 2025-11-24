@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ $destination->image_url }}" class="img-fluid rounded mb-4" alt="{{ $destination->name }}">
            <h2>{{ $destination->name }}</h2>
            <span class="badge bg-secondary mb-3">{{ ucfirst($destination->category) }}</span>
            <p>{{ $destination->description }}</p>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Paket Tour Tersedia</h5>
                    <p>Temukan paket tour ke {{ $destination->name }} yang sesuai dengan gaya perjalananmu.</p>
                    <a href="{{ route('tours.index') }}" class="btn btn-primary">Lihat Paket Tour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection