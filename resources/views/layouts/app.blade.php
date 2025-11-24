<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meity Travel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { padding-top: 55px; } /* Sesuaikan dengan tinggi navbar */
    </style>
</head>
<body>

@include('layouts.partials.navbar')

<main>
    @yield('content')
</main>

<!-- Footer Kontak -->
<footer id="contact" class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Meity Travel</h5>
                <p>Jelajahi keindahan Indonesia bersama kami.</p>
                <div class="mt-3">
                    <a href="https://www.facebook.com/meity.farida" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.istagram.com/meity_travel?igsh=aXhmNG1xcGtIN2hp" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <h6>Kontak Kami</h6>
                <address>
                    <i class="fas fa-map-marker-alt me-2"></i> Jl. Tanjungsari Asri Tengah RT.02 RW.09 No.47, Bandung<br>
                    <i class="fas fa-phone me-2"></i> +62 856-2160-857<br>
                    <i class="fas fa-envelope me-2"></i> info@meitytravel.com<br>
                    <i class="fab fa-whatsapp me-2"></i> +62 856-2160-857
                </address>
            </div>
            <div class="col-md-4">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="#home" class="text-white">Beranda</a></li>
                    <li><a href="#tours" class="text-white">Paket Tour</a></li>
                    <li><a href="#destinations" class="text-white">Destinasi</a></li>
                    <li><a href="#testimonials" class="text-white">Testimoni</a></li>
                    <li><a href="#contact" class="text-white">Kirim Pesan</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <small>&copy; 2025 Meity Travel. All rights reserved. Made with ❤️ for travelers</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>