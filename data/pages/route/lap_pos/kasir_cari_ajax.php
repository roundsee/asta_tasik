<?php 
include 'koneksi.php';

$kode  = $_POST['kode']; 
$pelanggan = mysqli_query($koneksi,"SELECT * from employee where employee_number='$kode'")or die(mysqli_error($koneksi));
$jumlah = mysqli_num_rows($pelanggan);
if($jumlah == 1){
	$p = mysqli_fetch_assoc($pelanggan);
	$return_arr = array();
	$return_arr[] = array(
		"id" => $p['employee_number'],
		"kode" => $p['employee_number'],
		"nama" => $p['name_e']
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