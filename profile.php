<?php

session_start();


include 'api/koneksi.php';

if (empty($_SESSION['user_id'])) {

    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'];

    // Ambil data pengguna dari database
    $sql = "SELECT `user_id`, `nama_lengkap`, `email`, `password`, `join_date` FROM `users` WHERE user_id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        
        header('Location: login.php');
        exit;
    }
} 


include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2 class="mb-4 fw-bold text-primary"><i class="fas fa-user-circle me-2"></i> Profil Pengguna</h2>

            <div class="card shadow-lg border-0">
                <div class="card-body p-md-5">

                    <div class="d-flex align-items-center mb-4 border-bottom pb-4">
                        <img
                            src="assets/img/photo.png"
                            alt="Foto Profil"
                            class="rounded-circle me-4"
                            style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                        <div>
                            <h3 class="fw-bold mb-0"><?= htmlspecialchars($user['nama_lengkap']); ?></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="fw-bold mb-3 mt-4">Detail Kontak</h4>

                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="fas fa-envelope me-3 text-secondary"></i> Email</span>
                                    <span><?= htmlspecialchars($user['email']); ?></span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium"><i class="fas fa-calendar-alt me-3 text-secondary"></i> Bergabung Sejak</span>
                                    <span><?= htmlspecialchars($user['join_date']); ?></span>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top">
                        <a href="#" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i> Edit Profil
                        </a>
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-lock me-1"></i> Ganti Password
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>