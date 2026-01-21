<?php
include '../../../../config/koneksi.php';

if (isset($_POST['kode_barang'])) {
    $kode_barang = $_POST['kode_barang'];
    
    // Query untuk mendapatkan harga barang berdasarkan kode_barang
    $query = "SELECT harga FROM barang WHERE kd_brg = '$kode_barang'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['harga']; // Mengembalikan harga ke AJAX
    } else {
        echo 0; // Jika harga tidak ditemukan
    }
}
?>
