@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Beri Ulasan untuk: {{ $tour->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('testimonials.store') }}">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                        <div class="mb-3">
                            <label>Kota Asal</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Rating</label><br>
                            <div class="rating" data-rating="0">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star" data-value="{{ $i }}">★</span>
                                @endfor
                            </div>
                        </div>

                        <!-- nilai rating akan disimpan di sini -->
                        <input type="hidden" name="rating" id="ratingValue" required>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');
    let selectedRating = 0;

    stars.forEach(star => {
        // Hover
        star.addEventListener('mouseover', function () {
            const value = this.dataset.value;
            highlightStars(value);
        });

        // Klik
        star.addEventListener('click', function () {
            selectedRating = this.dataset.value;
            ratingInput.value = selectedRating;
        });

        // Keluar hover
        star.addEventListener('mouseleave', function () {
            highlightStars(selectedRating);
        });
    });

    function highlightStars(value) {
        stars.forEach(star => {
            star.style.color = star.dataset.value <= value
                ? '#ffc107'
                : '#ddd';
        });
    }
});
</script>

@endsection