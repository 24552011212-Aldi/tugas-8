<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $data = json_decode(file_get_contents("php://input"), true);
    $id = (int)($data['id'] ?? 0);

    if ($id === 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'ID wajib diisi.']);
        exit;
    }

    $sql = "DELETE FROM informasi WHERE id=$id";

    if ($koneksi->query($sql)) {
            echo json_encode(['status' => 'success', 'message' => "Informasi dengan ID $id berhasil dihapus."]);

    }
}