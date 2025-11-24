@extends('admin.layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Detail Pemesanan #{{ $booking->id }}</h5>
            </div>
            <div class="card-body">
                <h6>Informasi Pelanggan</h6>
                <p>
                    <strong>{{ $booking->user->name ?? 'User dihapus' }}</strong><br>
                    {{ $booking->user->email ?? 'Email tidak tersedia' }}
                </p>

                <h6>Informasi Paket Tour</h6>
                <p>
                    <strong>{{ $booking->tour->name ?? 'Tour dihapus' }}</strong><br>
                    Lokasi: {{ $booking->tour->location ?? '-' }}<br>
                    Tanggal: {{ $booking->departure_date->format('d F Y') }}<br>
                    Peserta: {{ $booking->participants }} orang<br>
                    Total: <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
                </p>

                <h6>Status</h6>
                <p>
                    Pemesanan: 
                    <span class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'confirmed' ? 'info' : ($booking->status == 'completed' ? 'success' : 'danger')) }}">
                        {{ ucfirst($booking->status) }}
                    </span><br>
                    Pembayaran: 
                    <span class="badge bg-{{ $booking->payment_status == 'lunas' ? 'success' : 'secondary' }}">
                        {{ $booking->payment_status == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Bukti Pembayaran</div>
            <div class="card-body text-center">
                @if($booking->payment_proof)
                    <img src="{{ asset('storage/' . $booking->payment_proof) }}" 
                         class="img-fluid border rounded" 
                         style="max-height: 300px; object-fit: contain;">
                @else
                    <p class="text-muted">Belum ada bukti pembayaran.</p>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary w-100">← Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection