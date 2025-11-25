@extends('layouts.admin')

@section('title', 'Tambah Paket Tour')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Paket Tour Baru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tours.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Nama Paket Tour</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi</label>
                        <input type="text" name="location" class="form-control" placeholder="Contoh: Bali, Indonesia" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Harga (per orang)</label>
                        <input type="number" name="price" class="form-control" min="0" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Durasi Hari</label>
                                <input type="number" name="duration_days" class="form-control" min="1" value="3" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Durasi Malam</label>
                                <input type="number" name="duration_nights" class="form-control" min="0" value="2" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Min. Peserta</label>
                        <input type="number" name="min_people" class="form-control" min="1" value="2" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="regular">Regular</option>
                            <option value="populer">Populer</option>
                            <option value="best_seller">Best Seller</option>
                            <option value="premium">Premium</option>
                            <option value="rekomendasi">Rekomendasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Gambar Utama (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Paket Tour</button>
            </div>
        </form>
    </div>
</div>
@endsection