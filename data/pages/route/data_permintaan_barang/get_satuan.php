<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "../../../../config/koneksi.php";
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = $_POST['id'];


    $sql = "SELECT kd_brg,Satuan1,Satuan2,Satuan3,Satuan4,Satuan5 
    FROM barang WHERE kd_brg = ?;";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dataSatuan = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($dataSatuan) {
        error_log(print_r($dataSatuan, true));
    }
    $options = [];
    if ($dataSatuan['Satuan1']) $options[] = ['value' => 'pcs', 'text' => $dataSatuan['Satuan1']];
    if ($dataSatuan['Satuan2']) $options[] = ['value' => 'renteng', 'text' => $dataSatuan['Satuan2']];
    if ($dataSatuan['Satuan3']) $options[] = ['value' => 'pak', 'text' => $dataSatuan['Satuan3']];
    if ($dataSatuan['Satuan4']) $options[] = ['value' => 'ikat', 'text' => $dataSatuan['Satuan4']];
    if ($dataSatuan['Satuan5']) $options[] = ['value' => 'ball', 'text' => $dataSatuan['Satuan5']];

    header('Content-Type: application/json');
    echo json_encode($options);
} else {
    // Return an empty array if no row is found
    header('Content-Type: application/json');
    echo json_encode([]);
}
