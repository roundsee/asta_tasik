<?php
$dir = "../../../../";

$data = "data_account";
$rute = "account";
$aksi = "aksi_account";
$tujuan = "account";

$tabel = "account";
$f1 = 'no_account';
$f2 = 'deskripsi';
$f3 = 'kasbank';
$f4 = 'pph';
$f5 = 'penampung';
$f6 = 'filter';
$f7 = 'kd_jenis';

$j1 = "No Account";
$j2 = "Deskripsi";
$j3 = "KasBank";
$j4 = "Pph";
$j5 = "Penampung";
$j6 = "Filter";
$j7 = 'Kode Jenis';

session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";
	include $dir . "config/library.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	//Hapus area
	if ($route == $tujuan and $act == 'hapus') {

		mysqli_query($koneksi, "DELETE from account where no_account = '$_GET[id]' AND kasbank= '$_GET[$f3]'");

		echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	}

	//Tambah 
	elseif ($route == $tujuan and $act == 'input') {
		$tgl = date('Y-m-d');
		$query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE $f1 = '$_POST[$f1]' AND $f3 ='$_POST[$f3]' ");

		if ($query->num_rows > 0) {
			echo "<script>alert('Data sudah terdaftar');</script>";
			echo "<script>history.go(-1)</script>";
			exit();
		} else {

			$query = "INSERT INTO $tabel ($f1, $f2,$f7)
			Values(
				   '$_POST[$f1]',
				   '$_POST[$f2]',
				   '$_POST[$f7]'
			)";
			// $query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6,$f7)
			// Values(
			// 	   '$_POST[$f1]',
			// 	   '$_POST[$f2]',
			// 	   '$_POST[$f3]',
			// 	   '$_POST[$f4]',
			// 	   '$_POST[$f5]',
			// 	   '$_POST[$f6]',
			// 	   '$_POST[$f7]'
			// )";

			$result = mysqli_query($koneksi, $query);

			if (!$result) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				echo "<script>alert('Data berhasil ditambah.');</script>";
				echo "<script>history.go(-2)</script>";
			}
		}
	}
	// edit
	elseif ($route == $tujuan and $act == 'edit') {
		$query  = "UPDATE $tabel SET 
		$f2 = '$_POST[$f2]', 
		$f7	='$_POST[$f7]'
		";
		// $query  = "UPDATE $tabel SET 
		// $f2 = '$_POST[$f2]', 
		// $f3 = '$_POST[$f3]',
		// $f4 = '$_POST[$f4]',
		// $f5 = '$_POST[$f5]',
		// $f6 = '$_POST[$f6]',
		// $f7	='$_POST[$f7]'
		// ";
		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-2)</script>";
		}
	}
}
