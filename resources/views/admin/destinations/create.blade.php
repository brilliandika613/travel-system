@extends('layouts.admin')

@section('title', 'Tambah Destinasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Destinasi Baru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Destinasi</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category" class="form-control" required>
                    <option value="pulau">Pulau</option>
                    <option value="gunung">Gunung</option>
                    <option value="diving">Diving</option>
                    <option value="wildlife">Wildlife</option>
                    <option value="adventure">Adventure</option>
                    <option value="other">Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Gambar Destinasi <small class="text-danger">(Wajib)</small></label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Destinasi</button>
            </div>
        </form>
    </div>
</div>
@endsection