<?php

include '../../../../config/koneksi.php';

$kd_alat = $_GET['kd_alat'];

//mengambil data
$query = mysqli_query($koneksi, "SELECT * from alat_bayar where kd_alat='$kd_alat'");
$q1 = mysqli_fetch_array($query);
$data = array(
            'nama'  =>  @$q1['nama'],
          );

//tampil data
echo json_encode($data);
?>
