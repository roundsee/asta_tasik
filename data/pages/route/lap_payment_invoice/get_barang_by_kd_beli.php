<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

$kd_po = $_POST['kd_po'];


$sql = "SELECT pd.*, b.nama AS nama_barang, p.jumlah_payment, p.ppn as ppn
        FROM payment_detail pd
        JOIN barang b ON b.kd_brg = pd.kd_brg
        JOIN payment p ON p.no_payment = pd.no_payment
        JOIN pembelian_detail ON pembelian_detail.kd_po = p.no_invoice
        JOIN pembelian ON pembelian.kd_po = pembelian_detail.kd_po
        WHERE pd.no_payment = '$kd_po'
        GROUP BY pd.kd_brg, b.nama, p.jumlah_payment;";

// $sql = "SELECT pd.*, b.nama AS nama_barang, p.jumlah_payment ,sum(DISTINCT pembelian_detail.disc) as disc
//         FROM payment_detail pd
//           JOIN barang b ON b.kd_brg = pd.kd_brg
//           JOIN payment p On p.no_payment = pd.no_payment
//           JOIN pembelian_detail ON pembelian_detail.kd_po = p.no_invoice
//          WHERE pd.no_payment = '$kd_po'
//         ";
// $sql = "SELECT b.kd_brg, b.nama AS nama_barang, pd.jumlah_pcs , pd.price AS harga, pyd.jumlah_datang
//         FROM pembelian_detail pd
//         JOIN barang b ON b.kd_brg = pd.kd_brg
//         JOIN payment_detail pyd ON pyd.kd_brg = pd.kd_brg
//         WHERE pd.kd_po = '$kd_beli'";

$result = mysqli_query($koneksi, $sql);

$barang = [];
while ($row = mysqli_fetch_assoc($result)) {
    $barang[] = $row;
}

echo json_encode($barang);
?>
