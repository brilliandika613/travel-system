@extends('layouts.app')

@section('title', 'Status Pemesanan')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pemesanan</h4>
                </div>
                <div class="card-body">
                    <p><strong>ID Pemesanan:</strong> #{{ $booking->id }}</p>
                    <p><strong>Paket Tour:</strong> 
                        @if($booking->tour)
                            {{ $booking->tour->name }}
                        @else
                            <em>Tour dihapus</em>
                        @endif
                    </p>
                    <p><strong>Tanggal Berangkat:</strong> {{ $booking->departure_date }}</p>
                    <p><strong>Jumlah Peserta:</strong> {{ $booking->participants }} orang</p>
                    <p><strong>Total Pembayaran:</strong> <strong class="text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></p>
                    
                    <hr>

                    <p><strong>Status Pemesanan:</strong>
                        @php
                            $statusMap = [
                                'pending' => ['label' => 'Menunggu Konfirmasi', 'class' => 'warning'],
                                'confirmed' => ['label' => 'Dikonfirmasi', 'class' => 'info'],
                                'completed' => ['label' => 'Perjalanan Selesai', 'class' => 'success'],
                                'cancelled' => ['label' => 'Dibatalkan', 'class' => 'danger'],
                            ];
                            $status = $statusMap[$booking->status] ?? ['label' => 'Tidak Dikenal', 'class' => 'secondary'];
                        @endphp
                        <span class="badge bg-{{ $status['class'] }} fs-6">{{ $status['label'] }}</span>
                    </p>

                    <p><strong>Status Pembayaran:</strong>
                        <span class="badge bg-{{ $booking->payment_status === 'lunas' ? 'success' : 'secondary' }} fs-6">
                            {{ $booking->payment_status === 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                        </span>
                    </p>
                    @if($booking->payment_proof)
                        <div class="mt-3">
                            <strong>Bukti Pembayaran:</strong><br>
                            <img src="{{ asset('storage/' . $booking->payment_proof) }}" 
                                 class="img-fluid mt-2 border rounded" 
                                 style="max-height: 300px; object-fit: contain;">
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('booking.history') }}" class="btn btn-outline-secondary">← Kembali ke Riwayat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection