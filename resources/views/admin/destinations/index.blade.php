@extends('layouts.admin')

@section('title', 'Kelola Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Galeri Destinasi</h4>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">+ Tambah Destinasi</a>
</div>

<div class="row g-4">
    @forelse($destinations as $destination)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/' . $destination->image_url) }}" 
                 class="card-img-top" 
                 alt="{{ $destination->name }}"
                 style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <span class="badge bg-{{ $destination->category == 'pulau' ? 'primary' : ($destination->category == 'gunung' ? 'success' : ($destination->category == 'diving' ? 'info' : 'warning')) }} mb-2">
                    {{ ucfirst($destination->category) }}
                </span>
                <h5 class="card-title">{{ $destination->name }}</h5>
                @if($destination->description)
                    <p class="text-muted small">{{ Str::limit($destination->description, 100) }}</p>
                @endif
                <div class="mt-auto">
                    <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus destinasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <p>Belum ada destinasi.</p>
    </div>
    @endforelse
</div>
@endsection