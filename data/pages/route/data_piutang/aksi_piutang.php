<?php
session_start();


$employee = $_SESSION['employee_number'];


if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include "../../../../config/koneksi.php";
    include "../../../../config/fungsi_kode_otomatis.php";

    $route = $_GET['route'];
    $act = $_GET['act'];
    if ($route == 'piutang' && $act == 'submit') {

        $list1 = $_POST['nomorfaktur'];
        $list2 = $_POST['tanggalfaktur'];
        $list3 = $_POST['nilaiFaktur'];
        $list4 = $_POST['fakturSudahDibayar'];
        $list5 = $_POST['fakturDibayar'];

        $list6 = $_POST['nomorbukti'];
        $list7 = $_POST['tanggalbukti'];
        $list8 = $_POST['nilaibukti'];
        $list9 = $_POST['buktisudahDibayar'];
        $list10 = $_POST['buktidibayar'];

        $tanggal = $_POST['tanggal'];
        $kode = $_POST['kode'];
        $bukti = $_POST['bukti'];

        echo "Tanggal: " . htmlspecialchars($tanggal) . "<br>";
        echo "Kode cus: " . htmlspecialchars($kode) . "<br>";
        echo "Nomor bukti: " . $bukti . "<br>";
        echo "<br>";


        foreach ($list1 as $index => $value) {
            if ($index != 0) {
                echo "Faktur: " . htmlspecialchars($value) . "<br>";
                echo "Tanggal: " . htmlspecialchars($list2[$index]) . "<br>";
                echo "Nilai Faktur: " . htmlspecialchars($list3[$index]) . "<br>";
                echo "Sudah Dibayar: " . htmlspecialchars($list4[$index]) . "<br>";
                echo "Dibayar: " . htmlspecialchars($list5[$index]) . "<br>";
            }
        }
        echo "<br>";


        foreach ($list6 as $index => $value) {
            if ($index != 0) {
                echo "bukti: " . htmlspecialchars($value) . "<br>";
                echo "Tanggal: " . htmlspecialchars($list7[$index]) . "<br>";
                echo "Nilai bukti: " . htmlspecialchars($list8[$index]) . "<br>";
                echo "Sudah Dibayar: " . htmlspecialchars($list9[$index]) . "<br>";
                echo "Dibayar: " . htmlspecialchars($list10[$index]) . "<br>";
            }
        }
    }
}
