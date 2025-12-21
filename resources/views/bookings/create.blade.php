@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Pesan: {{ $tour->name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Harga per orang:</strong> Rp {{ number_format($tour->price, 0, ',', '.') }}</p>
                    <form method="POST" action="{{ route('booking.store', $tour->slug) }}">
                        @csrf
                        <input name="tour_id" type="hidden" value="{{$tour->id}}">
                        <div class="mb-3">
                            <label>Tanggal Keberangkatan</label>
                            <input type="date" name="departure_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="mb-3">
                            <label>Jumlah Peserta</label>
                            <input type="number" name="participants" class="form-control" min="1" max="100" value="1" required>
                        </div>
                        <div class="mb-3">
                            <strong>Total:</strong> <span id="total">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Lanjut ke Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="participants"]').addEventListener('input', function() {
        const price = parseFloat("{{ $tour->price }}");
        const total = price * this.value;
        document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
@endsection