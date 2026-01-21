<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

$kd_beli = $_POST['kd_beli'];

$sql = "SELECT b.kd_brg, b.nama AS nama_barang, pd.jml as jumlah_pcs , pd.satuan as satuan, pd.urut as urut,  pd.status_barang
        FROM pembelian_detail pd
        JOIN barang b ON b.kd_brg = pd.kd_brg
        WHERE pd.kd_beli = '$kd_beli'
        group by pd.urut
        ";

$result = mysqli_query($koneksi, $sql);

$barang = [];
while ($row = mysqli_fetch_assoc($result)) {
    $barang[] = $row;
}

echo json_encode($barang);
