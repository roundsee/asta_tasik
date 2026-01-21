<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

$kode_permintaan = $_POST['kode_permintaan'];

$sql = "SELECT 
            pd.id_detail, 
            pd.kode_permintaan, 
            pd.kd_cus_peminta, 
            permintaan_barang.kd_cus_pengirim,
            pd.kd_barang, 
            b.nama AS nama_barang, 
            pd.qty_diajukan, 
            pd.qty_terkirim, 
            pd.qty_diterima, 
            pd.qty_satuan, 
            pd.satuan, 
            pd.harga, 
            pd.urut, 
            pd.status_item
        FROM permintaan_barang_detail pd
        JOIN permintaan_barang ON permintaan_barang.kode_permintaan = pd.kode_permintaan
        JOIN barang b ON b.kd_brg = pd.kd_barang
        WHERE pd.kode_permintaan = '$kode_permintaan'";

$result = mysqli_query($koneksi, $sql);

$barang = [];
while ($row = mysqli_fetch_assoc($result)) {
    $barang[] = $row;
}

echo json_encode($barang);
?>
