<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda

if (isset($_POST['kd_supp'])) {
    $kd_supp = $_POST['kd_supp'];

    // Query untuk mendapatkan nama supplier berdasarkan kd_supp
    $query = mysqli_query($koneksi, "SELECT nama FROM supplier WHERE kd_supp = '$kd_supp'");

    if ($result = mysqli_fetch_array($query)) {
        echo $result['nama']; // Return nama supplier sebagai respon
    } else {
        echo ''; // Jika tidak ditemukan, return string kosong
    }
}
?>
