<?php
include "koneksi.php";

function autonomor($tabel, $kolom, $lebar=0, $awalan='')
{
	$hasil = mysqli_query($koneksi,"SELECT max(id_orders) as maxKode FROM orders");

	$query = "SELECT max($kolom) as maxKode FROM $tabel";
	$hasil = mysqli_query($koneksi,$query);
	
	echo "y";
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];
	echo $kodeBarang;
	echo " = ";

	$noUrut = (int) substr($kodeBarang, 2, 4);
	echo $noUrut;
	echo " = ";
	$noUrut++;
	echo $noUrut;

	echo " = ";

	$char = "OR";
	$kodeBarang = $char . sprintf("%03s", $noUrut);
	echo $kodeBarang;
}
$ido=autonomor("orders","id_orders",4,"OR");
      $ido=$angka;
	$jam=date('H:i:s');
	echo $ido;

?>