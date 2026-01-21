<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$kode_brg = isset($_GET['kode']) ? $_GET['kode'] : '';
$satuan = isset($_GET['satuan']) ? $_GET['satuan'] : '';
// diubah 1
$status_member = isset($_GET['status_member']) ? $_GET['status_member'] : '';
//
$disc = "";
if ($satuan == 'Pcs') {
    $disc = "disc_pcs";
} elseif ($satuan == 'Pak') {
    $disc = "disc_pak";
} elseif ($satuan == 'ikat') {
    $disc = "disc_ikat";
} elseif ($satuan == 'Renteng') {
    $disc = "disc_renteng";
} elseif ($satuan == 'Box') {
    $disc = "disc_box";
} elseif ($satuan == 'Dus') {
    $disc = "disc_dus";
}

if (!empty($disc)) {
    $sql = "SELECT {$disc} FROM `barang` WHERE kd_brg=?;";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $kode_brg);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dataDiscount = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $data['diskon'] = $dataDiscount[$disc];
} else {
    $data['diskon'] = 0;
}
// diubah 2
$sql2 = "SELECT hrg_pcs AS harga,id_kat FROM `barang` WHERE kd_brg=?;";
$stmt2 = mysqli_prepare($koneksi, $sql2);
mysqli_stmt_bind_param($stmt2, 's', $kode_brg);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$d2s = mysqli_fetch_array($result2, MYSQLI_ASSOC);

$tempkat = $d2s['id_kat'] ?? 0;

$data2 = mysqli_query($koneksi, "SELECT `$status_member` as kategorivalue FROM kategori WHERE id_kat = '$tempkat'");

$d2 = mysqli_fetch_array($data2);

$data['harga'] = $d2s['harga'] + ($d2s['harga'] * $d2['kategorivalue'] / 100);
//
echo json_encode($data);
exit;
