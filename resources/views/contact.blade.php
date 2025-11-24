@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Form Kontak -->
        <div class="col-md-7">
            <h2>Kirim Pesan</h2>
            <p>Butuh bantuan? Punya pertanyaan? Isi form di bawah ini.</p>

            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                <p></p>
            </form>
        </div>

        <!-- Info Kontak -->
        <div class="col-md-5">
            <h2>Kontak Kami</h2>
            <p>Hubungi kami langsung melalui informasi di bawah ini:</p>

            <div class="card bg-light p-4">
                <address>
                    <strong>Meity Travel</strong><br>
                    <div class="col-md-6">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.827048900221!2d107.66183957435162!3d-6.911272693088163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e70820530573%3A0x56778c33771e98f6!2sBu%20Meity!5e0!3m2!1sen!2sid!4v1763399720273!5m2!1sen!2sid"
        width="400"
        height="300" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
</div>

                    <i class="fas fa-phone me-2"></i> 
                    +62 856-2160-857<br>

                    <i class="fas fa-envelope me-2"></i> 
                    info@meitytravel.com<br>

                    <i class="fab fa-whatsapp me-2"></i> 
                    +62 856-2160-857
                </address>

                <h5 class="mt-4">Ikuti Kami</h5>
                <div class="d-flex">
                    <a href="https://www.facebook.com/meity.farida" class="text-dark me-3"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="https://www.istagram.com/meity_travel?igsh=aXhmNG1xcGtIN2hp" class="text-dark me-3"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-dark me-3"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<p></p>
@endsection