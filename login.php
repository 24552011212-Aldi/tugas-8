<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$pageTitle = "Masuk ke Akun NgeEvent";

include 'api/koneksi.php';


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_input = $_POST['username'] ?? '';
    $password_input = $_POST['password'] ?? '';

    if (empty($username_input) || empty($password_input)) {
        $error = 'Username dan password wajib diisi.';
    } else {
        $sql = "SELECT user_id, password FROM users WHERE nama_lengkap = ?";

        if (!isset($koneksi) || !$koneksi->prepare($sql)) {
            $error = 'Gagal menyiapkan query: ' . (isset($koneksi) ? $koneksi->error : 'Koneksi tidak tersedia.');
        } else {
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("s", $username_input);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();

            if ($user) {
                if (password_verify($password_input, $user['password'])) {

                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $user['user_id'];

                    header('Location: dashboard.php');
                    exit;
                } else {
                    $error = 'Username atau password salah.';
                }
            } else {
                $error = 'Username atau password salah.';
            }
        }
    }
}

include 'includes/header.php';
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary-dark: #1e3c72;
        --accent-orange: #f7a61f;
        --secondary-blue: #2a5298;
    }

    html,
    body {
        height: 100%;
        margin: 0;
    }

    .login-wrapper {
        min-height: calc(100vh - 100px);
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #d4e0f7 0%, #f9fbfd 100%);
        padding: 40px 0;
    }

    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        max-width: 600px;
        width: 100%;
    }

    .login-card:hover {
        transform: scale(1.005);
    }

    .card-header-custom {
        background-color: var(--primary-dark);
        color: white;
        border-bottom: none;
        padding: 3rem 1rem;
        border-bottom: 5px solid var(--accent-orange);
    }

    .card-header-custom h3 {
        font-weight: 700;
        letter-spacing: 1px;
    }

    .btn-accent {
        background-color: var(--accent-orange);
        border-color: var(--accent-orange);
        color: var(--primary-dark);
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
    }

    .btn-accent:hover {
        background-color: #e6981a;
        border-color: #e6981a;
        color: white;
        box-shadow: 0 5px 15px rgba(247, 166, 31, 0.5);
        transform: translateY(-2px);
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 0.9rem 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.25);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        border-radius: 10px 0 0 10px !important;
    }

    .form-control {
        border-left: none;
    }

    .card-footer-custom a {
        color: var(--secondary-blue);
        font-weight: 600;
        transition: color 0.3s;
    }

    .card-footer-custom a:hover {
        color: var(--primary-dark);
    }

    .input-group:focus-within .form-control {
        z-index: 10;
        border-left: 1px solid var(--secondary-blue);
    }

    .input-group:focus-within .input-group-text {
        border-color: var(--secondary-blue);
    }
</style>

<div class="login-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card login-card">
                <div class="card-header-custom text-center">
                    <i class="fas fa-sign-in-alt fa-3x mb-3" style="color: var(--accent-orange);"></i>
                    <h3 class="my-2">Selamat Datang Kembali!</h3>
                    <p class="mb-0 text-white-50 small">Masuk untuk melanjutkan ke dashboard event Anda.</p>
                </div>

                <div class="card-body p-5">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center rounded-lg" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <div><?= htmlspecialchars($error) ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="login.php">
                        <div class="mb-4">
                            <label for="username" class="form-label fw-bold text-muted">Username (Nama Lengkap)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-user" style="color: var(--primary-dark);"></i></span>
                                <input type="text" name="username" class="form-control border-start-0" id="username" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label fw-bold text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock" style="color: var(--primary-dark);"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" id="password" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-accent btn-lg shadow">
                                <i class="fas fa-arrow-right-to-bracket me-2"></i> LOGIN
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center py-4 bg-light card-footer-custom">
                    <div class="small">
                        Belum punya akun? <a href="register.php" class="text-decoration-none">Buat Akun Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
if (isset($koneksi) && $koneksi) {
    $koneksi->close();
}
?>