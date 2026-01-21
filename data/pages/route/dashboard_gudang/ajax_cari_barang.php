<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';

$data = [];
$query = "SELECT barang.nama, jualdetil.satuan, jualdetil.banyak,jualdetil.qty_satuan 
FROM jualdetil join barang on jualdetil.kd_brg = barang.kd_brg where faktur='$value' ORDER BY jualdetil.kd_brg";

$stmt = $koneksi->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'no' => $no++,
        'nama' =>  $row['nama'],
        'satuan' =>  $row['satuan'],
        'banyak' =>  $row['banyak'],
        'isi' =>  $row['qty_satuan'],
    ];
}

$stmt->close();

echo json_encode($data);

exit;
