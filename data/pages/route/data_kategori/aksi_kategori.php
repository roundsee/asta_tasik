<?php
session_start();

$tabel = 'kategori';

$f1 = 'Nama_kategoriNilai';
$f2 = 'layer1';
$f31 = 'layer21';
$f32 = 'layer22';

$f41 = 'layer31';
$f42 = 'layer32';
$f43 = 'layer33';

$f51 = 'layer41';
$f52 = 'layer42';
$f53 = 'layer43';
$f54 = 'layer44';

$f61 = 'layer51';
$f62 = 'layer52';
$f63 = 'layer53';
$f64 = 'layer54';
$f65 = 'layer55';

$f7 = 'id_kat';


$j1 = 'Nama Kategori';
$j2 = '1 layer';
$j3 = '2 layer';
$j4 = '3 layer';
$j5 = '4 layer';
$j6 = '5 layer';
$j7 = 'Jenis Kategori';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
 	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include "../../../../config/koneksi.php";
	include "../../../../config/fungsi_kode_otomatis.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	//Hapus Staff
	if ($route == 'kategori' and $act == 'hapus') {
		//habpus staff di tebel employee
		mysqli_query($koneksi, "DELETE from kategori_nilai where Nama_kategoriNilai = '$_GET[id]' AND id_kat = '$_GET[ids2]'");
		//hapus user di tabel user
		// mysqli_query($koneksi,"DELETE from user_login where employee_number='$_GET[ids]'");
		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}

	//Update Staff
	elseif ($route == 'kategori' and $act == 'edit') {
		// echo $_GET['ids'];
		// echo '<br> :' . $_POST[$f3];
		echo "<script>console.log('Debug Objects: " .  $_GET['ids'] . "' );</script>";
		$layer_21 = !empty($_POST[$f31]) ? $_POST[$f31] : 0;
		$layer_22 = !empty($_POST[$f32]) ? $_POST[$f32] : 0;

		$layer_31 = !empty($_POST[$f41]) ? $_POST[$f41] : 0;
		$layer_32 = !empty($_POST[$f42]) ? $_POST[$f42] : 0;
		$layer_33 = !empty($_POST[$f43]) ? $_POST[$f43] : 0;

		$layer_41 = !empty($_POST[$f51]) ? $_POST[$f51] : 0;
		$layer_42 = !empty($_POST[$f52]) ? $_POST[$f52] : 0;
		$layer_43 = !empty($_POST[$f53]) ? $_POST[$f53] : 0;
		$layer_44 = !empty($_POST[$f54]) ? $_POST[$f54] : 0;

		$layer_51 = !empty($_POST[$f61]) ? $_POST[$f61] : 0;
		$layer_52 = !empty($_POST[$f62]) ? $_POST[$f62] : 0;
		$layer_53 = !empty($_POST[$f63]) ? $_POST[$f63] : 0;
		$layer_54 = !empty($_POST[$f64]) ? $_POST[$f64] : 0;
		$layer_55 = !empty($_POST[$f65]) ? $_POST[$f65] : 0;

		$layer1 = !empty($_POST[$f2]) ? $_POST[$f2] : 0;
		$layer2 = $layer_21 . "|" . $layer_22;
		$layer3 = $layer_31 . "|" . $layer_32 . "|" . $layer_33;
		$layer4 = $layer_41 . "|" . $layer_42 . "|" . $layer_43 . "|" . $layer_44;
		$layer5 = $layer_51 . "|" . $layer_52 . "|" . $layer_53 . "|" . $layer_54 . "|" . $layer_55;
		$namaKategoriNilai = $_POST[$f1];

		$simpan = mysqli_query($koneksi, "UPDATE kategori_nilai set 
		`layer1` = '$layer1', 
		`layer2` = '$layer2', 
		`layer3` = '$layer3', 
		`layer4` = '$layer4', 
		`layer5` = '$layer5'
		
		WHERE Nama_kategoriNilai = '$_POST[$f1]' AND id_kat= '$_POST[$f7]'");
		function realUpTo100($value)
		{
			return ceil($value / 100) * 100;
		}
		function roundUpTo100($value)
		{
			return ceil($value / 100) * 100;
			// return round($value);
		}
		if ($_POST[$f7] == 1) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_retail = '$_POST[$f1]'"))['count'];

			// Helper function to round up to the nearest 100

			// Process data in chunks
			while ($offset < $totalRows) {
				// Fetch a chunk of data
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
										 FROM barang 
										 WHERE ktg_retail = '$_POST[$f1]' 
										 LIMIT $chunkSize OFFSET $offset");

				if (mysqli_num_rows($data) == 0) break; // Break if no data is returned

				// Temporary table setup for each chunk
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
									kd_brg VARCHAR(255) PRIMARY KEY,
									hrg_satuan1 DECIMAL(10,2),
									hrg_satuan2 DECIMAL(10,2),
									hrg_satuan3 DECIMAL(10,2),
									hrg_satuan4 DECIMAL(10,2),
									hrg_satuan5 DECIMAL(10,2)
								 )");

				// Insert update values into temporary table in batches
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];

					// Calculate price layers based on available satuan levels directly
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";

					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}

					// Insert into the temporary table
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1, hrg_satuan2, hrg_satuan3, hrg_satuan4, hrg_satuan5) 
									VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
									ON DUPLICATE KEY UPDATE
										hrg_satuan1 = VALUES(hrg_satuan1),
										hrg_satuan2 = VALUES(hrg_satuan2),
										hrg_satuan3 = VALUES(hrg_satuan3),
										hrg_satuan4 = VALUES(hrg_satuan4),
										hrg_satuan5 = VALUES(hrg_satuan5)");
				}

				// Perform batch update on the main table
				mysqli_query($koneksi, "UPDATE barang b
								JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
								SET b.hrg_satuan1 = COALESCE(t.hrg_satuan1, b.hrg_satuan1),
									b.hrg_satuan2 = COALESCE(t.hrg_satuan2, b.hrg_satuan2),
									b.hrg_satuan3 = COALESCE(t.hrg_satuan3, b.hrg_satuan3),
									b.hrg_satuan4 = COALESCE(t.hrg_satuan4, b.hrg_satuan4),
									b.hrg_satuan5 = COALESCE(t.hrg_satuan5, b.hrg_satuan5)");

				// Drop temporary table after updating each chunk
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");

				// Commit after each chunk
				mysqli_commit($koneksi);

				// Move to the next chunk
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 2) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_grosir = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_grosir = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_grosir DECIMAL(10,2),
								hrg_satuan2_grosir DECIMAL(10,2),
								hrg_satuan3_grosir DECIMAL(10,2),
								hrg_satuan4_grosir DECIMAL(10,2),
								hrg_satuan5_grosir DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_grosir, hrg_satuan2_grosir, hrg_satuan3_grosir, hrg_satuan4_grosir, hrg_satuan5_grosir) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_grosir = VALUES(hrg_satuan1_grosir),
									hrg_satuan2_grosir = VALUES(hrg_satuan2_grosir),
									hrg_satuan3_grosir = VALUES(hrg_satuan3_grosir),
									hrg_satuan4_grosir = VALUES(hrg_satuan4_grosir),
									hrg_satuan5_grosir = VALUES(hrg_satuan5_grosir)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_grosir = COALESCE(t.hrg_satuan1_grosir, b.hrg_satuan1_grosir),
								b.hrg_satuan2_grosir = COALESCE(t.hrg_satuan2_grosir, b.hrg_satuan2_grosir),
								b.hrg_satuan3_grosir = COALESCE(t.hrg_satuan3_grosir, b.hrg_satuan3_grosir),
								b.hrg_satuan4_grosir = COALESCE(t.hrg_satuan4_grosir, b.hrg_satuan4_grosir),
								b.hrg_satuan5_grosir = COALESCE(t.hrg_satuan5_grosir, b.hrg_satuan5_grosir)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 3) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_online = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5
									 FROM barang 
									 WHERE ktg_online = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_online DECIMAL(10,2),
								hrg_satuan2_online DECIMAL(10,2),
								hrg_satuan3_online DECIMAL(10,2),
								hrg_satuan4_online DECIMAL(10,2),
								hrg_satuan5_online DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_online, hrg_satuan2_online, hrg_satuan3_online, hrg_satuan4_online, hrg_satuan5_online) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_online = VALUES(hrg_satuan1_online),
									hrg_satuan2_online = VALUES(hrg_satuan2_online),
									hrg_satuan3_online = VALUES(hrg_satuan3_online),
									hrg_satuan4_online = VALUES(hrg_satuan4_online),
									hrg_satuan5_online = VALUES(hrg_satuan5_online)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_online = COALESCE(t.hrg_satuan1_online, b.hrg_satuan1_online),
								b.hrg_satuan2_online = COALESCE(t.hrg_satuan2_online, b.hrg_satuan2_online),
								b.hrg_satuan3_online = COALESCE(t.hrg_satuan3_online, b.hrg_satuan3_online),
								b.hrg_satuan4_online = COALESCE(t.hrg_satuan4_online, b.hrg_satuan4_online),
								b.hrg_satuan5_online = COALESCE(t.hrg_satuan5_online, b.hrg_satuan5_online)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 4) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_ms = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5
									 FROM barang 
									 WHERE ktg_ms = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_ms DECIMAL(10,2),
								hrg_satuan2_ms DECIMAL(10,2),
								hrg_satuan3_ms DECIMAL(10,2),
								hrg_satuan4_ms DECIMAL(10,2),
								hrg_satuan5_ms DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_ms, hrg_satuan2_ms, hrg_satuan3_ms, hrg_satuan4_ms, hrg_satuan5_ms) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_ms = VALUES(hrg_satuan1_ms),
									hrg_satuan2_ms = VALUES(hrg_satuan2_ms),
									hrg_satuan3_ms = VALUES(hrg_satuan3_ms),
									hrg_satuan4_ms = VALUES(hrg_satuan4_ms),
									hrg_satuan5_ms = VALUES(hrg_satuan5_ms)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_ms = COALESCE(t.hrg_satuan1_ms, b.hrg_satuan1_ms),
								b.hrg_satuan2_ms = COALESCE(t.hrg_satuan2_ms, b.hrg_satuan2_ms),
								b.hrg_satuan3_ms = COALESCE(t.hrg_satuan3_ms, b.hrg_satuan3_ms),
								b.hrg_satuan4_ms = COALESCE(t.hrg_satuan4_ms, b.hrg_satuan4_ms),
								b.hrg_satuan5_ms = COALESCE(t.hrg_satuan5_ms, b.hrg_satuan5_ms)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
			$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+1";
			$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
			$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);

			if ($check_barang_data['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 2' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mg = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mg = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mg DECIMAL(10,2),
										hrg_satuan2_mg DECIMAL(10,2),
										hrg_satuan3_mg DECIMAL(10,2),
										hrg_satuan4_mg DECIMAL(10,2),
										hrg_satuan5_mg DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mg, hrg_satuan2_mg, hrg_satuan3_mg, hrg_satuan4_mg, hrg_satuan5_mg) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mg = VALUES(hrg_satuan1_mg),
											hrg_satuan2_mg = VALUES(hrg_satuan2_mg),
											hrg_satuan3_mg = VALUES(hrg_satuan3_mg),
											hrg_satuan4_mg = VALUES(hrg_satuan4_mg),
											hrg_satuan5_mg = VALUES(hrg_satuan5_mg)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mg = COALESCE(t.hrg_satuan1_mg, b.hrg_satuan1_mg),
										b.hrg_satuan2_mg = COALESCE(t.hrg_satuan2_mg, b.hrg_satuan2_mg),
										b.hrg_satuan3_mg = COALESCE(t.hrg_satuan3_mg, b.hrg_satuan3_mg),
										b.hrg_satuan4_mg = COALESCE(t.hrg_satuan4_mg, b.hrg_satuan4_mg),
										b.hrg_satuan5_mg = COALESCE(t.hrg_satuan5_mg, b.hrg_satuan5_mg)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}

			$cek_kategori2 = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+2";
			$cek_kategori_result2 = mysqli_query($koneksi, $cek_kategori2);
			$check_barang_data2 = mysqli_fetch_assoc($cek_kategori_result2);
			if ($check_barang_data2['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 3' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mp = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mp DECIMAL(10,2),
										hrg_satuan2_mp DECIMAL(10,2),
										hrg_satuan3_mp DECIMAL(10,2),
										hrg_satuan4_mp DECIMAL(10,2),
										hrg_satuan5_mp DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
											hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
											hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
											hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
											hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
										b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
										b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
										b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
										b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}
		} else if ($_POST[$f7] == 5) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mg = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_mg = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_mg DECIMAL(10,2),
								hrg_satuan2_mg DECIMAL(10,2),
								hrg_satuan3_mg DECIMAL(10,2),
								hrg_satuan4_mg DECIMAL(10,2),
								hrg_satuan5_mg DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mg, hrg_satuan2_mg, hrg_satuan3_mg, hrg_satuan4_mg, hrg_satuan5_mg) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_mg = VALUES(hrg_satuan1_mg),
									hrg_satuan2_mg = VALUES(hrg_satuan2_mg),
									hrg_satuan3_mg = VALUES(hrg_satuan3_mg),
									hrg_satuan4_mg = VALUES(hrg_satuan4_mg),
									hrg_satuan5_mg = VALUES(hrg_satuan5_mg)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_mg = COALESCE(t.hrg_satuan1_mg, b.hrg_satuan1_mg),
								b.hrg_satuan2_mg = COALESCE(t.hrg_satuan2_mg, b.hrg_satuan2_mg),
								b.hrg_satuan3_mg = COALESCE(t.hrg_satuan3_mg, b.hrg_satuan3_mg),
								b.hrg_satuan4_mg = COALESCE(t.hrg_satuan4_mg, b.hrg_satuan4_mg),
								b.hrg_satuan5_mg = COALESCE(t.hrg_satuan5_mg, b.hrg_satuan5_mg)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
			$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+1";
			$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
			$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);
			if ($check_barang_data['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 3' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mp = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mp DECIMAL(10,2),
										hrg_satuan2_mp DECIMAL(10,2),
										hrg_satuan3_mp DECIMAL(10,2),
										hrg_satuan4_mp DECIMAL(10,2),
										hrg_satuan5_mp DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
											hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
											hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
											hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
											hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
										b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
										b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
										b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
										b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}
		} else if ($_POST[$f7] == 6) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_mp = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_mp DECIMAL(10,2),
								hrg_satuan2_mp DECIMAL(10,2),
								hrg_satuan3_mp DECIMAL(10,2),
								hrg_satuan4_mp DECIMAL(10,2),
								hrg_satuan5_mp DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
									hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
									hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
									hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
									hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
								b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
								b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
								b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
								b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		}

		// $data = mysqli_query($koneksi, "SELECT b.kd_brg,b.ktg_retail,b.Satuan1,b.Satuan2,b.Satuan3,b.Satuan4,b.Satuan5,b.harga,
		// b.hrg_satuan1,b.hrg_satuan2,b.hrg_satuan3,b.hrg_satuan4,b.hrg_satuan5
		//   FROM barang b
		//   WHERE 
		//   ktg_retail = '$_POST[$f1]' ");
		// function roundUpTo100($value)
		// {
		// 	return ceil($value / 100) * 100;
		// }
		// while ($d = mysqli_fetch_array($data)) {
		// 	$datake =  $d['kd_brg'];
		// 	if (!empty($d['Satuan5'])) {
		// 		$hargake_1 = $d['harga'] + ($d['harga'] * $layer_51 / 100);
		// 		$hargake_2 = $d['harga'] + ($d['harga'] * $layer_52 / 100);
		// 		$hargake_3 = $d['harga'] + ($d['harga'] * $layer_53 / 100);
		// 		$hargake_4 = $d['harga'] + ($d['harga'] * $layer_54 / 100);
		// 		$hargake_5 = $d['harga'] + ($d['harga'] * $layer_55 / 100);

		// 		$hargaroundup_1 = roundUpTo100($hargake_1);
		// 		$hargaroundup_2 = roundUpTo100($hargake_2);
		// 		$hargaroundup_3 = roundUpTo100($hargake_3);
		// 		$hargaroundup_4 = roundUpTo100($hargake_4);
		// 		$hargaroundup_5 = roundUpTo100($hargake_5);
		// 		$query  = "UPDATE barang SET 
		// 			hrg_satuan1 = '$hargaroundup_1',
		// 			hrg_satuan2 = '$hargaroundup_2', 
		// 			hrg_satuan3 = '$hargaroundup_3', 
		// 			hrg_satuan4 = '$hargaroundup_4', 
		// 			hrg_satuan5 = '$hargaroundup_5'
		// 		";
		// 		$query .= "WHERE kd_brg = '$datake' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 	} else if (!empty($d['Satuan4'])) {
		// 		$hargake_1 = $d['harga'] + ($d['harga'] * $layer_41 / 100);
		// 		$hargake_2 = $d['harga'] + ($d['harga'] * $layer_42 / 100);
		// 		$hargake_3 = $d['harga'] + ($d['harga'] * $layer_43 / 100);
		// 		$hargake_4 = $d['harga'] + ($d['harga'] * $layer_44 / 100);
		// 		$hargaroundup_1 = roundUpTo100($hargake_1);
		// 		$hargaroundup_2 = roundUpTo100($hargake_2);
		// 		$hargaroundup_3 = roundUpTo100($hargake_3);
		// 		$hargaroundup_4 = roundUpTo100($hargake_4);
		// 		$query  = "UPDATE barang SET 
		// 			hrg_satuan1 = '$hargaroundup_1',
		// 			hrg_satuan2 = '$hargaroundup_2', 
		// 			hrg_satuan3 = '$hargaroundup_3', 
		// 			hrg_satuan4 = '$hargaroundup_4' 
		// 		";
		// 		$query .= "WHERE kd_brg = '$datake' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 	} else if (!empty($d['Satuan3'])) {
		// 		$hargake_1 = $d['harga'] + ($d['harga'] * $layer_31 / 100);
		// 		$hargake_2 = $d['harga'] + ($d['harga'] * $layer_32 / 100);
		// 		$hargake_3 = $d['harga'] + ($d['harga'] * $layer_33 / 100);
		// 		$hargaroundup_1 = roundUpTo100($hargake_1);
		// 		$hargaroundup_2 = roundUpTo100($hargake_2);
		// 		$hargaroundup_3 = roundUpTo100($hargake_3);
		// 		$query  = "UPDATE barang SET 
		// 			hrg_satuan1 = '$hargaroundup_1',
		// 			hrg_satuan2 = '$hargaroundup_2', 
		// 			hrg_satuan3 = '$hargaroundup_3'
		// 		";
		// 		$query .= "WHERE kd_brg = '$datake' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 	} else if (!empty($d['Satuan2'])) {
		// 		$hargake_1 = $d['harga'] + ($d['harga'] * $layer_21 / 100);
		// 		$hargake_2 = $d['harga'] + ($d['harga'] * $layer_22 / 100);
		// 		$hargaroundup_1 = roundUpTo100($hargake_1);
		// 		$hargaroundup_2 = roundUpTo100($hargake_2);
		// 		$query  = "UPDATE barang SET 
		// 			hrg_satuan1 = '$hargaroundup_1',
		// 			hrg_satuan2 = '$hargaroundup_2'
		// 		";
		// 		$query .= "WHERE kd_brg = '$datake' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 	} else if (!empty($d['Satuan1'])) {
		// 		$hargake_1 = $d['harga'] + ($d['harga'] * $layer1 / 100);
		// 		$hargaroundup_1 = roundUpTo100($hargake_1);

		// 		$query  = "UPDATE barang SET 
		// 			hrg_satuan1 = '$hargaroundup_1'";
		// 		$query .= "WHERE kd_brg = '$datake' ";
		// 		$result = mysqli_query($koneksi, $query);
		// 	}
		// }

		//header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
		header('location:../../main.php?route=' . $route . '&act&asal=kategori');
	}

	//Tambah Staff
	elseif ($route == 'kategori' and $act == 'input') {
		$layer_21 = !empty($_POST[$f31]) ? $_POST[$f31] : 0;
		$layer_22 = !empty($_POST[$f32]) ? $_POST[$f32] : 0;

		$layer_31 = !empty($_POST[$f41]) ? $_POST[$f41] : 0;
		$layer_32 = !empty($_POST[$f42]) ? $_POST[$f42] : 0;
		$layer_33 = !empty($_POST[$f43]) ? $_POST[$f43] : 0;

		$layer_41 = !empty($_POST[$f51]) ? $_POST[$f51] : 0;
		$layer_42 = !empty($_POST[$f52]) ? $_POST[$f52] : 0;
		$layer_43 = !empty($_POST[$f53]) ? $_POST[$f53] : 0;
		$layer_44 = !empty($_POST[$f54]) ? $_POST[$f54] : 0;

		$layer_51 = !empty($_POST[$f61]) ? $_POST[$f61] : 0;
		$layer_52 = !empty($_POST[$f62]) ? $_POST[$f62] : 0;
		$layer_53 = !empty($_POST[$f63]) ? $_POST[$f63] : 0;
		$layer_54 = !empty($_POST[$f64]) ? $_POST[$f64] : 0;
		$layer_55 = !empty($_POST[$f65]) ? $_POST[$f65] : 0;

		$layer1 = !empty($_POST[$f2]) ? $_POST[$f2] : 0;
		$layer2 = $layer_21 . "|" . $layer_22;
		$layer3 = $layer_31 . "|" . $layer_32 . "|" . $layer_33;
		$layer4 = $layer_41 . "|" . $layer_42 . "|" . $layer_43 . "|" . $layer_44;
		$layer5 = $layer_51 . "|" . $layer_52 . "|" . $layer_53 . "|" . $layer_54 . "|" . $layer_55;

		$namaKategoriNilai = strtoupper($_POST[$f1]);
		if ($namaKategoriNilai  == 'MANUAL') {
			echo "<script>alert('TIDAK DAPAT MEMBERI NAMA MANUAL!!');</script>";
			echo "<script>history.go(-1)</script>";
			exit();
		}

		$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'";
		$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
		$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);

		if ($check_barang_data['count'] > 0) {
			// Update existing record
			$update = mysqli_query($koneksi, "UPDATE kategori_nilai 
				SET 
					layer1 = '$layer1', 
					layer2 = '$layer2', 
					layer3 = '$layer3', 
					layer4 = '$layer4', 
					layer5 = '$layer5' 
				WHERE id_kat = '$_POST[$f7]' AND Nama_kategoriNilai = '$namaKategoriNilai'");
		} else {
			// echo "masuk sini";
			$simpan = mysqli_query($koneksi, "INSERT INTO `kategori_nilai`(`Nama_kategoriNilai`, `layer1`, `layer2`, `layer3`, `layer4`, `layer5`, `id_kat`)
								values (
									'$namaKategoriNilai',
									'$layer1',
									'$layer2',
									'$layer3',
									'$layer4',
									'$layer5',
									'$_POST[$f7]'
								)");

			if (!$simpan) {
				// Display the error message if the query fails
				echo "Error inserting data: " . mysqli_error($koneksi);
			} else {
				// echo "Data inserted successfully.";
			}
			if ($_POST[$f7] == 5) {
			}
		}
		function realUpTo100($value)
		{
			return ceil($value / 100) * 100;
		}
		function roundUpTo100($value)
		{
			return round($value);
		}

		if ($_POST[$f7] == 1) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_retail = '$_POST[$f1]'"))['count'];

			// Helper function to round up to the nearest 100

			// Process data in chunks
			while ($offset < $totalRows) {
				// Fetch a chunk of data
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
										 FROM barang 
										 WHERE ktg_retail = '$_POST[$f1]' 
										 LIMIT $chunkSize OFFSET $offset");

				if (mysqli_num_rows($data) == 0) break; // Break if no data is returned

				// Temporary table setup for each chunk
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
									kd_brg VARCHAR(255) PRIMARY KEY,
									hrg_satuan1 DECIMAL(10,2),
									hrg_satuan2 DECIMAL(10,2),
									hrg_satuan3 DECIMAL(10,2),
									hrg_satuan4 DECIMAL(10,2),
									hrg_satuan5 DECIMAL(10,2)
								 )");

				// Insert update values into temporary table in batches
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];

					// Calculate price layers based on available satuan levels directly
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";

					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}

					// Insert into the temporary table
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1, hrg_satuan2, hrg_satuan3, hrg_satuan4, hrg_satuan5) 
									VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
									ON DUPLICATE KEY UPDATE
										hrg_satuan1 = VALUES(hrg_satuan1),
										hrg_satuan2 = VALUES(hrg_satuan2),
										hrg_satuan3 = VALUES(hrg_satuan3),
										hrg_satuan4 = VALUES(hrg_satuan4),
										hrg_satuan5 = VALUES(hrg_satuan5)");
				}

				// Perform batch update on the main table
				mysqli_query($koneksi, "UPDATE barang b
								JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
								SET b.hrg_satuan1 = COALESCE(t.hrg_satuan1, b.hrg_satuan1),
									b.hrg_satuan2 = COALESCE(t.hrg_satuan2, b.hrg_satuan2),
									b.hrg_satuan3 = COALESCE(t.hrg_satuan3, b.hrg_satuan3),
									b.hrg_satuan4 = COALESCE(t.hrg_satuan4, b.hrg_satuan4),
									b.hrg_satuan5 = COALESCE(t.hrg_satuan5, b.hrg_satuan5)");

				// Drop temporary table after updating each chunk
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");

				// Commit after each chunk
				mysqli_commit($koneksi);

				// Move to the next chunk
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 2) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_grosir = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_grosir = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_grosir DECIMAL(10,2),
								hrg_satuan2_grosir DECIMAL(10,2),
								hrg_satuan3_grosir DECIMAL(10,2),
								hrg_satuan4_grosir DECIMAL(10,2),
								hrg_satuan5_grosir DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_grosir, hrg_satuan2_grosir, hrg_satuan3_grosir, hrg_satuan4_grosir, hrg_satuan5_grosir) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_grosir = VALUES(hrg_satuan1_grosir),
									hrg_satuan2_grosir = VALUES(hrg_satuan2_grosir),
									hrg_satuan3_grosir = VALUES(hrg_satuan3_grosir),
									hrg_satuan4_grosir = VALUES(hrg_satuan4_grosir),
									hrg_satuan5_grosir = VALUES(hrg_satuan5_grosir)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_grosir = COALESCE(t.hrg_satuan1_grosir, b.hrg_satuan1_grosir),
								b.hrg_satuan2_grosir = COALESCE(t.hrg_satuan2_grosir, b.hrg_satuan2_grosir),
								b.hrg_satuan3_grosir = COALESCE(t.hrg_satuan3_grosir, b.hrg_satuan3_grosir),
								b.hrg_satuan4_grosir = COALESCE(t.hrg_satuan4_grosir, b.hrg_satuan4_grosir),
								b.hrg_satuan5_grosir = COALESCE(t.hrg_satuan5_grosir, b.hrg_satuan5_grosir)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 3) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_online = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_online = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_online DECIMAL(10,2),
								hrg_satuan2_online DECIMAL(10,2),
								hrg_satuan3_online DECIMAL(10,2),
								hrg_satuan4_online DECIMAL(10,2),
								hrg_satuan5_online DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_online, hrg_satuan2_online, hrg_satuan3_online, hrg_satuan4_online, hrg_satuan5_online) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_online = VALUES(hrg_satuan1_online),
									hrg_satuan2_online = VALUES(hrg_satuan2_online),
									hrg_satuan3_online = VALUES(hrg_satuan3_online),
									hrg_satuan4_online = VALUES(hrg_satuan4_online),
									hrg_satuan5_online = VALUES(hrg_satuan5_online)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_online = COALESCE(t.hrg_satuan1_online, b.hrg_satuan1_online),
								b.hrg_satuan2_online = COALESCE(t.hrg_satuan2_online, b.hrg_satuan2_online),
								b.hrg_satuan3_online = COALESCE(t.hrg_satuan3_online, b.hrg_satuan3_online),
								b.hrg_satuan4_online = COALESCE(t.hrg_satuan4_online, b.hrg_satuan4_online),
								b.hrg_satuan5_online = COALESCE(t.hrg_satuan5_online, b.hrg_satuan5_online)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		} else if ($_POST[$f7] == 4) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_ms = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_ms = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_ms DECIMAL(10,2),
								hrg_satuan2_ms DECIMAL(10,2),
								hrg_satuan3_ms DECIMAL(10,2),
								hrg_satuan4_ms DECIMAL(10,2),
								hrg_satuan5_ms DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_ms, hrg_satuan2_ms, hrg_satuan3_ms, hrg_satuan4_ms, hrg_satuan5_ms) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_ms = VALUES(hrg_satuan1_ms),
									hrg_satuan2_ms = VALUES(hrg_satuan2_ms),
									hrg_satuan3_ms = VALUES(hrg_satuan3_ms),
									hrg_satuan4_ms = VALUES(hrg_satuan4_ms),
									hrg_satuan5_ms = VALUES(hrg_satuan5_ms)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_ms = COALESCE(t.hrg_satuan1_ms, b.hrg_satuan1_ms),
								b.hrg_satuan2_ms = COALESCE(t.hrg_satuan2_ms, b.hrg_satuan2_ms),
								b.hrg_satuan3_ms = COALESCE(t.hrg_satuan3_ms, b.hrg_satuan3_ms),
								b.hrg_satuan4_ms = COALESCE(t.hrg_satuan4_ms, b.hrg_satuan4_ms),
								b.hrg_satuan5_ms = COALESCE(t.hrg_satuan5_ms, b.hrg_satuan5_ms)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
			$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+1";
			$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
			$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);

			if ($check_barang_data['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 2' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mg = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mg = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mg DECIMAL(10,2),
										hrg_satuan2_mg DECIMAL(10,2),
										hrg_satuan3_mg DECIMAL(10,2),
										hrg_satuan4_mg DECIMAL(10,2),
										hrg_satuan5_mg DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mg, hrg_satuan2_mg, hrg_satuan3_mg, hrg_satuan4_mg, hrg_satuan5_mg) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mg = VALUES(hrg_satuan1_mg),
											hrg_satuan2_mg = VALUES(hrg_satuan2_mg),
											hrg_satuan3_mg = VALUES(hrg_satuan3_mg),
											hrg_satuan4_mg = VALUES(hrg_satuan4_mg),
											hrg_satuan5_mg = VALUES(hrg_satuan5_mg)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mg = COALESCE(t.hrg_satuan1_mg, b.hrg_satuan1_mg),
										b.hrg_satuan2_mg = COALESCE(t.hrg_satuan2_mg, b.hrg_satuan2_mg),
										b.hrg_satuan3_mg = COALESCE(t.hrg_satuan3_mg, b.hrg_satuan3_mg),
										b.hrg_satuan4_mg = COALESCE(t.hrg_satuan4_mg, b.hrg_satuan4_mg),
										b.hrg_satuan5_mg = COALESCE(t.hrg_satuan5_mg, b.hrg_satuan5_mg)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}

			$cek_kategori2 = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+2";
			$cek_kategori_result2 = mysqli_query($koneksi, $cek_kategori2);
			$check_barang_data2 = mysqli_fetch_assoc($cek_kategori_result2);
			if ($check_barang_data2['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 3' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mp = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mp DECIMAL(10,2),
										hrg_satuan2_mp DECIMAL(10,2),
										hrg_satuan3_mp DECIMAL(10,2),
										hrg_satuan4_mp DECIMAL(10,2),
										hrg_satuan5_mp DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
											hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
											hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
											hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
											hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
										b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
										b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
										b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
										b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}
		} else if ($_POST[$f7] == 5) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mg = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_mg = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_mg DECIMAL(10,2),
								hrg_satuan2_mg DECIMAL(10,2),
								hrg_satuan3_mg DECIMAL(10,2),
								hrg_satuan4_mg DECIMAL(10,2),
								hrg_satuan5_mg DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mg, hrg_satuan2_mg, hrg_satuan3_mg, hrg_satuan4_mg, hrg_satuan5_mg) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_mg = VALUES(hrg_satuan1_mg),
									hrg_satuan2_mg = VALUES(hrg_satuan2_mg),
									hrg_satuan3_mg = VALUES(hrg_satuan3_mg),
									hrg_satuan4_mg = VALUES(hrg_satuan4_mg),
									hrg_satuan5_mg = VALUES(hrg_satuan5_mg)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_mg = COALESCE(t.hrg_satuan1_mg, b.hrg_satuan1_mg),
								b.hrg_satuan2_mg = COALESCE(t.hrg_satuan2_mg, b.hrg_satuan2_mg),
								b.hrg_satuan3_mg = COALESCE(t.hrg_satuan3_mg, b.hrg_satuan3_mg),
								b.hrg_satuan4_mg = COALESCE(t.hrg_satuan4_mg, b.hrg_satuan4_mg),
								b.hrg_satuan5_mg = COALESCE(t.hrg_satuan5_mg, b.hrg_satuan5_mg)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
			$cek_kategori = "SELECT COUNT(*) AS count FROM kategori_nilai WHERE Nama_kategoriNilai='$namaKategoriNilai' AND id_kat = '$_POST[$f7]'+1";
			$cek_kategori_result = mysqli_query($koneksi, $cek_kategori);
			$check_barang_data = mysqli_fetch_assoc($cek_kategori_result);
			if ($check_barang_data['count'] <= 0) {
				echo "<script>console.log('MASUK KE KATEGORI MEMBER 3' );</script>";

				$chunkSize = 5000;
				$offset = 0;
				$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

				while ($offset < $totalRows) {
					$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
											 FROM barang 
											 WHERE ktg_mp = '$_POST[$f1]' 
											 LIMIT $chunkSize OFFSET $offset");
					if (mysqli_num_rows($data) == 0) break;
					mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
										kd_brg VARCHAR(255) PRIMARY KEY,
										hrg_satuan1_mp DECIMAL(10,2),
										hrg_satuan2_mp DECIMAL(10,2),
										hrg_satuan3_mp DECIMAL(10,2),
										hrg_satuan4_mp DECIMAL(10,2),
										hrg_satuan5_mp DECIMAL(10,2)
									 )");
					while ($d = mysqli_fetch_assoc($data)) {
						$harga = $d['harga'];
						$datake = $d['kd_brg'];
						$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
						if (!empty($d['Satuan5'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
							$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
						} elseif (!empty($d['Satuan4'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
							$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
						} elseif (!empty($d['Satuan3'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
							$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
						} elseif (!empty($d['Satuan2'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
							$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
						} elseif (!empty($d['Satuan1'])) {
							$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
						}
						mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
										VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
										ON DUPLICATE KEY UPDATE
											hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
											hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
											hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
											hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
											hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
					}
					mysqli_query($koneksi, "UPDATE barang b
									JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
									SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
										b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
										b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
										b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
										b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
					mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
					mysqli_commit($koneksi);
					$offset += $chunkSize;
				}
			}
		} else if ($_POST[$f7] == 6) {
			$chunkSize = 5000;
			$offset = 0;
			$totalRows = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM barang WHERE ktg_mp = '$_POST[$f1]'"))['count'];

			while ($offset < $totalRows) {
				$data = mysqli_query($koneksi, "SELECT kd_brg, Satuan1, Satuan2, Satuan3, Satuan4, Satuan5, harga,qty_satuan1,qty_satuan2,qty_satuan3,qty_satuan4,qty_satuan5 
									 FROM barang 
									 WHERE ktg_mp = '$_POST[$f1]' 
									 LIMIT $chunkSize OFFSET $offset");
				if (mysqli_num_rows($data) == 0) break;
				mysqli_query($koneksi, "CREATE TEMPORARY TABLE IF NOT EXISTS temp_barang_updates (
								kd_brg VARCHAR(255) PRIMARY KEY,
								hrg_satuan1_mp DECIMAL(10,2),
								hrg_satuan2_mp DECIMAL(10,2),
								hrg_satuan3_mp DECIMAL(10,2),
								hrg_satuan4_mp DECIMAL(10,2),
								hrg_satuan5_mp DECIMAL(10,2)
							 )");
				while ($d = mysqli_fetch_assoc($data)) {
					$harga = $d['harga'];
					$datake = $d['kd_brg'];
					$hrg_satuan1 = $hrg_satuan2 = $hrg_satuan3 = $hrg_satuan4 = $hrg_satuan5 = "NULL";
					if (!empty($d['Satuan5'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_51 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_52 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_53 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_54 / 100));
						$hrg_satuan5 = roundUpTo100($harga * ($d['qty_satuan5'] ?? 0) * (1 + $layer_55 / 100));
					} elseif (!empty($d['Satuan4'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_41 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_42 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_43 / 100));
						$hrg_satuan4 = roundUpTo100($harga * ($d['qty_satuan4'] ?? 0) * (1 + $layer_44 / 100));
					} elseif (!empty($d['Satuan3'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_31 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_32 / 100));
						$hrg_satuan3 = roundUpTo100($harga * ($d['qty_satuan3'] ?? 0) * (1 + $layer_33 / 100));
					} elseif (!empty($d['Satuan2'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer_21 / 100));
						$hrg_satuan2 = roundUpTo100($harga * ($d['qty_satuan2'] ?? 0) * (1 + $layer_22 / 100));
					} elseif (!empty($d['Satuan1'])) {
						$hrg_satuan1 = realUpTo100($harga * ($d['qty_satuan1'] ?? 0) * (1 + $layer1 / 100));
					}
					mysqli_query($koneksi, "INSERT INTO temp_barang_updates (kd_brg, hrg_satuan1_mp, hrg_satuan2_mp, hrg_satuan3_mp, hrg_satuan4_mp, hrg_satuan5_mp) 
								VALUES ('$datake', $hrg_satuan1, $hrg_satuan2, $hrg_satuan3, $hrg_satuan4, $hrg_satuan5)
								ON DUPLICATE KEY UPDATE
									hrg_satuan1_mp = VALUES(hrg_satuan1_mp),
									hrg_satuan2_mp = VALUES(hrg_satuan2_mp),
									hrg_satuan3_mp = VALUES(hrg_satuan3_mp),
									hrg_satuan4_mp = VALUES(hrg_satuan4_mp),
									hrg_satuan5_mp = VALUES(hrg_satuan5_mp)");
				}
				mysqli_query($koneksi, "UPDATE barang b
							JOIN temp_barang_updates t ON b.kd_brg = t.kd_brg
							SET b.hrg_satuan1_mp = COALESCE(t.hrg_satuan1_mp, b.hrg_satuan1_mp),
								b.hrg_satuan2_mp = COALESCE(t.hrg_satuan2_mp, b.hrg_satuan2_mp),
								b.hrg_satuan3_mp = COALESCE(t.hrg_satuan3_mp, b.hrg_satuan3_mp),
								b.hrg_satuan4_mp = COALESCE(t.hrg_satuan4_mp, b.hrg_satuan4_mp),
								b.hrg_satuan5_mp = COALESCE(t.hrg_satuan5_mp, b.hrg_satuan5_mp)");
				mysqli_query($koneksi, "DROP TEMPORARY TABLE IF EXISTS temp_barang_updates");
				mysqli_commit($koneksi);
				$offset += $chunkSize;
			}
		}


		// $simpan=mysql_query("INSERT INTO staff 
		// 							(nama_staff,jabatan,telp,email) 
		// 		values ('$_POST[nama]','$_POST[jabatan]','$_POST[telpon]','$_POST[email]')");

		header('location:../../main.php?route=' . $route . '&act&asal=' . $asal);
	}
}
