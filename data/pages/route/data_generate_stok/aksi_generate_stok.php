<?php
include '../../../../config/koneksi.php';

$route = $_GET['route'];
$act = $_GET['act'];

if ($route == 'generate_stok' and $act == 'report') {
    $tgl_awal = $_POST['tgl_awal'];
    $tgl_akhir = $_POST['tgl_akhir'];
    $asuransi = $_POST['asuransi'];
    $outlet = $_POST['outlet'];
    $area = $_POST['area'];
    $qtyorder = $_POST['qtyorderto'];


    echo '<br/>' . $qtyorder;
    echo '<br/>' . $tgl_awal;
    echo '<br/>' . $tgl_akhir;
    echo '<br/>' . $kota;
    echo '<br/>' . $outlet;
    echo '<br/>' . $area;

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

    echo $filter;

    header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai . '&tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir .'&qtyorderto=' . $qtyorder );
}
