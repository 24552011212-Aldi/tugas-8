<?php
$pageTitle = "Informasi Perusahaan";
session_start();
include 'api/koneksi.php';

if (empty($koneksi) || $koneksi->connect_error) {
}

$sql = "SELECT id, Judul, konten, tanggal_publikasi FROM informasi ORDER BY tanggal_publikasi DESC";
$result = $koneksi->query($sql);

$informasiList = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $informasiList[] = $row;
    }
} else {
    $error_message = "Tidak ada informasi atau berita yang tersedia saat ini.";
}

// Menutup koneksi setelah pengambilan data
if ($koneksi) {
    $koneksi->close();
}

include 'includes/header.php';
?>

<link href="css/style.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .dashboard-header {
        background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card-featured {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 10px;
        border: none;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .card-featured:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.4s ease-out;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Warna Badge */
    .badge.bg-primary {
        background-color: #2a5298 !important;
    }

    .badge.bg-danger {
        background-color: #e74c3c !important;
    }

    .badge.bg-info {
        background-color: #3498db !important;
    }

    .badge.bg-warning {
        background-color: #f7a61f !important;
    }
</style>

<body>

    <div class="dashboard-header">
        <div class="container text-center fade-in-up">
            <h1 class="display-5 fw-bold mb-2">Pusat Informasi & Event Perusahaan</h1>
            <p class="lead mb-0">Semua panduan, pengumuman, dan acara terbaru di satu tempat.</p>
        </div>
    </div>

    <div class="container my-5">

        <!-- Section: Event & Informasi Unggulan (Hardcoded Dummy) -->
        <section id="featured" class="mb-5">
            <div class="text-center mb-5 fade-in-up">
                <h2 class="fw-bold">Event & Informasi Unggulan</h2>
                <p class="text-muted">Beberapa informasi terbaru dan event yang paling banyak dicari saat ini.</p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-featured h-100 fade-in-up">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-danger mb-2">HOT</span>
                            <h5 class="card-title fw-bold">Rapat Strategi Q4 2025</h5>
                            <p class="card-text text-muted small"><i class="fas fa-calendar-alt me-1"></i> 20 Nov 2025</p>
                            <p class="card-text flex-grow-1">Diskusi mendalam mengenai target operasional kuartal terakhir dan penyesuaian anggaran.</p>
                            <a href="detail.php?id=9" class="btn btn-sm btn-outline-primary mt-3">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-featured h-100 fade-in-up" style="transition-delay: 0.1s;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-info mb-2">Corporate</span>
                            <h5 class="card-title fw-bold">Panduan Pengajuan Cuti Baru</h5>
                            <p class="card-text text-muted small"><i class="fas fa-file-alt me-1"></i> HRD</p>
                            <p class="card-text flex-grow-1">Dokumen resmi yang mengatur prosedur dan persyaratan pengajuan cuti tahunan dan sakit.</p>
                            <a href="detail.php?id=10" class="btn btn-sm btn-outline-primary mt-3">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-featured h-100 fade-in-up" style="transition-delay: 0.2s;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-warning mb-2">Announcement</span>
                            <h5 class="card-title fw-bold">Update Keamanan Sistem</h5>
                            <p class="card-text text-muted small"><i class="fas fa-lock me-1"></i> IT Dept</p>
                            <p class="card-text flex-grow-1">Pemberitahuan penting tentang pembaruan keamanan server dan perubahan kata sandi wajib.</p>
                            <a href="detail.php?id=11" class="btn btn-sm btn-outline-primary mt-3">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="my-5">

        <h2 class="mb-5 text-center fw-bold text-dark fade-in-up">Informasi dan Event Terbaru</h2>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-info text-center fade-in-up">
                <?= $error_message ?>
            </div>
        <?php else: ?>

            <div class="row">

                <?php
                $delay_counter = 0;
                foreach ($informasiList as $info):
                    $delay_counter++;
                ?>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-featured h-100 fade-in-up" style="transition-delay: <?= $delay_counter * 0.1; ?>s;">
                            <div class="card-body d-flex flex-column">

                                <?php
                                $badge_class = 'bg-primary';
                                if (stripos($info['Judul'], 'rapat') !== false) {
                                    $badge_class = 'bg-danger';
                                } else if (stripos($info['Judul'], 'cuti') !== false) {
                                    $badge_class = 'bg-info';
                                } else if (stripos($info['Judul'], 'update') !== false) {
                                    $badge_class = 'bg-warning';
                                }
                                ?>
                                <span class="badge <?= $badge_class; ?> mb-2">Event</span>

                                <h5 class="card-title fw-bold text-dark">
                                    <?= htmlspecialchars($info['Judul']); ?>
                                </h5>

                                <p class="card-text text-muted small flex-grow-1">
                                    <?= htmlspecialchars(substr($info['konten'], 0, 120)) . '...'; ?>
                                </p>

                                <p class="small text-end mt-3 mb-3 text-secondary">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    Dipublikasi: <?= date('d F Y', strtotime($info['tanggal_publikasi'])); ?>
                                </p>

                                <a href="detail.php?id=<?= $info['id']; ?>" class="btn btn-primary mt-auto">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function isElementInViewport(el) {
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) + 100 &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }

            function handleScrollAnimation() {
                const elements = document.querySelectorAll('.fade-in-up');
                elements.forEach(el => {
                    if (isElementInViewport(el)) {
                        el.classList.add('visible');
                    }
                });
            }

            handleScrollAnimation();
            // event listener untuk scroll
            window.addEventListener('scroll', handleScrollAnimation);
        });
    </script>

    <?php include 'includes/footer.php'; ?>