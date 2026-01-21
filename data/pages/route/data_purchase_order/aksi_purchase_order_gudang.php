<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'purchase_order_gudang' and $act == 'report') {
    // $tgl_awal = $_POST['tgl_awal'];
    // $tgl_akhir = $_POST['tgl_akhir'];
    $supplier = $_POST['supplier'];
    $outlet = $_POST['outlet'];
    $area = $_POST['area'];

    // echo '<br/>' . $tgl_awal;
    // echo '<br/>' . $tgl_akhir;
    // echo '<br/>' . $kota;
    // echo '<br/>' . $outlet;
    // echo '<br/>' . $area;

    if ($supplier != '') {
        $filter = 'supplier';
        $nilai = $supplier;
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

    header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai);
}
