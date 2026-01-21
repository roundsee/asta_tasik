<?php 
include 'koneksi.php';

$kode  = $_POST['kode'];
$pelanggan = mysqli_query($koneksi,"SELECT * from pelanggan where pelanggan_kode='$kode'")or die(mysqli_error($koneksi));
$jumlah = mysqli_num_rows($pelanggan);
if($jumlah == 1){
	$p = mysqli_fetch_assoc($pelanggan);
	$return_arr = array();
	$return_arr[] = array(
		"id" => $p['pelanggan_id'],
		"kode" => $p['pelanggan_kode'],
		"nama" => $p['pelanggan_nama']
	);
	echo json_encode($return_arr);
}elseif($jumlah == 0){
	$return_arr = array();
	$return_arr[] = array(
		"id" => "",
		"kode" => "",
		"nama" => ""
	);
	echo json_encode($return_arr);
}