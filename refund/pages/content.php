<?php
// session_start();
$dir="../../";
include $dir."config/koneksi.php";
include $dir."config/library.php";
include $dir."config/fungsi_combobox.php";
include $dir."config/class_paging.php";
include $dir."config/library.php";

$en = $_SESSION['employee_number'];

if ($_GET['route'] == 'home') {
	?>

	<link rel="stylesheet" href="styleglow.css">
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="background-color: #aCf0aA;">

	<?php
}
// modul profile
elseif ($_GET['route'] == 'profile') {
	include "route/data_profile/profile.php";
}


// modul kasir
elseif ($_GET['route'] == 'kasir_refund') {
	include "route/data_kasir/kasir_refund.php";
}

// modul print
elseif ($_GET['route'] == 'print') {
	include "route/data_kasir/cetak_faktur_2.php";
}


else {
	echo "<script>alert('Modul Tidak Ditemukann !');</script>";
	echo "<script>window.location='main.php?route=home'</script>";
}

?>
