<?php

$pageTitle = "Tentang Kami - NgeEvent";

include 'includes/header.php';
?>
<style>
    :root {
        --primary-dark: #1e3c72;
        --accent-orange: #f7a61f;
        --secondary-blue: #2a5298;
    }

    .about-header {
        background-color: var(--secondary-blue);
        color: white;
        padding: 6rem 0;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .about-header .display-4 {
        color: var(--accent-orange);
    }

    .about-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .value-item {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 2rem;
        transition: background-color 0.3s, border-color 0.3s;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .value-item:hover {
        background-color: #f7f9ff;
        border-color: var(--primary-dark);
    }

    .value-icon {
        color: var(--accent-orange);
        margin-bottom: 1rem;
    }

    .cta-link {
        background-color: var(--accent-orange);
        border-color: var(--accent-orange);
        color: var(--primary-dark);
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .cta-link:hover {
        background-color: #e6981a;
        border-color: #e6981a;
        color: white;
        transform: translateY(-2px);
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Header -->
<header class="about-header mb-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Mengenal NgeEvent Lebih Dekat</h1>
        <p class="lead mt-3 text-white-75">Kami adalah mitra terpercaya Anda dalam mengelola dan menyelenggarakan berbagai acara. Kami menciptakan pengalaman, bukan sekadar *event*.</p>
    </div>
</header>

<section class="mb-5">
    <div class="row g-5">

        <!-- Visi Kami -->
        <div class="col-md-6">
            <div class="card about-card h-100 p-4">
                <div class="card-body">
                    <h2 class="card-title mb-4" style="color: var(--primary-dark);">
                        <i class="fas fa-bullseye me-2" style="color: var(--accent-orange);"></i> Visi Kami
                    </h2>
                    <p class="fs-5 fw-medium">Menjadi platform manajemen event nomor satu di Indonesia yang menghubungkan kreator event dengan audiens yang tepat secara efisien, inovatif, dan berkelanjutan.</p>
                    <p class="text-muted border-start border-3 ps-3 mt-4">Fokus pada teknologi, keberlanjutan, dan pengalaman pengguna yang luar biasa adalah kunci kami mencapai tujuan ini.</p>
                </div>
            </div>
        </div>

        <!-- Misi Kami -->
        <div class="col-md-6">
            <div class="card about-card h-100 p-4">
                <div class="card-body">
                    <h2 class="card-title mb-4" style="color: var(--primary-dark);">
                        <i class="fas fa-rocket me-2" style="color: var(--accent-orange);"></i> Misi Kami
                    </h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle me-2 text-success"></i> **Solusi *End-to-End***: Menyediakan solusi lengkap mulai dari perencanaan, penjualan tiket, hingga laporan pasca-event.</li>
                        <li class="mb-3"><i class="fas fa-check-circle me-2 text-success"></i> **Peningkatan Kualitas Interaksi**: Membangun fitur yang mempererat hubungan antara *event organizer* dan peserta.</li>
                        <li class="mb-3"><i class="fas fa-check-circle me-2 text-success"></i> **Ekosistem Terpercaya**: Menciptakan lingkungan event yang transparan, aman, dan dapat dipercaya untuk semua pihak.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nilai Inti -->
<section class="mb-5 py-4">
    <h2 class="text-center mb-5 fw-bold" style="color: var(--primary-dark);">Nilai Inti Kami</h2>
    <div class="row g-4 justify-content-center">

        <div class="col-lg-4 col-md-6">
            <div class="value-item about-card">
                <i class="fas fa-lightbulb fa-3x value-icon"></i>
                <h3 class="fs-4 fw-bold" style="color: var(--primary-dark);">Inovasi</h3>
                <p class="text-muted mt-2">Kami terus mencari cara baru dan memanfaatkan teknologi terbaru untuk memberikan nilai tambah dan memecahkan masalah lama.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="value-item about-card">
                <i class="fas fa-handshake fa-3x value-icon"></i>
                <h3 class="fs-4 fw-bold" style="color: var(--primary-dark);">Integritas</h3>
                <p class="text-muted mt-2">Menjaga kepercayaan pengguna dan mitra adalah dasar dari setiap keputusan dan transaksi yang kami lakukan.</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="value-item about-card">
                <i class="fas fa-users fa-3x value-icon"></i>
                <h3 class="fs-4 fw-bold" style="color: var(--primary-dark);">Kolaborasi</h3>
                <p class="text-muted mt-2">Kami percaya bahwa hasil terbaik datang dari sinergi tim internal yang kuat dan kemitraan yang saling menguntungkan.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="mb-5 py-5 text-center" style="background-color: #f8f9fa; border-radius: 15px;">
    <h2 class="fw-bold" style="color: var(--primary-dark);">Siap Memulai Event Anda?</h2>
    <p class="lead text-muted mb-4">Bergabunglah dengan ribuan *event creator* lain yang sukses bersama NgeEvent.</p>
    <a href="dashboard.php" class="btn btn-lg cta-link shadow-lg">
        Temukan Event Sekarang <i class="fas fa-arrow-right ms-2"></i>
    </a>
</section>

<?php
include 'includes/footer.php';
?>