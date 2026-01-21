<?php
$dir = "../../../../";

$tabel_sebelum = "";
$tabel = "jenis_transaksi";
$tujuan = "jenis_transaksi";

$f1 = 'kd_jenis';
$f2 = 'nama';
$f3 = 'photo';
$f4 = 'keterangan';
$f5 = 'no_online';
$f6 = 'no_ofline';

session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	//Hapus area
	if ($route == $tujuan and $act == 'hapus') {

		$query = mysqli_query($koneksi, "SELECT * FROM alat_bayar WHERE kd_aplikasi = '$_GET[id]' ");

		if ($query->num_rows > 0) {
			echo "<script>alert('Data sudah terdaftar tdk bisa di hapus,hub Admin');</script>";
			echo "<script>history.go(-1)</script>";
		} else {
			mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");

			echo "<script>alert('Data berhasil dihapus ');</script>";
			echo "<script>history.go(-1)</script>";
		}
	}

	//Tambah 
	elseif ($route == $tujuan and $act == 'input') {
		$tgl = date('Y-m-d');

		$pilihan = $_POST['pilihan'];

		// if ($pilihan == "1") {
		// 	$dataf4 = "BANK";
		// } else {
		// 	$dataf4 = "TRANSFER";
		// }

		$query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE kd_jenis = '$_POST[$f1]' ");

		if ($query->num_rows > 0) {
			echo "<script>alert('Data sudah terdaftar');</script>";
			echo "<script>history.go(-1)</script>";
			//header("location: ../../main.php?route=alat_bayar&act", true, 301);
			exit();
		} else {

			$query = "INSERT INTO $tabel (
				$f1, $f2, $f4) 
				VALUES (
					'$_POST[$f1]', 
					'$_POST[$f2]',  
					'$pilihan'
				
				)";
				// var_dump($query);
				$result = mysqli_query($koneksi, $query);
				if (!$result) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
						" - " . mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil ditambah.');</script>";
					echo "<script>history.go(-2)</script>";
				}
		
			// $gambar_produk = $_FILES['photo']['name'];

			//cek dulu jika ada gambar produk jalankan coding ini
			// if ($gambar_produk != "") {
			// 	$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
			// 	$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
			// 	$ekstensi = strtolower(end($x));
			// 	$file_tmp = $_FILES['photo']['tmp_name'];
			// 	if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
			// 		move_uploaded_file($file_tmp, '../../../../images/jenis_transaksi/' . $gambar_produk); //memindah file gambar ke folder gambar
			// 		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6) 
			// 		VALUES (
			// 			'$_POST[$f1]', 
			// 			'$_POST[$f2]', 
			// 			'$gambar_produk', 
			// 			'$dataf4', 
			// 			Null, 
			// 			Null
			// 		)";
			// 		$result = mysqli_query($koneksi, $query);

			// 		if (!$result) {
			// 			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
			// 				" - " . mysqli_error($koneksi));
			// 		} else {
			// 			echo "<script>alert('Data berhasil ditambah.');</script>";
			// 			echo "<script>history.go(-2)</script>";
			// 		}
			// 	} else {
			// 		echo "<script>alert('Ekstensi gambar yang boleh hanya jpg , bmp , jpeg atau png.');</script>";
			// 		echo "<script>history.go(-1)</script>";
			// 	}
			// } else {
			// 	$query = "INSERT INTO $tabel (
			// 	$f1, $f2, $f4, $f5, $f6) 
			// 	VALUES (
			// 		'$_POST[$f1]', 
			// 		'$_POST[$f2]',  
			// 		'$dataf4', 
			// 		Null, 
			// 		Null
			// 	)";
			// 	// var_dump($query);
			// 	$result = mysqli_query($koneksi, $query);
			// 	if (!$result) {
			// 		die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
			// 			" - " . mysqli_error($koneksi));
			// 	} else {
			// 		echo "<script>alert('Data berhasil ditambah.');</script>";
			// 		// echo "<script>history.go(-2)</script>";
			// 	}
			// }
		}
	} elseif ($route == $tujuan and $act == 'edit') {

		$pilihan = $_POST['pilihan'];

		if ($pilihan == "1") {
			$dataf4 = "BANK";
		} else {
			$dataf4 = "TRANSFER";
		}

		$query  = "UPDATE $tabel SET 
			$f2 = '$_POST[$f2]', 
			$f4 = '$pilihan'";
			$query .= "WHERE $f1 = '$_POST[$f1]' ";
			$result = mysqli_query($koneksi, $query);
			// periska query apakah ada error

		if (!$result) {
			die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			//tampil alert dan akan redirect ke halaman index.php
			//silahkan ganti index.php sesuai halaman yang akan dituju
			echo "<script>alert('Data berhasil diubah.')</script>";
			echo "<script>history.go(-2)</script>";
		}

		// $photo = $_FILES['photo']['name'];

		//cek dulu jika merubah gambar produk jalankan coding ini
		// if ($photo != "") {
		// 	$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'bmp'); //ekstensi file gambar yang bisa diupload 
		// 	$x = explode('.', $photo); //memisahkan nama file dengan ekstensi yang diupload
		// 	$ekstensi = strtolower(end($x));
		// 	$file_tmp = $_FILES['photo']['tmp_name'];
		// 	if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
		// 		move_uploaded_file($file_tmp, '../../../../images/jenis_transaksi/' . $photo); //memindah file gambar ke folder gambar

		// 		$query  = "UPDATE $tabel SET 
		// 		$f2 = '$_POST[$f2]', 
		// 		$f4 = '$dataf4',
		// 		photo = '$photo'";
		// 		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 		if (!$result) {
		// 			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
		// 				" - " . mysqli_error($koneksi));
		// 		} else {
		// 			echo "<script>alert('Data berhasil diubah.')</script>";
		// 			echo "<script>history.go(-2)</script>";
		// 		}
		// 	} else {
		// 		echo "<script>alert('Ekstensi gambar yang boleh hanya jpg jpeg bmp atau png.');</script>";
		// 		echo "<script>history.go(-1)</script>";
		// 	}
		// } else {
		// 	// jalankan query UPDATE berdasarkan ID yang produknya kita edit
		// 	$query  = "UPDATE $tabel SET 
		// 	$f2 = '$_POST[$f2]', 
		// 	$f4 = '$dataf4'";
		// 	$query .= "WHERE $f1 = '$_POST[$f1]' ";
		// 	$result = mysqli_query($koneksi, $query);
		// 	// periska query apakah ada error
		// 	if (!$result) {
		// 		die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
		// 			" - " . mysqli_error($koneksi));
		// 	} else {
		// 		//tampil alert dan akan redirect ke halaman index.php
		// 		//silahkan ganti index.php sesuai halaman yang akan dituju
		// 		echo "<script>alert('Data berhasil diubah.')</script>";
		// 		echo "<script>history.go(-2)</script>";
		// 	}
		// }
	}
}
