<?php

include '../../../../config/koneksi.php';

$kd_jenis = $_GET['kd_jenis'];

//mengambil data
$query = mysqli_query($koneksi, "SELECT * from jenis_transaksi where kd_jenis='$kd_jenis'");
$q1 = mysqli_fetch_array($query);
$data = array(
  'nama'  =>  @$q1['nama'],
);

//tampil data
echo json_encode($data);
