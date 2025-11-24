@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Riwayat Pemesanan</h2>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-inbox me-2"></i>
            Belum ada pemesanan. Yuk, <a href="{{ route('tours.index') }}">jelajahi paket tour</a>!
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Paket Tour</th>
                        <th>Tanggal Berangkat</th>
                        <th>Peserta</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td><strong>#{{ $booking->id }}</strong></td>
                        <td>
                            @if($booking->tour)
                                {{ $booking->tour->name }}
                            @else
                                <em class="text-muted">Tour tidak tersedia</em>
                            @endif
                        </td>
                        <td>{{ $booking->departure_date->format('d M Y') }}</td>
                        <td>{{ $booking->participants }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Menunggu', 'class' => 'warning'],
                                    'confirmed' => ['label' => 'Dikonfirmasi', 'class' => 'info'],
                                    'completed' => ['label' => 'Selesai', 'class' => 'success'],
                                    'cancelled' => ['label' => 'Dibatalkan', 'class' => 'danger'],
                                ];
                                $status = $statusMap[$booking->status] ?? ['label' => 'Tidak dikenal', 'class' => 'secondary'];
                            @endphp
                            <span class="badge bg-{{ $status['class'] }}">{{ $status['label'] }}</span>
                        </td>
                        <td>
                            <a href="{{ route('booking.status', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection