<?php
header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);

include "../../../../config/koneksi.php"; // this should set $koneksi (mysqli connection)
include '../../../../config/fungsi_rupiah.php';

$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => true];
$hargaKategori = $data['harga_kategori'] ?? '0';
$items = $data['items'] ?? [];

$lokasi = ($hargaKategori == '1') ? 1316 : 8001;

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'No items to validate.']);
    exit;
}

// Get all item IDs
$ids = array_map(fn($item) => $item['id'], $items);

// Build placeholders (?, ?, ?, ...)
$placeholders = implode(',', array_fill(0, count($ids), '?'));

// Build the SQL query
$sql = "SELECT kd_brg, stok FROM inventory WHERE kd_brg IN ($placeholders) AND kd_cus = ?";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Query preparation failed.']);
    exit;
}

// Bind parameters (all strings, plus one int for lokasi)
$types = str_repeat('s', count($ids)) . 'i'; // example: 'sss...i'
$params = array_merge($ids, [$lokasi]);

// Use reference for mysqli bind_param
$bind_names[] = $types;
foreach ($params as $key => $value) {
    $bind_names[] = &$params[$key];
}
call_user_func_array([$stmt, 'bind_param'], $bind_names);

// Execute and fetch
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$stockMap = [];
while ($row = mysqli_fetch_assoc($result)) {
    $stockMap[$row['kd_brg']] = floatval($row['stok']);
}

foreach ($items as $item) {
    $id = $item['id'] ?? '';
    $nama = $item['nama'] ?? 'Unknown';
    $jumlah = isset($item['jumlah']) ? floatval($item['jumlah']) : 0;
    $stok = $stockMap[$id] ?? null;

    $checkThis = true;
    // if ($hargaKategori == '1' && !empty($item['lock_swalayan']) && $item['lock_swalayan'] != '0') {
    //     $checkThis = true;
    // } elseif ($hargaKategori != '1' && !empty($item['lock_gudang']) && $item['lock_gudang'] != '0') {
    //     $checkThis = true;
    // }

    if ($checkThis) {
        if ($stok === null) {
            $response = ['success' => false, 'message' => "Barang '$nama' tidak ditemukan di database."];
            break;
        }
        if ($stok < 0) {
            $response = ['success' => false, 'message' => "Stock negatif untuk '$nama': Stok = $stok"];
            break;
        }
        if ($jumlah > $stok) {
            $response = ['success' => false, 'message' => "Stok tidak cukup untuk '$nama': Dibutuhkan $jumlah, tersedia $stok"];
            break;
        }
    }
}

echo json_encode($response);
