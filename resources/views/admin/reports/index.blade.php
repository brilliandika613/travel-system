@extends('admin.layouts.app')

@section('title', 'Laporan & Analitik')

@section('content')
<!-- Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h6>Total Booking</h6>
                <h3>{{ $totalBookings }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6>Total Pendapatan</h6>
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h6>Total Peserta</h6>
                <h3>{{ $totalParticipants }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6>Conversion Rate</h6>
                <h3>{{ $conversionRate }}%</h3>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Export -->
<div class="d-flex mb-4">
    <a href="{{ route('admin.reports.export.excel') }}" class="btn btn-success me-2">
        <i class="fas fa-file-excel me-1"></i> Export Excel
    </a>
    <a href="{{ route('admin.reports.export.pdf') }}" class="btn btn-danger">
        <i class="fas fa-file-pdf me-1"></i> Export PDF
    </a>
</div>

<!-- Tabel Booking Terbaru -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-list me-2"></i> Laporan Booking Terbaru
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Paket Tour</th>
                        <th>Tgl Berangkat</th>
                        <th>Peserta</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? 'User dihapus' }}</td>
                        <td>{{ $booking->tour->name ?? 'Tour dihapus' }}</td>
                        <td>{{ $booking->departure_date->format('d M Y') }}</td>
                        <td>{{ $booking->participants }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada booking selesai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Statistik Bulanan -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-2"></i> Statistik Bulanan {{ now()->year }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Bulan</th>
                        <th>Total Booking</th>
                        <th>Total Pelanggan</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyStats as $stat)
                    <tr>
                        <td>{{ $stat['month'] }}</td>
                        <td>{{ $stat['bookings'] }}</td>
                        <td>{{ $stat['customers'] }}</td>
                        <td>Rp {{ number_format($stat['revenue'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection