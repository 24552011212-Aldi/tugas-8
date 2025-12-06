<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id = (int)($data['id'] ?? 0);
    $Judul = $koneksi->real_escape_string($data['Judul'] ?? '');
    $konten = $koneksi->real_escape_string($data['konten'] ?? '');

    if ($id === 0 || empty($Judul) || empty($konten)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'ID, Judul, dan konten wajib diisi.']);
        exit;
    }

    $sql = "UPDATE informasi SET Judul='$Judul', konten='$konten' WHERE id=$id";
    
    if ($koneksi->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Informasi berhasil diperbarui.']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui informasi.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak didukung']);
}
?>