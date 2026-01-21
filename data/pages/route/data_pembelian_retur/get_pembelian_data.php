<?php
include '../../../../config/koneksi.php';
header('Content-Type: application/json');

if (isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $query = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_transaksi = '$id_transaksi'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
