@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Apa Kata Pelanggan Kami?</h2>
    <p class="text-center text-muted">Dengarkan pengalaman pelanggan kami yang telah menikmati perjalanan bersama Meity Travel</p>

    <div class="row g-4 mt-2">
        @forelse($testimonials as $testimonial)
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            {{ substr($testimonial->name, 0, 1) }}
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $testimonial->name }}</h5>
                            <p class="text-muted mb-0">{{ $testimonial->city }}</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                    </div>
                    <p class="mb-2">{{ $testimonial->comment }}</p>
                    <span class="badge bg-primary">{{ $testimonial->tour->name }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>Belum ada testimoni.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $testimonials->links() }}
    </div>
</div>
@endsection