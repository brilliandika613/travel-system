@extends('layouts.admin')

@section('title', 'Upload Foto')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Upload Foto Baru ke Galeri</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Gambar <small class="text-danger">(Wajib, max 2MB)</small></label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category" class="form-control" required>
                    <option value="bali">Bali</option>
                    <option value="papua">Papua</option>
                    <option value="jawa_timur">Jawa Timur</option>
                    <option value="ntt">NTT</option>
                    <option value="adventure">Adventure</option>
                    <option value="other">Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi (Opsional)</label>
                <input type="text" name="description" class="form-control" placeholder="Contoh: Sunset di Pantai Kuta">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.photos.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Upload Foto</button>
            </div>
        </form>
    </div>
</div>
@endsection