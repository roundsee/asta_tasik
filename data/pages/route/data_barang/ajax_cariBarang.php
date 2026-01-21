<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$valuesUM = isset($_GET['valuesUM']) ? $_GET['valuesUM'] : '';

$data = [];

if ($valuesUM == '') {
    $query = "SELECT kd_brg, nama, Quantity, harga, Satuan1, qty_satuan1 FROM barang where kd_subgrup IS NOT NULL ORDER BY kd_brg LIMIT 100";
} else {
    // Aman digunakan langsung karena tidak ada prepared statement
    $valuesUM = $koneksi->real_escape_string($valuesUM); // cegah SQL injection
    $query = "SELECT kd_brg, nama, Quantity, harga, Satuan1, qty_satuan1 
    FROM barang WHERE (barang.nama LIKE '%$valuesUM%' OR barang.kd_brg LIKE '%$valuesUM%') AND kd_subgrup IS NOT NULL ORDER BY kd_brg LIMIT 100";
}

$result = $koneksi->query($query);

if (!$result) {
    // Tangani error query
    echo json_encode(['error' => $koneksi->error]);
    exit;
}

$no = 1;
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'no' => $no++,
        'kode_barang' => $row['kd_brg'],
        'nama' =>  $row['nama'],
        'quantity' =>  $row['qty_satuan1'],
        'harga' =>  $row['harga'],
        'satuan' =>  $row['Satuan1'],
        'isi' =>  $row['qty_satuan1'],
    ];
}

echo json_encode($data);
exit;
