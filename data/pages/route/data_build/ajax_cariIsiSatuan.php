<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');

$kodeinput = isset($_GET['kode']) ? $_GET['kode'] : '';
$satuan = isset($_GET['satuan']) ? $_GET['satuan'] : '';
$qty = '';

// Fetch the product data to get the unit fields
$sql = "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5
        FROM barang 
        WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kodeinput);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Determine the correct qty field based on selected unit
if ($satuan == $dataSatuan['Satuan1']) {
    $qty = 'qty_satuan1';
} elseif ($satuan == $dataSatuan['Satuan2']) {
    $qty = 'qty_satuan2';
} elseif ($satuan == $dataSatuan['Satuan3']) {
    $qty = 'qty_satuan3';
} elseif ($satuan == $dataSatuan['Satuan4']) {
    $qty = 'qty_satuan4';
} elseif ($satuan == $dataSatuan['Satuan5']) {
    $qty = 'qty_satuan5';
}

$data = array();

// Query to get the correct quantity for the selected product and unit
$sql = "SELECT {$qty}
        FROM barang b
        WHERE b.kd_brg = '$kodeinput' AND b.nama != '';";

$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query) > 0) {
    $data = array('status' => 1, 'msg' => 'Data Found');
    $data['data'] = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($data['data'] as $key => &$d) {
        // Ensure the quantity field is correctly fetched
        $d['satuan_qty'] = isset($d[$qty]) ? $d[$qty] : 0;
    }
} else {
    $data = array('status' => 0, 'msg' => 'Data Not Found');
}

// Return the response as JSON
echo json_encode($data);
exit;
