<?php
include "../../../../config/koneksi.php";

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $kd_brg = $_POST['id'];
    $query = "
        SELECT 
            kd_brg, hrg_pcs, qty_satuan1 AS pcs, qty_satuan2 AS renteng, 
            qty_satuan3 AS pak, qty_satuan4 AS ikat, qty_satuan5 AS ball,
            Box, Dus
        FROM barang
        WHERE kd_brg = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 's', $kd_brg);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Kirim data dalam format JSON
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Data tidak ditemukan"]);
    }
} else {
    echo json_encode(["error" => "ID Barang tidak valid"]);
}
