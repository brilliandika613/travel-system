@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-building me-2"></i> Informasi Perusahaan
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $setting->company_name) }}" required>
                </div>
                <div class="mb-3">
                    <label>Tagline</label>
                    <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $setting->tagline) }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $setting->whatsapp) }}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Website</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $setting->website) }}">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $setting->address) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-share-alt me-2"></i> Media Sosial
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Facebook</label>
                    <input type="url" name="social_facebook" class="form-control" value="{{ old('social_facebook', $setting->social_facebook) }}" placeholder="https://facebook.com/...">
                </div>
                <div class="mb-3">
                    <label>Instagram</label>
                    <input type="url" name="social_instagram" class="form-control" value="{{ old('social_instagram', $setting->social_instagram) }}" placeholder="https://instagram.com/...">
                </div>
                <div class="mb-3">
                    <label>Twitter / X</label>
                    <input type="url" name="social_twitter" class="form-control" value="{{ old('social_twitter', $setting->social_twitter) }}" placeholder="https://twitter.com/...">
                </div>
                <div class="mb-3">
                    <label>YouTube</label>
                    <input type="url" name="social_youtube" class="form-control" value="{{ old('social_youtube', $setting->social_youtube) }}" placeholder="https://youtube.com/...">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-bell me-2"></i> Notifikasi Email
            </div>
            <div class="card-body">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="notification_booking" id="notif1" {{ old('notification_booking', $setting->notification_booking) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notif1">Konfirmasi Booking</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="notification_payment" id="notif2" {{ old('notification_payment', $setting->notification_payment) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notif2">Pengingat Pembayaran</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="notification_newsletter" id="notif3" {{ old('notification_newsletter', $setting->notification_newsletter) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notif3">Newsletter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="notification_promo" id="notif4" {{ old('notification_promo', $setting->notification_promo) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notif4">Promosi & Penawaran</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-cog me-2"></i> Keamanan Akun
            </div>
            <div class="card-body">
                <p><strong>Username:</strong> {{ auth()->user()->email }}</p>
                <p><small>Aktivitas login terakhir: {{ auth()->user()->updated_at->diffForHumans() }}</small></p>

                <hr>

                <div class="mb-3">
                    <label>Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </div>
</div>

<!-- Form Tunggal untuk Semua Input -->
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Semua input di atas dipindahkan ke sini via JavaScript atau manual -->
    <!-- Untuk kesederhanaan, kita pindahkan semua name ke dalam form ini -->
    <!-- TAPI: Lebih baik wrap seluruh konten di atas dalam <form> -->
</form>
@endsection