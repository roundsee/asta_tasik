<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$valuesID = isset($_GET['valuesID']) ? $_GET['valuesID'] : '';
$data = "";

$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$value' AND id_kat = '$valuesID'";
$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);
if ($check_barang_data['count'] > 0) {
    $data = "ada";
}
echo json_encode($data);
exit;
