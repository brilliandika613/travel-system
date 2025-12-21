@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Konfirmasi Pembayaran</div>
                <div class="card-body">
                    <p><strong>Paket:</strong> {{ $booking->tour->name }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                    <hr>
                    <p><strong>Nama Bank:</strong>Bank Mandiri</p>
                    <p><strong>Nomor Rekening:</strong>234523452</p>
                    <p><strong>Alias:</strong>Brilian Brian Aditya</p>
                    <form method="POST" action="{{ route('booking.upload-proof', $booking->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Upload Bukti Pembayaran (Max 2MB)</label>
                            <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Bukti</button>
                    </form>
                    <div class="mt-3">
                        <a href="{{ route('booking.status', $booking->id) }}" class="btn btn-outline-secondary w-100">Lihat Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection