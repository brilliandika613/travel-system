@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h6>Paket Tour</h6>
                <h3>{{ $totalTours }}</h3>
                <i class="fas fa-box float-end"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6>Destinasi</h6>
                <h3>{{ $totalDestinations }}</h3>
                <i class="fas fa-mountain float-end"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6>Testimoni</h6>
                <h3>{{ $totalTestimonials }}</h3>
                <i class="fas fa-comment float-end"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body text-center">
        <h5>Data Kosong</h5>
    </div>
</div>
@endsection