<?php

session_start();
include 'api/koneksi.php';

$itemId = $_GET['id'] ?? null;
$item = null;
$pageTitle = "Detail Informasi";

// === LOGIC FIREBASE DUMMY (untuk simulasi user login) ===
// Cek status login
$isLoggedIn = isset($_SESSION['user_id']);

if ($itemId && is_numeric($itemId)) {

    $safe_itemId = $koneksi->real_escape_string($itemId);

    $sql = "SELECT *, tujuan FROM informasi WHERE id = '$safe_itemId'";
    $result = $koneksi->query($sql);

    if ($result && $result->num_rows > 0) {
        $item = $result->fetch_assoc();


        $pageTitle = htmlspecialchars($item['Judul']);


        $item['content_type'] = $item['content_type'] ?? 'General';


        $item['tujuan'] = $item['tujuan'] ?? 'Tujuan tidak didefinisikan.';
    }
}

if ($item === null) {
    $item = [
        'Judul' => 'Informasi Tidak Ditemukan',
        'content_type' => 'Error',
        'konten' => 'Maaf, ID informasi yang Anda cari (ID: ' . htmlspecialchars($itemId ?? 'kosong') . ') tidak tersedia dalam database kami.',
        'tujuan' => 'Informasi ini tidak memiliki tujuan spesifik.'
    ];
}


$infoTitle = $item['Judul'];
$infoContent = $item['konten'];
$contentType = $item['content_type'] ?? 'General';

include 'includes/header.php';
?>

<div class="container my-5">

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary">Home</a></li>
            <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none text-primary">Informasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $contentType; ?></li>
        </ol>
    </nav>

    <div class="card shadow-lg p-md-5 p-3 border-0">
        <div class="card-body">

            <?php
            $imageBanner = match ($contentType) {
                'Strategy' => 'https://placehold.co/1200x300/1e3c72/ffffff?text=Strategi+Organisasi',
                'Corporate' => 'https://placehold.co/1200x300/2a5298/ffffff?text=Pesan+Korporat',
                'Announcement' => 'https://placehold.co/1200x300/f7a61f/1e3c72?text=Pengumuman+Penting',
                'Anniversary' => 'https://placehold.co/1200x300/007bff/ffffff?text=Perayaan+Ulang+Tahun',
                default => 'https://placehold.co/1200x300/6c757d/ffffff?text=Detail+Informasi',
            };
            ?>
            <div class="mb-4 overflow-hidden rounded-lg" style="height: 300px;">
                <img src="<?= $imageBanner; ?>" class="img-fluid w-100 h-100 object-cover" alt="Ilustrasi <?= $contentType; ?>"
                    style="object-fit: cover;">
            </div>


            <header class="mb-4 border-bottom pb-3">

                <?php
                $badgeClass = match ($contentType) {
                    'Strategy' => 'bg-success',
                    'Corporate' => 'bg-info',
                    'Error' => 'bg-danger',
                    'Announcement' => 'bg-warning',
                    'Anniversary' => 'bg-primary',
                    default => 'bg-secondary',
                };
                ?>
                <span class="badge <?= $badgeClass; ?> mb-2 fs-6 py-2 px-3"><?= htmlspecialchars($contentType); ?></span>

                <h1 class="display-5 fw-bold text-dark mt-2"><?= htmlspecialchars($infoTitle); ?></h1>

                <p class="text-muted small d-flex align-items-center">
                    <i class="fas fa-calendar-alt me-1"></i> Dipublikasikan: <?= $item['tanggal'] ?? date('d M Y'); ?>
                    <span class="mx-3 text-secondary">|</span>
                    <i class="fas fa-user-edit me-1"></i> Oleh: Admin
                </p>

            </header>

            <div class="content-body pt-3">
                <p class="lead mb-4 text-justify">
                    <?= nl2br(htmlspecialchars($infoContent)); ?>
                </p>

                <?php

                if ($contentType !== 'Error'):
                ?>
                    <div class="alert alert-light border-start border-4 border-primary p-3 mt-5 shadow-sm" role="alert">
                        <h4 class="alert-heading fs-5 text-primary">
                            <i class="fas fa-bullseye me-2"></i> Tujuan Informasi
                        </h4>
                        <p class="mt-2 mb-0">
                            <?= htmlspecialchars($item['tujuan'] ?? 'Tujuan belum diset.'); ?>
                        </p>
                        <hr class="mt-3 mb-2">
                        <small class="text-muted">
                            Informasi ini merupakan bagian integral dari panduan operasional. Kami berkomitmen pada transparansi dan pencapaian target.
                        </small>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">

                    <div>
                        <span class="text-muted me-3 d-none d-sm-inline">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>"
                            target="_blank" class="btn btn-outline-primary me-2" title="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?= urlencode($infoTitle); ?>"
                            target="_blank" class="btn btn-outline-info me-2" title="Share on X/Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="mailto:?subject=<?= urlencode($infoTitle); ?>&body=Baca informasi penting ini: <?= urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>"
                            class="btn btn-outline-secondary" title="Share via Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>

                    <a href="dashboard.php" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<?php include 'includes/footer.php'; ?>