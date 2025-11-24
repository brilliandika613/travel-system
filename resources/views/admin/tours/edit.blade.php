@extends('admin.layouts.app')

@section('title', 'Edit Paket Tour')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Paket Tour: {{ $tour->name }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tours.update', $tour->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Nama Paket Tour</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $tour->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $tour->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $tour->location) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Harga (per orang)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $tour->price) }}" min="0" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Durasi Hari</label>
                                <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', $tour->duration_days) }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Durasi Malam</label>
                                <input type="number" name="duration_nights" class="form-control" value="{{ old('duration_nights', $tour->duration_nights) }}" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Min. Peserta</label>
                        <input type="number" name="min_people" class="form-control" value="{{ old('min_people', $tour->min_people) }}" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="regular" {{ $tour->category == 'regular' ? 'selected' : '' }}>Regular</option>
                            <option value="populer" {{ $tour->category == 'populer' ? 'selected' : '' }}>Populer</option>
                            <option value="best_seller" {{ $tour->category == 'best_seller' ? 'selected' : '' }}>Best Seller</option>
                            <option value="premium" {{ $tour->category == 'premium' ? 'selected' : '' }}>Premium</option>
                            <option value="rekomendasi" {{ $tour->category == 'rekomendasi' ? 'selected' : '' }}>Rekomendasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Gambar Saat Ini</label><br>
                        @if($tour->image_url)
                            <img src="{{ asset('storage/' . $tour->image_url) }}" class="img-fluid mb-2" style="max-height: 200px; object-fit: cover;">
                        @else
                            <em>Tidak ada gambar</em>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Perbarui Paket Tour</button>
            </div>
        </form>
    </div>
</div>
@endsection