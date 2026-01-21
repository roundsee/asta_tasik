<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$nama = isset($_GET['nama']) ? $_GET['nama'] : '';
$data = " ";
$check_barang_sql = "SELECT COUNT(*) AS count,name_e  FROM employee WHERE name_e = '$nama'";
$check_barang_result = mysqli_query($koneksi, $check_barang_sql);
$check_barang_data = mysqli_fetch_assoc($check_barang_result);
if ($check_barang_data['count'] > 0) {
    $data = $check_barang_data['name_e'];
}
echo json_encode($data);
exit;
