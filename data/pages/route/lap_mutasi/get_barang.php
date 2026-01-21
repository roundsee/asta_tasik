<?php
include "../../../../config/koneksi.php";

header('Content-Type: application/json');

$lokasi = isset($_GET['lokasi']) ? trim($_GET['lokasi']) : '';

$datakodebarang = [];

if ($lokasi !== '' && is_numeric($lokasi)) {
    $date_now = date('Y-m-d');
    // $date_minus_7 = date('Y-m-d', strtotime('-7 days'));
    $lokasi = intval($lokasi);

    $querydatakodebarang = mysqli_query($koneksi, "
        SELECT kd_brg 
        FROM mutasi_stok 
        WHERE kd_cus = '$lokasi' 
          AND tgl = '$date_now' 
          AND qt_opname_hari != 0
    ");

    while ($row = mysqli_fetch_assoc($querydatakodebarang)) {
        $datakodebarang[] = $row['kd_brg'];
    }
}

// Build SQL based on presence of excluded codes
if (!empty($datakodebarang)) {
    $escaped_kodes = array_map(function ($kode) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $kode) . "'";
    }, $datakodebarang);

    $kode_list = implode(",", $escaped_kodes);
    $sql = "SELECT kd_brg, nama FROM barang WHERE kd_brg NOT IN ($kode_list) AND `kd_subgrup` IS NULL";
} else {
    $sql = "SELECT kd_brg, nama FROM barang where `kd_subgrup` IS NULL";
}

$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo json_encode([
        "error" => "Query failed",
        "message" => mysqli_error($koneksi)
    ]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $row = array_map(function ($value) {
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }, $row);

    $data[] = $row;
}

$json = json_encode($data);
if ($json === false) {
    echo json_encode([
        "error" => "JSON encoding failed",
        "message" => json_last_error_msg()
    ]);
} else {
    echo $json;
}
