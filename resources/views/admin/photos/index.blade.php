@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Galeri Foto</h4>
    <a href="{{ route('admin.photos.create') }}" class="btn btn-primary">+ Upload Foto</a>
</div>

<!-- Filter Kategori -->
<div class="mb-4">
    <div class="btn-group" role="group">
        <a href="#" class="btn btn-outline-primary active">Semua</a>
        <a href="#" class="btn btn-outline-primary">Bali</a>
        <a href="#" class="btn btn-outline-primary">Papua</a>
        <a href="#" class="btn btn-outline-primary">Jawa Timur</a>
        <a href="#" class="btn btn-outline-primary">NTT</a>
        <a href="#" class="btn btn-outline-primary">Adventure</a>
    </div>
</div>

<!-- Grid Foto -->
<div class="row g-3">
    @forelse($photos as $photo)
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <img src="{{ asset('storage/' . $photo->image_url) }}" 
                 class="card-img-top" 
                 alt="Foto"
                 style="height: 200px; object-fit: cover;">
            <div class="card-body p-2">
                <small class="badge bg-{{ $photo->category == 'bali' ? 'primary' : ($photo->category == 'papua' ? 'success' : ($photo->category == 'jawa_timur' ? 'info' : 'warning')) }}">
                    {{ ucfirst(str_replace('_', ' ', $photo->category)) }}
                </small>
                @if($photo->description)
                    <p class="mt-1 mb-0 small text-muted">{{ $photo->description }}</p>
                @endif
                <div class="mt-2">
                    <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <p>Belum ada foto.</p>
    </div>
    @endforelse
</div>
@endsection