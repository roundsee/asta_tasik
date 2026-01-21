<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'invoice_pembelian' and $act == 'edit') {
        // Menangkap semua data dari POST yang dikirim dari form
        echo "<pre>";
        echo "Data yang diterima dari form: \n";
        
        // Loop untuk menampilkan data yang dikirim melalui POST
        foreach ($_POST as $key => $value) {
            echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "\n";
        }
        
        echo "</pre>";
    
    // header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}

if ($route == 'invoice_pembelian' and $act == 'report') {
    $tgl_awal = $_POST['tgl_awal'];
    $tgl_akhir = $_POST['tgl_akhir'];
    $asuransi = $_POST['asuransi'];
    $outlet = $_POST['outlet'];
    $area = $_POST['area'];

    // echo '<br/>' . $tgl_awal;
    // echo '<br/>' . $tgl_akhir;
    // echo '<br/>' . $kota;
    // echo '<br/>' . $outlet;
    // echo '<br/>' . $area;

    if ($asuransi != '') {
        $filter = 'asuransi';
        $nilai = $asuransi;
    } elseif ($outlet != '') {
        $filter = 'outlet';
        $nilai = $outlet;
    } elseif ($area != '') {
        $filter = 'area';
        $nilai = $area;
    } else {
        $filter = 'semua';
        $nilai = 'semua';
    }

    header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir);
}