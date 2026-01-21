<?php
include "../../../../config/koneksi.php";
include '../../../../config/fungsi_rupiah.php';
header('Content-Type: application/json');

$kdbrg = isset($_GET['id']) ? $_GET['id'] : '';
$data = array();
$kodeAppValue = $_COOKIE['kode_kategori'] ?? null;

$sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5 
FROM barang WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kdbrg);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($kodeAppValue == 2) {
    if (!empty($dataSatuan['Satuan5'])) {
        $data[] = $dataSatuan['Satuan5'];
    } else if (!empty($dataSatuan['Satuan4'])) {
        $data[] = $dataSatuan['Satuan4'];
    } else if (!empty($dataSatuan['Satuan3'])) {
        $data[] = $dataSatuan['Satuan3'];
    } else if (!empty($dataSatuan['Satuan2'])) {
        $data[] = $dataSatuan['Satuan2'];
    } else {
        $data[] = $dataSatuan['Satuan1'];
    }
} else {
    $data[] = $dataSatuan['Satuan1'];

    if (!empty($dataSatuan['Satuan2'])) {
        $data[] = $dataSatuan['Satuan2'];
    }
    if (!empty($dataSatuan['Satuan3'])) {
        $data[] = $dataSatuan['Satuan3'];
    }
    if (!empty($dataSatuan['Satuan4'])) {
        $data[] = $dataSatuan['Satuan4'];
    }
    if (!empty($dataSatuan['Satuan5'])) {
        $data[] = $dataSatuan['Satuan5'];
    }
}

echo json_encode($data);
exit;
