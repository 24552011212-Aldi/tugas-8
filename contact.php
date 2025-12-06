<?php

$pageTitle = "Hubungi Kami - NgeEvent";

include 'includes/header.php';
?>
<style>
    :root {
        --primary-dark: #1e3c72;
        --accent-orange: #f7a61f;
    }

    .map-container {
        height: 450px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid var(--primary-dark);
    }

    .contact-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .list-group-item {
        border-radius: 12px !important;
        transition: background-color 0.3s ease;
        margin: 5px;
        border: 1px solid #e0e0e0;
    }

    .list-group-item:hover {
        background-color: #f0f8ff;
        border-color: var(--primary-dark);
    }

    .btn-accent {
        background-color: var(--accent-orange);
        border-color: var(--accent-orange);
        color: var(--primary-dark);
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-accent:hover {
        background-color: #e6981a;
        border-color: #e6981a;
        color: white;
        transform: scale(1.01);
    }
</style>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<header style="background-color: #2a5298;" class="text-white py-5 mb-5 shadow-lg">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Hubungi Kami</h1>
        <p class="lead text-white-50">Kami senang mendengar dari Anda. Hubungi kami melalui formulir atau temukan lokasi kami di peta.</p>
    </div>
</header>

<div class="container my-5">

    <div class="row g-4">

        <!-- Card Peta -->
        <div class="col-md-6">
            <div class="card p-3 contact-card h-100">
                <h3 class="mb-3" style="color: var(--primary-dark);">Lokasi Kantor Kami</h3>
                <p class="text-muted">Temukan kantor pusat kami menggunakan peta interaktif di bawah.</p>
                <div class="map-container" id="map"></div>
            </div>
        </div>

        <!-- Card Formulir Kontak -->
        <div class="col-md-6">
            <div class="card p-4 contact-card h-100">
                <h3 class="mb-4" style="color: var(--primary-dark);">Kirim Pesan Cepat</h3>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="contoh@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">Pesan</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-accent btn-lg mt-3">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Informasi Kontak  -->
    <div class="row mt-5 mb-5 justify-content-center pb-5">
        <div class="col-md-10">
            <h2 class="text-center mb-4" style="color: var(--primary-dark);">Informasi Kontak Lainnya</h2>
            <div class="d-flex flex-column flex-md-row justify-content-between">

                <!-- Email -->
                <div class="list-group-item list-group-item-action d-flex align-items-center flex-fill p-3 text-center contact-card">
                    <i class="fas fa-envelope fa-2x" style="color: var(--primary-dark);"></i>
                    <div class="ms-3 text-start">
                        <small class="text-muted">Email Utama</small>
                        <p class="mb-0 fw-bold">admin@ngeevent.com</p>
                    </div>
                </div>

                <!-- Telepon -->
                <div class="list-group-item list-group-item-action d-flex align-items-center flex-fill p-3 text-center contact-card">
                    <i class="fas fa-phone-alt fa-2x text-success"></i>
                    <div class="ms-3 text-start">
                        <small class="text-muted">Telepon</small>
                        <p class="mb-0 fw-bold">(62) 1234 5678</p>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="list-group-item list-group-item-action d-flex align-items-center flex-fill p-3 text-center contact-card">
                    <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                    <div class="ms-3 text-start">
                        <small class="text-muted">Alamat</small>
                        <p class="mb-0 fw-bold">Jl. Buah Batu No. 45, Bandung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Map -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Koordinat Bandung
        var map = L.map('map').setView([-6.914744, 107.609810], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        L.marker([-6.914744, 107.609810]).addTo(map)
            .bindPopup('<b>Kantor Pusat NgeEvent</b><br>Jl. Buah Batu No. 45, Bandung.')
            .openPopup();
    });
</script>

<?php
include 'includes/footer.php';
?>