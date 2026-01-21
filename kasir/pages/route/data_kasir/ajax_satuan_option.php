<?php
include "../../../../config/koneksi.php";
include '../../../../config/fungsi_rupiah.php';
session_start();
$en = $_SESSION['employee_number'];
header('Content-Type: application/json');
$kodeAppValue = $_COOKIE['kode_kategori_tambahan'] ?? null;
$kdbrg = isset($_GET['id']) ? $_GET['id'] : '';
$data = array();
$sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5 
FROM barang WHERE kd_brg = ?;";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 's', $kdbrg);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($kodeAppValue == 2) {
    $kode_ktg = 'ktg_grosir';
    if (!empty($dataSatuan['Satuan5']) && $dataSatuan['Satuan5'] != " ") {
        $data[] = trim($dataSatuan['Satuan5']);
    } else if (!empty($dataSatuan['Satuan4']) && $dataSatuan['Satuan4'] != " ") {
        $data[] = trim($dataSatuan['Satuan4']);
    } else if (!empty($dataSatuan['Satuan3']) && $dataSatuan['Satuan3'] != " ") {
        $data[] = trim($dataSatuan['Satuan3']);
    } else if (!empty($dataSatuan['Satuan2']) && $dataSatuan['Satuan2'] != " ") {
        $data[] = trim($dataSatuan['Satuan2']);
    } else {
        $data[] = trim($dataSatuan['Satuan1']);
    }
} else if ($kodeAppValue == 3) {
    $kode_ktg = 'ktg_online';
    $data[] = trim($dataSatuan['Satuan1']);
} else {
    $data[] = trim($dataSatuan['Satuan1']);

    if (!empty($dataSatuan['Satuan2']) && $dataSatuan['Satuan2'] != " ") {
        $data[] = trim($dataSatuan['Satuan2']);
    }
    if (!empty($dataSatuan['Satuan3']) && $dataSatuan['Satuan3'] != " ") {
        $data[] = trim($dataSatuan['Satuan3']);
    }
    if (!empty($dataSatuan['Satuan4']) && $dataSatuan['Satuan4'] != " ") {
        $data[] = trim($dataSatuan['Satuan4']);
    }
    if (!empty($dataSatuan['Satuan5']) && $dataSatuan['Satuan5'] != " ") {
        $data[] = trim($dataSatuan['Satuan5']);
    }
}

echo json_encode($data);
exit;
