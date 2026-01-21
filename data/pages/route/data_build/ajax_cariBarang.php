<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$valuesUM = isset($_GET['valuesUM']) ? $_GET['valuesUM'] : '';

$data = [];
if ($valuesUM == '') {
    $query = "SELECT kd_brg, nama, Quantity, harga,Satuan1,qty_satuan1,
IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = barang.kd_brg AND kd_cus = '$value'),0) as stock 
FROM barang ORDER BY kd_brg LIMIT 100";
} else {
    $query = "SELECT kd_brg, nama, Quantity, harga,Satuan1,qty_satuan1,
    IFNULL((SELECT stok FROM inventory WHERE inventory.kd_brg = barang.kd_brg AND kd_cus = '$value'),0) as stock 
    FROM barang WHERE (
    barang.nama LIKE '%$valuesUM%' 
    OR barang.kd_brg LIKE '%$valuesUM%') AND kd_subgrup IS NULL ORDER BY kd_brg LIMIT 1000 ";
}

$stmt = $koneksi->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'no' => $no++,
        'kode_barang' => $row['kd_brg'],
        'nama' =>  $row['nama'],
        'quantity' =>  $row['stock'],
        'harga' =>  $row['harga'],
        'satuan' =>  $row['Satuan1'],
        'isi' =>  $row['qty_satuan1'],
    ];
}

$stmt->close();

echo json_encode($data);

exit;
