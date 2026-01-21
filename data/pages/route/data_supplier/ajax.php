<?php

include '../../../../config/koneksi.php';

$kd = $_GET['kd_cus'];

//mengambil data
$query = mysqli_query($koneksi, "SELECT * from pelanggan where kd_cus='$kd'");
$q1 = mysqli_fetch_array($query);
$data = array(
            'nama'  =>  @$q1['nama'],
          );

//tampil data
echo json_encode($data);
?>
