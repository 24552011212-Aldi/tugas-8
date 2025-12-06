<?php

include '../../api/koneksi.php';


header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $Judul          = $koneksi->real_escape_string($data['Judul'] ?? '');
    $konten         = $koneksi->real_escape_string($data['konten'] ?? '');
    $content_type = $koneksi->real_escape_string($data['content_type'] ?? 'General');
    $tujuan         = $koneksi->real_escape_string($data['tujuan'] ?? '');


    if (empty($Judul) || empty($konten)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Judul dan konten wajib diisi.']);
        $koneksi->close();
        exit;
    }


    $sql = "INSERT INTO informasi (Judul, konten, content_type, tujuan) 
            VALUES ('$Judul', '$konten', '$content_type', '$tujuan')";

    if ($koneksi->query($sql)) {

        http_response_code(201);
        echo json_encode([
            'status' => 'success',
            'message' => 'Informasi berhasil ditambahkan.',
            'id' => $koneksi->insert_id
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan informasi: ' . $koneksi->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}

$koneksi->close();
