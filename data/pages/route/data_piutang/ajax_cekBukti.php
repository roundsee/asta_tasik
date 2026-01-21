<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$value = isset($_GET['value']) ? $_GET['value'] : '';
$data = "";

$query = mysqli_query($koneksi, "SELECT bukti_nomor FROM bayar_piutang WHERE bukti_nomor = '$value'");
while ($q = mysqli_fetch_array($query)) {
    $data = $q['bukti_nomor'];
}

echo json_encode($data);
exit;
