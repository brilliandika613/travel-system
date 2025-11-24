@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Beri Ulasan untuk: {{ $tour->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('testimonials.index') }}">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                        <div class="mb-3">
                            <label>Kota Asal</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Rating</label><br>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" style="font-size: 24px; cursor: pointer;">★</label>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Ulasan Anda</label>
                            <textarea name="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Kirim Ulasan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating input[type="radio"] {
    display: none;
}
.rating input[type="radio"]:checked ~ label,
.rating input[type="radio"]:hover ~ label {
    color: #ffc107;
}
.rating label {
    color: #ddd;
}
</style>
@endsection