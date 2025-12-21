@extends('layouts.admin')

@section('title', 'Edit Destinasi')

@section('content')
@foreach ($destinations as $destination)
<div class="card">
    <div class="card-header">
        <h5>Edit Destinasi: {{ $destination->name }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Nama Destinasi</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $destination->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $destination->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category" class="form-control" required>
                    <option value="pulau" {{ $destination->category == 'pulau' ? 'selected' : '' }}>Pulau</option>
                    <option value="gunung" {{ $destination->category == 'gunung' ? 'selected' : '' }}>Gunung</option>
                    <option value="diving" {{ $destination->category == 'diving' ? 'selected' : '' }}>Diving</option>
                    <option value="wildlife" {{ $destination->category == 'wildlife' ? 'selected' : '' }}>Wildlife</option>
                    <option value="adventure" {{ $destination->category == 'adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value="other" {{ $destination->category == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                <img src="{{ asset('storage/' . $destination->image_url) }}" 
                     class="img-fluid mb-2 border rounded" 
                     style="max-height: 200px; object-fit: cover;">
            </div>
            <div class="mb-3">
                <label>Ganti Gambar (Opsional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Perbarui Destinasi</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection