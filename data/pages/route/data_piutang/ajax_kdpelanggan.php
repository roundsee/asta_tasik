<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$data = "tidak ditemukan";

$query = mysqli_query($koneksi, "SELECT kd_supp,nama FROM supplier WHERE kd_supp NOT LIKE 'SUPP%' AND kd_supp = '$value'");
while ($q = mysqli_fetch_array($query)) {
    $data = [$q['kd_supp'], $q['nama']];
}

echo json_encode($data);
exit;
