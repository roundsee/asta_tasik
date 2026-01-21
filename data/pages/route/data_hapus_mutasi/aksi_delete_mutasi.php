<?php
$dir = "../../../../";

$judulform = "Hapus Data Mutasi";
$tabel = 'mutasi_stok';

session_start();
if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include $dir . "config/koneksi.php";

    $route = $_GET['route'];
    $act = $_GET['act'];

    // Hapus data mutasi berdasarkan tanggal
    if ($route == 'delete_mutasi' && $act == 'hapus') {
        $tanggal = $_POST['tanggal'];
        if (!empty($tanggal)) {
            mysqli_query($koneksi, "DELETE FROM $tabel WHERE tgl = '$tanggal'");
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Tanggal tidak dipilih');</script>";
        }
        echo "<script>history.go(-1)</script>";
    }
}
?>
