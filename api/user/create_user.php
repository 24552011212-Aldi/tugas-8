<?php 
include '../../api/koneksi.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($koneksi) || $koneksi->connect_error) {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'Koneksi database GAGAL!']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $nama_lengkap = $koneksi->real_escape_string($data['nama_lengkap'] ?? '');
    $email = $koneksi->real_escape_string($data['email'] ?? '');
    $password = password_hash($data['password'] ?? '', PASSWORD_BCRYPT);


    if (empty($nama_lengkap) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi.']);
        $koneksi->close();
        exit;
    }

    $sql = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama_lengkap', '$email', '$password')";

    if ($koneksi->query($sql)) {
        http_response_code(201);
        echo json_encode([
            'status' => 'success',
            'message' => 'User berhasil dibuat.',
            'id' => $koneksi->insert_id
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Gagal membuat user: ' . $koneksi->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}
?>