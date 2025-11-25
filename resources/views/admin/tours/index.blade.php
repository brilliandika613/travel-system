@extends('layouts.admin')

@section('title', 'Kelola Paket Tour')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Paket Tour</h4>
    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">+ Tambah Paket Tour</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Lokasi</th>
                <th>Durasi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tours as $tour)
            <tr>
                <td>{{ $tour->id }}</td>
                <td>{{ $tour->name }}</td>
                <td>{{ $tour->location }}</td>
                <td>{{ $tour->duration_days }}H/{{ $tour->duration_nights }}M</td>
                <td>Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $tour->category == 'populer' ? 'info' : ($tour->category == 'best_seller' ? 'success' : ($tour->category == 'premium' ? 'warning' : 'secondary')) }}">
                        {{ ucfirst(str_replace('_', ' ', $tour->category)) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus paket ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada paket tour.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection