function handleLogin() {
    const nama_lengkap = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    
    if (nama_lengkap === VALID_NAMA_LENGKAP && password === VALID_PASSWORD) {
        alert("Login Berhasil! (client-side)");
        window.location.href = 'dashboard.php';
    } else {
        alert("Login Gagal! Username atau Password salah.");
    }
    return false;
}