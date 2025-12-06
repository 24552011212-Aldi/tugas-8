<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM informasi ORDER BY tanggal_publikasi DESC";
    $result = $koneksi->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    http_response_code(405); 
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak didukung']);
}
