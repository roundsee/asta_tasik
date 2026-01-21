<?php 
include 'koneksi.php';
include 'acak.php';

	// $route=$_GET['route'];
$act=$_GET['act'];

	//Hapus area
if( $act=='hapus')
{
	$query=mysqli_query($koneksi,"DELETE FROM pocer_temp ");
	
	mysqli_query($koneksi,"DELETE FROM pocer_detil_temp ");

}