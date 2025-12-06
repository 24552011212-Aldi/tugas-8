<?php
$pageTitle = "Registrasi Akun";
include 'includes/header.php';
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --primary-dark: #1e3c72; 
        --accent-orange: #f7a61f; 
        --secondary-blue: #2a5298; 
    }

    html, body {
        height: 100%;
        margin: 0;
    }
    
    .register-wrapper {
        min-height: calc(100vh - 100px); 
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #d4e0f7 0%, #f9fbfd 100%);
        padding: 40px 0;
    }

    .register-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); 
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        max-width: 600px;
        width: 100%;
    }

    .register-card:hover {
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
</style>

<div class="register-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card register-card">
                <div class="card-header-custom text-center">
                    <i class="fas fa-user-plus fa-3x mb-3" style="color: var(--accent-orange);"></i>
                    <h3 class="fw-light my-2">Daftar Akun Baru</h3>
                    <p class="mb-0 text-white-50 small">Bergabung dengan platform event terbaik.</p>
                </div>
                
                <div class="card-body p-5">
                    <!-- ALERT SECTION untuk menampilkan pesan error/sukses -->
                    <div id="message-alert" class="alert d-none rounded-lg" role="alert"></div>

                    <form id="registrationForm">
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-bold text-muted">Nama Lengkap (Username)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-user" style="color: var(--primary-dark) !important;"></i></span>
                                <input type="text" class="form-control border-start-0" id="nama" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-muted">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope" style="color: var(--primary-dark) !important;"></i></span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="contoh@domain.com" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="password_reg" class="form-label fw-bold text-muted">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock" style="color: var(--primary-dark) !important;"></i></span>
                                    <input type="password" class="form-control border-start-0" id="password_reg" name="pwd" placeholder="Minimal 6 karakter" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="konfirmasi_password" class="form-label fw-bold text-muted">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-check-circle" style="color: var(--primary-dark) !important;"></i></span>
                                    <input type="password" class="form-control border-start-0" id="konfirmasi_password" placeholder="Ulangi password" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-accent btn-lg shadow" id="registerButton">
                                <span id="buttonText"><i class="fas fa-handshake me-2"></i> DAFTAR</span>
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer text-center py-4 bg-light card-footer-custom">
                    <div class="small">
                        Sudah punya akun? <a href="login.php">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const button = document.getElementById('registerButton');
        const buttonText = document.getElementById('buttonText');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const alertDiv = document.getElementById('message-alert');

        // Reset alert
        alertDiv.classList.add('d-none');
        alertDiv.textContent = '';
        alertDiv.classList.remove('alert-success', 'alert-danger');

        const nama = form.nama_lengkap.value;
        const email = form.email.value;
        const password = form.pwd.value;
        const confirmPassword = form.konfirmasi_password.value;

        // Validasi Password
        if (password.length < 6) {
             showAlert('Password harus minimal 6 karakter.', 'danger');
             return;
        }

        if (password !== confirmPassword) {
            showAlert('Password dan Konfirmasi Password tidak cocok.', 'danger');
            return;
        }

        // Tampilkan loading
        button.disabled = true;
        buttonText.classList.add('d-none');
        loadingSpinner.classList.remove('d-none');

        const dataToSend = {
            nama_lengkap: nama,
            email: email,
            password: password
        };

        // URL API untuk Registrasi
        fetch('/UTS_WEB1_TIF-RP-23-CNS_Event/api/user/create_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dataToSend)
            })
            .then(response => {
                if (!response.ok) {
                    // Jika response bukan 200 OK, parse error message dari JSON body
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                // Hentikan loading
                button.disabled = false;
                buttonText.classList.remove('d-none');
                loadingSpinner.classList.add('d-none');

                if (data.status === 'success') {
                    showAlert('Registrasi berhasil! Anda akan langsung di arahkan ke halaman login.', 'success');
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                } else {
                    showAlert(data.message || 'Terjadi kesalahan saat registrasi.', 'danger');
                }
            })
            .catch(error => {
                 // Hentikan loading dan tampilkan error
                button.disabled = false;
                buttonText.classList.remove('d-none');
                loadingSpinner.classList.add('d-none');
                
                // Tampilkan pesan error dari Promise.reject(err)
                showAlert(error.message || 'Error jaringan atau server tidak merespon.', 'danger');
            });
    });

    function showAlert(message, type) {
        const alertDiv = document.getElementById('message-alert');
        alertDiv.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} me-2"></i> ${message}`;
        alertDiv.classList.remove('d-none');
        alertDiv.classList.add(`alert-${type}`);
    }
</script>

<?php
include 'includes/footer.php';
?>