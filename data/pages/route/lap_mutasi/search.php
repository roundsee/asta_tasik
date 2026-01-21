<?php
include "../../../../config/koneksi.php";
$barang = isset($_POST['barang']) ? $_POST['barang'] : '';
$lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';

$query = mysqli_query($koneksi, "SELECT tgl,kd_brg,kd_cus,qt_akhir from `mutasi_stok` WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'  ORDER by tgl DESC LIMIT 1;");

$result = mysqli_fetch_assoc($query);

echo json_encode($result);
exit;
