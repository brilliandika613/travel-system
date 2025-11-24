@extends('admin.layouts.app')

@section('title', 'Kelola Booking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Pemesanan</h4>
</div>

<!-- Statistik Status -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6>Menunggu</h6>
                <h4>{{ $bookings->where('status', 'pending')->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h6>Dikonfirmasi</h6>
                <h4>{{ $bookings->where('status', 'confirmed')->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6>Selesai</h6>
                <h4>{{ $bookings->where('status', 'completed')->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h6>Dibatalkan</h6>
                <h4>{{ $bookings->where('status', 'cancelled')->count() }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Booking -->
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Paket Tour</th>
                <th>Tgl Berangkat</th>
                <th>Peserta</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td><strong>#{{ $booking->id }}</strong></td>
                <td>{{ $booking->user->name ?? 'User dihapus' }}<br><small>{{ $booking->user->email ?? '' }}</small></td>
                <td>{{ $booking->tour->name ?? 'Tour dihapus' }}</td>
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
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    @if($booking->status === 'pending')
                        <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" title="Konfirmasi">✓</button>
                        </form>
                    @endif
                    @if($booking->status === 'confirmed')
                        <form action="{{ route('admin.bookings.complete', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success" title="Selesai">✔</button>
                        </form>
                    @endif
                    @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Batalkan booking ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger" title="Batalkan">✕</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada pemesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection