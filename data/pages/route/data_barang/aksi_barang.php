<?php
$dir = "../../../../";

//$tabel_sebelum="subalat_bayar";
$judulform = "DATA MENU";

$data = 'data_barang';
$tujuan = 'barang';
$aksi = 'aksi_barang';

$tabel = 'barang';

$f1 = 'kd_brg';
$f2 = 'nama';
$f3 = 'harga';
$f_31 = 'hrg_satuan1';
$f_32 = 'hrg_satuan2';
$f_33 = 'hrg_satuan3';
$f_34 = 'hrg_satuan4';
$f_35 = 'hrg_satuan5';
$f_31gr = 'hrg_satuan1_grosir';
$f_32gr = 'hrg_satuan2_grosir';
$f_33gr = 'hrg_satuan3_grosir';
$f_34gr = 'hrg_satuan4_grosir';
$f_35gr = 'hrg_satuan5_grosir';
$f_31ol = 'hrg_satuan1_online';
$f_32ol = 'hrg_satuan2_online';
$f_33ol = 'hrg_satuan3_online';
$f_34ol = 'hrg_satuan4_online';
$f_35ol = 'hrg_satuan5_online';
$f_31ms = 'hrg_satuan1_ms';
$f_32ms = 'hrg_satuan2_ms';
$f_33ms = 'hrg_satuan3_ms';
$f_34ms = 'hrg_satuan4_ms';
$f_35ms = 'hrg_satuan5_ms';
$f_31mg = 'hrg_satuan1_mg';
$f_32mg = 'hrg_satuan2_mg';
$f_33mg = 'hrg_satuan3_mg';
$f_34mg = 'hrg_satuan4_mg';
$f_35mg = 'hrg_satuan5_mg';
$f_31mp = 'hrg_satuan1_mp';
$f_32mp = 'hrg_satuan2_mp';
$f_33mp = 'hrg_satuan3_mp';
$f_34mp = 'hrg_satuan4_mp';
$f_35mp = 'hrg_satuan5_mp';
$f4 = 'satuan';
$f_41 = 'Satuan1';
$f_42 = 'Satuan2';
$f_43 = 'Satuan3';
$f_44 = 'Satuan4';
$f_45 = 'Satuan5';
$f5 = 'kd_subgrup';
$f6 = 'kd_grup';
$f7 = 'photo';
$f8 = 'rating';
$f9 = 'Quantity';
$f_91 = 'qty_satuan1';
$f_92 = 'qty_satuan2';
$f_93 = 'qty_satuan3';
$f_94 = 'qty_satuan4';
$f_95 = 'qty_satuan5';
$f10 = 'Pcs';
$f11 = 'Renteng';
$f12 = 'Pak';
$f13 = 'ikat';
$f14 = 'Ball';
$f15 = 'Box';
$f16 = 'Dus';
$f17 = 'hrg_pcs';
$f18 = 'hrg_renteng';
$f19 = 'hrg_pak';
$f20 = 'hrg_ikat';
$f21 = 'hrg_ball';
$f22 = 'hrg_box';
$f23 = 'hrg_dus';
$f24 = 'disc_pcs';
$f25 = 'disc_renteng';
$f26 = 'disc_pak';
$f27 = 'disc_ikat';
$f28 = 'disc_ball';
$f29 = 'disc_box';
$f30 = 'disc_dus';
$f31 = 'ktg_retail';
$f32 = 'ktg_grosir';
$f33 = 'ktg_online';
$f34 = 'ktg_ms';
$f35 = 'ktg_mg';
$f36 = 'ktg_mp';
$f37 = 'ktg_buffer';


$j1 = 'Kode Barang';
$j2 = 'Nama';
$j3 = 'Hargakat$hargakat';
$j4 = 'Satuan';
$j5 = 'kd_subgrup';
$j6 = 'kd_grup';
$j7 = 'photo';
$j8 = 'rating';
$j9 = 'Quantity';
$j10 = 'Pcs';
$j11 = 'Renteng';
$j12 = 'Pak';
$j13 = 'Ikat';
$j14 = 'Ball';
$j15 = 'Box';
$j16 = 'Dus';
$j17 = 'Hargakat$hargakat Pcs';
$j18 = 'Hargakat$hargakat Renteng';
$j19 = 'Hargakat$hargakat Pak';
$j20 = 'Hargakat$hargakat Ikat';
$j21 = 'Hargakat$hargakat Ball';
$j22 = 'Hargakat$hargakat Box';
$j23 = 'Hargakat$hargakat Dus';
$j24 = 'Disc Pcs';
$j25 = 'Disc Renteng';
$j26 = 'Disc Pak';
$j27 = 'Disc Ikat';
$j28 = 'Disc Ball';
$j29 = 'Disc Box';
$j30 = 'Disc Dus';
$j31 = 'ID kategori Retail';
$j32 = 'ID Kategori Grosir';
$j33 = 'ID Kategori Online';
$j34 = 'ID Kategori Member Silver';
$j35 = 'ID Kategori Member Gold';
$j36 = 'ID Kategori Member Platinum';




$tabelmirror = 'barangnas';

session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	// Hapus area
	if ($route == $tujuan and $act == 'hapus') {
		$id = $_GET['id'];

		// Cek apakah barang ada di tabel penjualan atau pembelian
		$cekPenjualan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pembelian_detail WHERE kd_brg = '$id'");
		$cekPembelian = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jualdetil WHERE kd_brg = '$id'");

		$dataPenjualan = mysqli_fetch_assoc($cekPenjualan);
		$dataPembelian = mysqli_fetch_assoc($cekPembelian);

		// Jika barang tidak ditemukan di kedua tabel, izinkan penghapusan
		if ($dataPenjualan['total'] == 0 && $dataPembelian['total'] == 0) {
			mysqli_query($koneksi, "DELETE FROM $tabel WHERE $f1 = '$id'");
			echo "<script>alert('Data berhasil dihapus');</script>";
		} else {
			echo "<script>alert('Data tidak dapat dihapus karena sudah digunakan dalam transaksi');</script>";
		}

		echo "<script>history.go(-1)</script>";
	}

	//Tambah 
	elseif ($route == $tujuan and $act == 'input') {
		/*
		echo '<br> ' . $f2 . ' = ' . $_POST[$f2];
		echo '<br> ' . $f3 . ' = ' . $_POST[$f3];
		echo '<br> ' . $f4 . ' = ' . $_POST[$f4];
		echo '<br> ' . $f5 . ' = ' . $_POST[$f5];
		echo '<br> ' . $f6 . ' = ' . $_POST[$f6];
		echo '<br> ' . $f7 . ' = ' . $_POST[$f7];
		echo '<br> ' . $f8 . ' = ' . $_POST[$f8];
		echo '<br> ' . $f9 . ' = ' . $_POST[$f9];
		echo '<br> ' . $f10 . ' = ' . $_POST[$f10];
		echo '<br> ' . $f11 . ' = ' . $_POST[$f11];
		echo '<br> ' . $f12 . ' = ' . $_POST[$f12];
		echo '<br> ' . $f13 . ' = ' . $_POST[$f13];
		echo '<br> ' . $f14 . ' = ' . $_POST[$f14];
		echo '<br> ' . $f15 . ' = ' . $_POST[$f15];
		echo '<br> ' . $f16 . ' = ' . $_POST[$f16];
		echo '<br> ' . $f17 . ' = ' . $_POST[$f17];
		echo '<br> ' . $f18 . ' = ' . $_POST[$f18];
		echo '<br> ' . $f19 . ' = ' . $_POST[$f19];
		echo '<br> ' . $f20 . ' = ' . $_POST[$f20];
		echo '<br> ' . $f21 . ' = ' . $_POST[$f21];
		echo '<br> ' . $f22 . ' = ' . $_POST[$f22];
		echo '<br> ' . $f23 . ' = ' . $_POST[$f23];
		echo '<br> ' . $f24 . ' = ' . $_POST[$f24];
		echo '<br> ' . $f25 . ' = ' . $_POST[$f25];
		echo '<br> ' . $f26 . ' = ' . $_POST[$f26];
		echo '<br> ' . $f27 . ' = ' . $_POST[$f27];
		echo '<br> ' . $f28 . ' = ' . $_POST[$f28];
		echo '<br> ' . $f29 . ' = ' . $_POST[$f29];
		echo '<br> ' . $f30 . ' = ' . $_POST[$f30];
		echo '<br> ' . $f31 . ' = ' . $_POST[$f31];
		echo '<br> ' . $f32 . ' = ' . $_POST[$f32];
		*/

		$id = $_POST[$f1];

		$query = mysqli_query($koneksi, "SELECT $f1  FROM $tabel where kd_brg='$id' ");
		$data = mysqli_fetch_array($query);

		$cek = mysqli_num_rows($query);

		if ($cek) {
			echo 'data ada';
			echo "<script>alert('Data tersebut sudah ADA.');</script>";
			echo "<script>history.go(-1)</script>";
			exit();
		}
		// else {
		// 	echo 'data tdk ada';
		// 	echo "<script>history.go(-1)</script>";
		// 	exit();
		// }

		$kodeBarang = $id;

		// $gambar_produk = $_FILES['photo']['name'];

		//cek dulu jika ada gambar produk jalankan coding ini
		// if ($gambar_produk != "") {
		// 	$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
		// 	$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
		// 	$ekstensi = strtolower(end($x));
		// 	$file_tmp = $_FILES['photo']['tmp_name'];

		// 	$namafile = $kodeBarang . '.' . $ekstensi;

		// 	$size = $_FILES['photo']['size']; //untuk mengetahui ukuran file

		// 	if ((in_array($ekstensi, $ekstensi_diperbolehkan) === true) && (($size != 0) && ($size < 100000))) {
		// 		move_uploaded_file($file_tmp, '../../../../images/menu/' . $namafile); //memindah file gambar ke folder gambar
		// 		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f8) 
		// 		VALUES (
		// 			'$kodeBarang', 
		// 			'$_POST[$f2]', 
		// 			'$_POST[$f3]', 
		// 			'$_POST[$f4]', 
		// 			'$namafile'
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
		// 		echo "<script>alert('Ekstensi gambar yang boleh hanya jpg , bmp , jpeg atau png. atau file tsb lebih dari 100 Kb');</script>";
		// 		// echo "<script>history.go(-1)</script>";
		// 	}
		// } else {
		$hargake_1inti = !empty($_POST[$f3]) ? $_POST[$f3] : 0;
		$satuanke_2 = !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL;
		$satuanke_3 = !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL;
		$satuanke_4 = !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL;
		$satuanke_5 = !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL;

		$quantity_1 = !empty($_POST[$f_91]) ? $_POST[$f_91] : 0;
		$quantity_2 = !empty($_POST[$f_92]) ? $_POST[$f_92] : 0;
		$quantity_3 = !empty($_POST[$f_93]) ? $_POST[$f_93] : 0;
		$quantity_4 = !empty($_POST[$f_94]) ? $_POST[$f_94] : 0;
		$quantity_5 = !empty($_POST[$f_95]) ? $_POST[$f_95] : 0;
		$quantitybarang = !empty($_POST[$f9]) ? $_POST[$f9] : 0;
		function realUpTo100($value)
		{
			return ceil($value / 100) * 100;
		}
		function roundUpTo100($value)
		{
			return ceil($value / 100) * 100;
			// return round($value);
		}

		if (empty($_POST['ktg_harga'])) {
			$hargake_values = [];

			$satuanke = [
				2 => !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL,
				3 => !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL,
				4 => !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL,
				5 => !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL
			];
			$quantityke = [
				1 => !empty($_POST[$f_91]) ? $_POST[$f_91] : 0,
				2 => !empty($_POST[$f_92]) ? $_POST[$f_92] : 0,
				3 => !empty($_POST[$f_93]) ? $_POST[$f_93] : 0,
				4 => !empty($_POST[$f_94]) ? $_POST[$f_94] : 0,
				5 => !empty($_POST[$f_95]) ? $_POST[$f_95] : 0
			];
			$previous_hargake = null;

			for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
				switch ($id_kat) {
					case 1:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f31]) ? $_POST[$f31] : NULL;
						$prefixes = '';
						break;
					case 2:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f32]) ? $_POST[$f32] : NULL;
						$prefixes = 'gr';
						break;
					case 3:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f33]) ? $_POST[$f33] : NULL;
						$prefixes = 'ol';
						break;
					case 4:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f34]) ? $_POST[$f34] : NULL;
						$prefixes = 'ms';
						break;
					case 5:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f35]) ? $_POST[$f35] : NULL;
						$prefixes = 'mg';
						break;
					case 6:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f36]) ? $_POST[$f36] : NULL;
						$prefixes = 'mp';
						break;
					default:
						$Nama_kategoriNilaiidkat = "";
						$prefixes = '';
						break;
				}
				$querysql1 = mysqli_query($koneksi, "SELECT 
					IFNULL(layer1, 0) AS layer11,
					IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
					IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
					IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
					IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
				FROM kategori_nilai 
				WHERE Nama_kategoriNilai = '$Nama_kategoriNilaiidkat' AND id_kat = $id_kat");

				if ($s1 = mysqli_fetch_array($querysql1)) {
					$temp_hargake = array_fill(0, 5, 0);

					for ($i = 5; $i >= 1; $i--) {
						if ($i == 1) {
							$temp_hargake[0] = realUpTo100($quantityke[$i] * $hargake_1inti * (1 + $s1["layer11"] / 100));
						} else if (!empty($satuanke[$i])) {
							for ($j = 1; $j <= $i; $j++) {
								$layer_column = "layer{$i}$j";
								// if (($j - 1) == 0) {
								// 	$temp_hargake[$j - 1] = realUpTo100($hargake_1inti + ($hargake_1inti * $s1[$layer_column] / 100));
								// } else {
								$temp_hargake[$j - 1] = roundUpTo100($hargake_1inti * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
							}
							break;
						}
					}
					$previous_hargake = $temp_hargake;

					$hargake_values = array_merge($hargake_values, $temp_hargake);
				} else {
					if ($Nama_kategoriNilaiidkat == 'manual') {
						$temp_hargamanualke = array_fill(0, 5, 0);
						for ($i = 31; $i <= 35; $i++) {
							$fieldName = 'f_' . $i . $prefixes;
							$postKey = ${$fieldName};
							$temp_hargamanualke[$i - 31] = !empty($_POST[$postKey]) ? $_POST[$postKey] : 0;
						}
						$hargake_values = array_merge($hargake_values, $temp_hargamanualke);
					} else if ($previous_hargake !== null) {
						$hargake_values = array_merge($hargake_values, $previous_hargake);
					}
				}
			}

			$query_values = array_map(function ($value) {
				return "'" . roundUpTo100($value) . "'";
			}, $hargake_values);
			// $query_values = array_map(function ($value) {
			// 	return "'" . $value . "'";
			// }, $hargake_values);


			$query = "INSERT INTO $tabel (
				$f1, $f2, $f3, $f_31, $f_32, $f_33, $f_34, $f_35,
				$f_31gr, $f_32gr, $f_33gr, $f_34gr, $f_35gr,
				$f_31ol, $f_32ol, $f_33ol, $f_34ol, $f_35ol,
				$f_31ms, $f_32ms, $f_33ms, $f_34ms, $f_35ms,
				$f_31mg, $f_32mg, $f_33mg, $f_34mg, $f_35mg,
				$f_31mp, $f_32mp, $f_33mp, $f_34mp, $f_35mp,
				$f4, $f_41, $f_42, $f_43, $f_44, $f_45, $f9, $f_91, $f_92, $f_93, $f_94, $f_95, $f31, $f32, $f33, $f34, $f35, $f36, $f37) 
			VALUES (
				'$kodeBarang', 
				'$_POST[$f2]', 
				'$hargake_1inti', 
				" . implode(", ", $query_values) . ", 
				'$_POST[$f4]', 
				'$_POST[$f4]', 
				'$satuanke_2', 
				'$satuanke_3', 
				'$satuanke_4', 
				'$satuanke_5', 
				'$quantitybarang', 
				'$quantity_1', 
				'$quantity_2', 
				'$quantity_3', 
				'$quantity_4', 
				'$quantity_5', 
				'$_POST[$f31]',
				'$_POST[$f32]',
				'$_POST[$f33]',
				'$_POST[$f34]',
				'$_POST[$f35]',
				'$_POST[$f36]',
				'$_POST[$f37]'
			)";


			$result = mysqli_query($koneksi, $query);

			if (!$result) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				echo "<script>alert('Data berhasil ditambah.');</script>";
				echo "<script>history.go(-2)</script>";
			}
			// $hargake_1 = 0;
			// $hargake_2 = 0;
			// $hargake_3 = 0;
			// $hargake_4 = 0;
			// $hargake_5 = 0;

			// $querysql1 = mysqli_query($koneksi, "SELECT 
			// 	IFNULL(layer1,0) AS layer11,
			// 	IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, 
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,
			// 	IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, 
			// 	IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, 
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, 
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, 
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  
			// 	IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, 
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  
			// 	IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
			// 	 FROM kategori_nilai WHERE Nama_kategoriNilai = '$_POST[$f31]' AND id_kat =  1");

			// /*SELECT IFNULL(kategori_nilai.layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 5), '|', -1),0) AS layer55,kategori_nilai.id_kat,kategori_nilai.Nama_kategoriNilai,$tabel.ktg_retail
			// 	FROM $tabel JOIN kategori_nilai ON $tabel.ktg_retail = kategori_nilai.Nama_kategoriNilai 
			// 	where kategori_nilai.id_kat = 1 "*/


			// while ($s1 = mysqli_fetch_array($querysql1)) {
			// 	if (!empty($satuanke_5)) {
			// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer51"] / 100);
			// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer52"] / 100);
			// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer53"] / 100);
			// 		$hargake_4 = $hargake_1inti + ($hargake_1inti * $s1["layer54"] / 100);
			// 		$hargake_5 = $hargake_1inti + ($hargake_1inti * $s1["layer55"] / 100);
			// 	} else if (!empty($satuanke_4)) {
			// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer41"] / 100);
			// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer42"] / 100);
			// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer43"] / 100);
			// 		$hargake_4 = $hargake_1inti + ($hargake_1inti * $s1["layer44"] / 100);
			// 	} else if (!empty($satuanke_3)) {
			// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer31"] / 100);
			// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer32"] / 100);
			// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer33"] / 100);
			// 	} else if (!empty($satuanke_2)) {
			// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer21"] / 100);
			// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer22"] / 100);
			// 	} else if (!empty($_POST[$f4])) {
			// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer11"] / 100);
			// 	}
			// }

			// $hargaroundup_1 = roundUpTo100($hargake_1);
			// $hargaroundup_2 = roundUpTo100($hargake_2);
			// $hargaroundup_3 = roundUpTo100($hargake_3);
			// $hargaroundup_4 = roundUpTo100($hargake_4);
			// $hargaroundup_5 = roundUpTo100($hargake_5);
			// $query = "INSERT INTO $tabel (
			// 		$f1, $f2, $f3, $f_31,$f_32,$f_33,$f_34,$f_35,$f4,$f_41,$f_42,$f_43,$f_44,$f_45, $f9, $f_91,$f_92,$f_93,$f_94,$f_95, $f31,$f32,$f33, $f34,$f35,$f36,$f37) 
			// 	VALUES (
			// 		'$kodeBarang', 
			// 		'$_POST[$f2]', 
			// 		'$hargake_1inti', 
			// 		'$hargaroundup_1', 
			// 		'$hargaroundup_2', 
			// 		'$hargaroundup_3', 
			// 		'$hargaroundup_4', 
			// 		'$hargaroundup_5', 
			// 		'$_POST[$f4]', 
			// 		'$_POST[$f4]', 
			// 		'$satuanke_2', 
			// 		'$satuanke_3', 
			// 		'$satuanke_4', 
			// 		'$satuanke_5', 
			// 		'$quantitybarang', 
			// 		'$quantity_1', 
			// 		'$quantity_2', 
			// 		'$quantity_3', 
			// 		'$quantity_4', 
			// 		'$quantity_5', 
			// 		'$_POST[$f31]',
			// 		'$_POST[$f32]',
			// 		'$_POST[$f33]',
			// 		'$_POST[$f34]',
			// 		'$_POST[$f35]',
			// 		'$_POST[$f36]',
			// 		'$_POST[$f37]'

			// 	)";
			// $result = mysqli_query($koneksi, $query);

			// if (!$result) {
			// 	die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
			// 		" - " . mysqli_error($koneksi));
			// } else {
			// 	echo "<script>alert('Data berhasil ditambah.');</script>";
			// 	echo "<script>history.go(-2)</script>";
			// }
		} else {
			$hargake_values = []; // Array to store all hargake values

			$satuanke = [
				2 => !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL,
				3 => !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL,
				4 => !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL,
				5 => !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL
			];
			$quantityke = [
				1 => !empty($_POST[$f_91]) ? $_POST[$f_91] : 0,
				2 => !empty($_POST[$f_92]) ? $_POST[$f_92] : 0,
				3 => !empty($_POST[$f_93]) ? $_POST[$f_93] : 0,
				4 => !empty($_POST[$f_94]) ? $_POST[$f_94] : 0,
				5 => !empty($_POST[$f_95]) ? $_POST[$f_95] : 0
			];

			$previous_hargake = null; // Store previous hargake values for fallback

			for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
				// Query for the current id_kat
				$querysql1 = mysqli_query($koneksi, "SELECT 
					IFNULL(layer1, 0) AS layer11,
					IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
					IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
					IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
					IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
				FROM kategori_nilai 
				WHERE Nama_kategoriNilai = '$_POST[ktg_harga]' AND id_kat = $id_kat");

				if ($s1 = mysqli_fetch_array($querysql1)) {
					// Initialize temp_hargake array based on satuanke
					$temp_hargake = array_fill(0, 5, 0);

					// Determine which layer to use based on satuanke values
					for ($i = 5; $i >= 1; $i--) {
						if ($i == 1) {
							$temp_hargake[0] = realUpTo100($quantityke[$i] * $hargake_1inti * (1 + $s1["layer11"] / 100));
						} else if (!empty($satuanke[$i])) {
							for ($j = 1; $j <= $i; $j++) {
								$layer_column = "layer{$i}$j";
								$temp_hargake[$j - 1] = roundUpTo100($hargake_1inti * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
							}
							break; // Stop once a matching satuanke is found
						}
					}

					// Use layer 1 if no other layers were selected
					// if (empty($temp_hargake[0])) {
					// 	$temp_hargake[0] = $hargake_1inti + ($hargake_1inti * $s1["layer11"] / 100);
					// }

					// Store the current hargake values for future fallback
					$previous_hargake = $temp_hargake;

					// Merge the calculated hargake values into the final list
					$hargake_values = array_merge($hargake_values, $temp_hargake);
				} else {
					// Use previous hargake values if current id_kat has no data
					if ($previous_hargake !== null) {
						$hargake_values = array_merge($hargake_values, $previous_hargake);
					}
				}
			}

			// Round up all hargake values before inserting into the database
			$query_values = array_map(function ($value) {
				return "'" . roundUpTo100($value) . "'";
			}, $hargake_values);
			// $query_values = array_map(function ($value) {
			// 	return "'" . $value . "'";
			// }, $hargake_values);


			// Prepare SQL insert query
			$query = "INSERT INTO $tabel (
				$f1, $f2, $f3, $f_31, $f_32, $f_33, $f_34, $f_35,
				$f_31gr, $f_32gr, $f_33gr, $f_34gr, $f_35gr,
				$f_31ol, $f_32ol, $f_33ol, $f_34ol, $f_35ol,
				$f_31ms, $f_32ms, $f_33ms, $f_34ms, $f_35ms,
				$f_31mg, $f_32mg, $f_33mg, $f_34mg, $f_35mg,
				$f_31mp, $f_32mp, $f_33mp, $f_34mp, $f_35mp,
				$f4, $f_41, $f_42, $f_43, $f_44, $f_45, $f9, $f_91, $f_92, $f_93, $f_94, $f_95, $f31, $f32, $f33, $f34, $f35, $f36, $f37) 
			VALUES (
				'$kodeBarang', 
				'$_POST[$f2]', 
				'$hargake_1inti', 
				" . implode(", ", $query_values) . ", 
				'$_POST[$f4]', 
				'$_POST[$f4]', 
				'$satuanke_2', 
				'$satuanke_3', 
				'$satuanke_4', 
				'$satuanke_5', 
				'$quantitybarang', 
				'$quantity_1', 
				'$quantity_2', 
				'$quantity_3', 
				'$quantity_4', 
				'$quantity_5', 
				'$_POST[ktg_harga]',
				'$_POST[ktg_harga]',
				'$_POST[ktg_harga]',
				'$_POST[ktg_harga]',
				'$_POST[ktg_harga]',
				'$_POST[ktg_harga]',
				'$_POST[$f37]'
			)";


			$result = mysqli_query($koneksi, $query);

			if (!$result) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				echo "<script>alert('Data berhasil ditambah.');</script>";
				echo "<script>history.go(-2)</script>";
			}
		}
	} elseif ($route == $tujuan and $act == 'edit') {

		// $photo = $_FILES['photo']['name'];
		$hargake_1inti = !empty($_POST[$f3]) ? $_POST[$f3] : 0;
		$satuanke_2 = !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL;
		$satuanke_3 = !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL;
		$satuanke_4 = !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL;
		$satuanke_5 = !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL;

		$quantity_1 = !empty($_POST[$f_91]) ? $_POST[$f_91] : 0;
		$quantity_2 = !empty($_POST[$f_92]) ? $_POST[$f_92] : 0;
		$quantity_3 = !empty($_POST[$f_93]) ? $_POST[$f_93] : 0;
		$quantity_4 = !empty($_POST[$f_94]) ? $_POST[$f_94] : 0;
		$quantity_5 = !empty($_POST[$f_95]) ? $_POST[$f_95] : 0;
		$quantitybarang = !empty($_POST[$f9]) ? $_POST[$f9] : 0;

		function realUpTo100($value)
		{
			return ceil($value / 100) * 100;
		}
		function roundUpTo100($value)
		{
			return ceil($value / 100) * 100;
			// return round($value);
		}
		if (empty($_POST['ktg_harga'])) {
			$hargake_values = [];

			$satuanke = [
				2 => !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL,
				3 => !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL,
				4 => !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL,
				5 => !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL
			];
			$quantityke = [
				1 => !empty($_POST[$f_91]) ? $_POST[$f_91] : 0,
				2 => !empty($_POST[$f_92]) ? $_POST[$f_92] : 0,
				3 => !empty($_POST[$f_93]) ? $_POST[$f_93] : 0,
				4 => !empty($_POST[$f_94]) ? $_POST[$f_94] : 0,
				5 => !empty($_POST[$f_95]) ? $_POST[$f_95] : 0
			];
			$previous_hargake = null;

			for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
				switch ($id_kat) {
					case 1:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f31]) ? $_POST[$f31] : NULL;
						$prefixes = '';
						break;
					case 2:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f32]) ? $_POST[$f32] : NULL;
						$prefixes = 'gr';
						break;
					case 3:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f33]) ? $_POST[$f33] : NULL;
						$prefixes = 'ol';
						break;
					case 4:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f34]) ? $_POST[$f34] : NULL;
						$prefixes = 'ms';
						break;
					case 5:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f35]) ? $_POST[$f35] : NULL;
						$prefixes = 'mg';
						break;
					case 6:
						$Nama_kategoriNilaiidkat = !empty($_POST[$f36]) ? $_POST[$f36] : NULL;
						$prefixes = 'mp';
						break;
					default:
						$Nama_kategoriNilaiidkat = "";
						$prefixes = '';
						break;
				}
				$querysql1 = mysqli_query($koneksi, "SELECT 
					IFNULL(layer1, 0) AS layer11,
					IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
					IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
					IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
					IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
				FROM kategori_nilai 
				WHERE Nama_kategoriNilai = '$Nama_kategoriNilaiidkat' AND id_kat = $id_kat");

				if ($s1 = mysqli_fetch_array($querysql1)) {
					$temp_hargake = array_fill(0, 5, 0);

					for ($i = 5; $i >= 1; $i--) {
						if ($i == 1) {
							$temp_hargake[0] = realUpTo100($quantityke[$i] * $hargake_1inti * (1 + $s1["layer11"] / 100));
						} else if (!empty($satuanke[$i])) {
							for ($j = 1; $j <= $i; $j++) {
								$layer_column = "layer{$i}$j";
								$temp_hargake[$j - 1] = roundUpTo100($hargake_1inti * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
							}
							break;
						}
					}
					$previous_hargake = $temp_hargake;

					$hargake_values = array_merge($hargake_values, $temp_hargake);
				} else {
					if ($Nama_kategoriNilaiidkat == 'manual') {
						$temp_hargamanualke = array_fill(0, 5, 0);
						for ($i = 31; $i <= 35; $i++) {
							$fieldName = 'f_' . $i . $prefixes;
							$postKey = ${$fieldName};
							$temp_hargamanualke[$i - 31] = !empty($_POST[$postKey]) ? $_POST[$postKey] : 0;
						}
						$hargake_values = array_merge($hargake_values, $temp_hargamanualke);
					} else if ($previous_hargake !== null) {
						$hargake_values = array_merge($hargake_values, $previous_hargake);
					}
				}
			}

			$query_values = array_map(function ($value) {
				return "'" . roundUpTo100($value) . "'";
			}, $hargake_values);
			// $query_values = array_map(function ($value) {
			// 	return "'" . $value . "'";
			// }, $hargake_values);

			$query_values = array_map(function ($value) {
				$value = str_replace("'", "", $value);
				return intval($value);
			}, $hargake_values);

			$query  = "UPDATE $tabel SET 
			$f2 = '$_POST[$f2]',
			$f3 = '$hargake_1inti', 
			$f_31 = '{$query_values[0]}',
			$f_32 = '{$query_values[1]}',
			$f_33 = '{$query_values[2]}',
			$f_34 = '{$query_values[3]}',
			$f_35 = '{$query_values[4]}',
			$f_31gr = '{$query_values[5]}',
			$f_32gr = '{$query_values[6]}',
			$f_33gr = '{$query_values[7]}',
			$f_34gr = '{$query_values[8]}',
			$f_35gr = '{$query_values[9]}',
			$f_31ol = '{$query_values[10]}',
			$f_32ol = '{$query_values[11]}',
			$f_33ol = '{$query_values[12]}',
			$f_34ol = '{$query_values[13]}',
			$f_35ol = '{$query_values[14]}',
			$f_31ms = '{$query_values[15]}',
			$f_32ms = '{$query_values[16]}',
			$f_33ms = '{$query_values[17]}',
			$f_34ms = '{$query_values[18]}',
			$f_35ms = '{$query_values[19]}',
			$f_31mg = '{$query_values[20]}',
			$f_32mg = '{$query_values[21]}',
			$f_33mg = '{$query_values[22]}',
			$f_34mg = '{$query_values[23]}',
			$f_35mg = '{$query_values[24]}',
			$f_31mp = '{$query_values[25]}',
			$f_32mp = '{$query_values[26]}',
			$f_33mp = '{$query_values[27]}',
			$f_34mp = '{$query_values[28]}',
			$f_35mp = '{$query_values[29]}',
			$f4 = '$_POST[$f4]', 
			$f_41 = '$_POST[$f4]', 
			$f_42 = '$satuanke_2', 
			$f_43 = '$satuanke_3', 
			$f_44 = '$satuanke_4', 
			$f_45 = '$satuanke_5',
			$f9 = '$quantitybarang', 
			$f_91 = '$quantity_1', 
			$f_92 = '$quantity_2', 
			$f_93 = '$quantity_3', 
			$f_94 = '$quantity_4', 
			$f_95 = '$quantity_5',
			$f31 = '$_POST[$f31]',
			$f32 = '$_POST[$f32]',
			$f33 = '$_POST[$f33]',
			$f34 = '$_POST[$f34]',
			$f35 = '$_POST[$f35]',
			$f36 = '$_POST[$f36]',
			$f37 = '$_POST[$f37]'  
			";
			$query .= "WHERE $f1 = '$_POST[$f1]' ";
			$result = mysqli_query($koneksi, $query);

			if (!$result) {
				die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				echo "<script>alert('Data berhasil diubah.')</script>";
				echo "<script>history.go(-2)</script>";
			}
		} else {
			$hargake_values = []; // Array to store all hargake values

			$satuanke = [
				2 => !empty($_POST[$f_42]) ? $_POST[$f_42] : NULL,
				3 => !empty($_POST[$f_43]) ? $_POST[$f_43] : NULL,
				4 => !empty($_POST[$f_44]) ? $_POST[$f_44] : NULL,
				5 => !empty($_POST[$f_45]) ? $_POST[$f_45] : NULL
			];
			$quantityke = [
				1 => !empty($_POST[$f_91]) ? $_POST[$f_91] : 0,
				2 => !empty($_POST[$f_92]) ? $_POST[$f_92] : 0,
				3 => !empty($_POST[$f_93]) ? $_POST[$f_93] : 0,
				4 => !empty($_POST[$f_94]) ? $_POST[$f_94] : 0,
				5 => !empty($_POST[$f_95]) ? $_POST[$f_95] : 0
			];

			$previous_hargake = null; // Store previous hargake values for fallback

			for ($id_kat = 1; $id_kat <= 6; $id_kat++) {
				// Query for the current id_kat
				$querysql1 = mysqli_query($koneksi, "SELECT 
					IFNULL(layer1, 0) AS layer11,
					IFNULL(SUBSTRING_INDEX(layer2, '|', 1), 0) AS layer21, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1), 0) AS layer22,
					IFNULL(SUBSTRING_INDEX(layer3, '|', 1), 0) AS layer31,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1), 0) AS layer32,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1), 0) AS layer33, 
					IFNULL(SUBSTRING_INDEX(layer4, '|', 1), 0) AS layer41, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1), 0) AS layer42, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1), 0) AS layer43, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1), 0) AS layer44,  
					IFNULL(SUBSTRING_INDEX(layer5, '|', 1), 0) AS layer51,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1), 0) AS layer52, 
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1), 0) AS layer53,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1), 0) AS layer54,  
					IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1), 0) AS layer55
				FROM kategori_nilai 
				WHERE Nama_kategoriNilai = '$_POST[ktg_harga]' AND id_kat = $id_kat");

				if ($s1 = mysqli_fetch_array($querysql1)) {
					// Initialize temp_hargake array based on satuanke
					$temp_hargake = array_fill(0, 5, 0);

					// Determine which layer to use based on satuanke values
					for ($i = 5; $i >= 1; $i--) {
						if ($i == 1) {
							$temp_hargake[0] = realUpTo100($quantityke[$i] * $hargake_1inti * (1 + $s1["layer11"] / 100));
						} else if (!empty($satuanke[$i])) {
							for ($j = 1; $j <= $i; $j++) {
								$layer_column = "layer{$i}$j";
								$temp_hargake[$j - 1] = roundUpTo100($hargake_1inti * $quantityke[$j] * (1 + $s1[$layer_column] / 100));
							}
							break; // Stop once a matching satuanke is found
						}
					}

					// Use layer 1 if no other layers were selected
					// if (empty($temp_hargake[0])) {
					// 	$temp_hargake[0] = $hargake_1inti + ($hargake_1inti * $s1["layer11"] / 100);
					// }

					// Store the current hargake values for future fallback
					$previous_hargake = $temp_hargake;

					// Merge the calculated hargake values into the final list
					$hargake_values = array_merge($hargake_values, $temp_hargake);
				} else {
					// Use previous hargake values if current id_kat has no data
					if ($previous_hargake !== null) {
						$hargake_values = array_merge($hargake_values, $previous_hargake);
					}
				}
			}

			// Round up all hargake values before inserting into the database
			$query_values = array_map(function ($value) {
				return "'" . roundUpTo100($value) . "'";
			}, $hargake_values);
			// $query_values = array_map(function ($value) {
			// 	return "'" . $value . "'";
			// }, $hargake_values);

			$query_values = array_map(function ($value) {
				// Remove single quotes and then convert to integer
				$value = str_replace("'", "", $value);
				return intval($value);
			}, $hargake_values);
			// print_r($query_values);
			$query  = "UPDATE $tabel SET 
			$f2 = '$_POST[$f2]',
			$f3 = '$hargake_1inti', 
    		$f_31 = '{$query_values[0]}',
			$f_32 = '{$query_values[1]}',
			$f_33 = '{$query_values[2]}',
			$f_34 = '{$query_values[3]}',
			$f_35 = '{$query_values[4]}',
			$f_31gr = '{$query_values[5]}',
			$f_32gr = '{$query_values[6]}',
			$f_33gr = '{$query_values[7]}',
			$f_34gr = '{$query_values[8]}',
			$f_35gr = '{$query_values[9]}',
			$f_31ol = '{$query_values[10]}',
			$f_32ol = '{$query_values[11]}',
			$f_33ol = '{$query_values[12]}',
			$f_34ol = '{$query_values[13]}',
			$f_35ol = '{$query_values[14]}',
			$f_31ms = '{$query_values[15]}',
			$f_32ms = '{$query_values[16]}',
			$f_33ms = '{$query_values[17]}',
			$f_34ms = '{$query_values[18]}',
			$f_35ms = '{$query_values[19]}',
			$f_31mg = '{$query_values[20]}',
			$f_32mg = '{$query_values[21]}',
			$f_33mg = '{$query_values[22]}',
			$f_34mg = '{$query_values[23]}',
			$f_35mg = '{$query_values[24]}',
			$f_31mp = '{$query_values[25]}',
			$f_32mp = '{$query_values[26]}',
			$f_33mp = '{$query_values[27]}',
			$f_34mp = '{$query_values[28]}',
			$f_35mp = '{$query_values[29]}',
			$f4 = '$_POST[$f4]', 
			$f_41 = '$_POST[$f4]', 
			$f_42 = '$satuanke_2', 
			$f_43 = '$satuanke_3', 
			$f_44 = '$satuanke_4', 
			$f_45 = '$satuanke_5',
			$f9 = '$quantitybarang', 
			$f_91 = '$quantity_1', 
			$f_92 = '$quantity_2', 
			$f_93 = '$quantity_3', 
			$f_94 = '$quantity_4', 
			$f_95 = '$quantity_5',
			$f31 = '$_POST[ktg_harga]',
			$f32 = '$_POST[ktg_harga]',
			$f33 = '$_POST[ktg_harga]',
			$f34 = '$_POST[ktg_harga]',
			$f35 = '$_POST[ktg_harga]',
			$f36 = '$_POST[ktg_harga]',
			$f37 = '$_POST[$f37]'  
			";
			$query .= "WHERE $f1 = '$_POST[$f1]' ";
			$result = mysqli_query($koneksi, $query);

			if (!$result) {
				die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				echo "<script>alert('Data berhasil diubah.')</script>";
				echo "<script>history.go(-2)</script>";
			}
		}
		// $querysql1 = mysqli_query($koneksi, "SELECT 
		// IFNULL(layer1,0) AS layer11,
		// IFNULL(SUBSTRING_INDEX(layer2, '|', 1),0) AS layer21, 
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer2, '|', 2), '|', -1),0) AS layer22,
		// IFNULL(SUBSTRING_INDEX(layer3, '|', 1),0) AS layer31,  
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 2), '|', -1),0) AS layer32,  
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer3, '|', 3), '|', -1),0) AS layer33, 
		// IFNULL(SUBSTRING_INDEX(layer4, '|', 1),0) AS layer41, 
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 2), '|', -1),0) AS layer42, 
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 3), '|', -1),0) AS layer43, 
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer4, '|', 4), '|', -1),0) AS layer44,  
		// IFNULL(SUBSTRING_INDEX(layer5, '|', 1),0) AS layer51,  
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 2), '|', -1),0) AS layer52, 
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 3), '|', -1),0) AS layer53,  
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 4), '|', -1),0) AS layer54,  
		// IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(layer5, '|', 5), '|', -1),0) AS layer55,id_kat,Nama_kategoriNilai
		//  FROM kategori_nilai WHERE Nama_kategoriNilai = '$_POST[$f31]' AND id_kat =  1");

		// /*SELECT IFNULL(kategori_nilai.layer1,0) AS layer11,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 1),0) AS layer21, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer2, '|', 2), '|', -1),0) AS layer22,IFNULL(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 1),0) AS layer31,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 2), '|', -1),0) AS layer32,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer3, '|', 3), '|', -1),0) AS layer33, IFNULL(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 1),0) AS layer41, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 2), '|', -1),0) AS layer42, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 3), '|', -1),0) AS layer43, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer4, '|', 4), '|', -1),0) AS layer44,  IFNULL(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 1),0) AS layer51,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 2), '|', -1),0) AS layer52, IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 3), '|', -1),0) AS layer53,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 4), '|', -1),0) AS layer54,  IFNULL(SUBSTRING_INDEX(SUBSTRING_INDEX(kategori_nilai.layer5, '|', 5), '|', -1),0) AS layer55,kategori_nilai.id_kat,kategori_nilai.Nama_kategoriNilai,$tabel.ktg_retail
		// FROM $tabel JOIN kategori_nilai ON $tabel.ktg_retail = kategori_nilai.Nama_kategoriNilai 
		// where kategori_nilai.id_kat = 1 "*/


		// while ($s1 = mysqli_fetch_array($querysql1)) {
		// 	if (!empty($satuanke_5)) {
		// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer51"] / 100);
		// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer52"] / 100);
		// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer53"] / 100);
		// 		$hargake_4 = $hargake_1inti + ($hargake_1inti * $s1["layer54"] / 100);
		// 		$hargake_5 = $hargake_1inti + ($hargake_1inti * $s1["layer55"] / 100);
		// 	} else if (!empty($satuanke_4)) {
		// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer41"] / 100);
		// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer42"] / 100);
		// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer43"] / 100);
		// 		$hargake_4 = $hargake_1inti + ($hargake_1inti * $s1["layer44"] / 100);
		// 	} else if (!empty($satuanke_3)) {
		// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer31"] / 100);
		// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer32"] / 100);
		// 		$hargake_3 = $hargake_1inti + ($hargake_1inti * $s1["layer33"] / 100);
		// 	} else if (!empty($satuanke_2)) {
		// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer21"] / 100);
		// 		$hargake_2 = $hargake_1inti + ($hargake_1inti * $s1["layer22"] / 100);
		// 	} else if (!empty($_POST[$f4])) {
		// 		$hargake_1 = $hargake_1inti + ($hargake_1inti * $s1["layer11"] / 100);
		// 	}
		// }
		// function roundUpTo100($value)
		// {
		// 	return ceil($value / 100) * 100;
		// }

		// $hargaroundup_1 = roundUpTo100($hargake_1);
		// $hargaroundup_2 = roundUpTo100($hargake_2);
		// $hargaroundup_3 = roundUpTo100($hargake_3);
		// $hargaroundup_4 = roundUpTo100($hargake_4);
		// $hargaroundup_5 = roundUpTo100($hargake_5);
		//cek dulu jika merubah gambar produk jalankan coding ini
		// if ($photo != "") {
		// 	$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'bmp'); //ekstensi file gambar yang bisa diupload 
		// 	$x = explode('.', $photo); //memisahkan nama file dengan ekstensi yang diupload
		// 	$ekstensi = strtolower(end($x));
		// 	$file_tmp = $_FILES['photo']['tmp_name'];
		// 	$namafile = $kd_brg . '.' . $ekstensi;

		// 	$size = $_FILES['photo']['size']; //untuk mengetahui ukuran file


		// 	if ((in_array($ekstensi, $ekstensi_diperbolehkan) === true) && (($size != 0) && ($size < 100000))) {
		// 		// move_uploaded_file($file_tmp, '../../../../images/menu/'.$photo); //memindah file gambar ke folder gambar
		// 		move_uploaded_file($file_tmp, '../../../../images/menu/' . $namafile);

		// 		$query  = "UPDATE $tabel SET     			
		// 	$f2 = '$_POST[$f2]',
		// 	$f3 = '$hargake_1inti', 
		// 	$f_31 = '$hargaroundup_1', 
		// 	$f_32 = '$hargaroundup_2', 
		// 	$f_33 = '$hargaroundup_3', 
		// 	$f_34 = '$hargaroundup_4', 
		// 	$f_35 = '$hargaroundup_5', 
		// 	$f4 = '$_POST[$f4]', 
		// 	$f_41 = '$_POST[$f4]', 
		// 	$f_42 = '$_POST[$f_42]', 
		// 	$f_43 = '$_POST[$f_43]', 
		// 	$f_44 = '$_POST[$f_44]', 
		// 	$f_45 = '$_POST[$f_45]', 
		// 	photo = '$namafile', 
		// 	$f9 = '$quantitybarang', 
		// 	$f_91 = '$_POST[$f_91]', 
		// 	$f_92 = '$_POST[$f_92]', 
		// 	$f_93 = '$_POST[$f_93]', 
		// 	$f_94 = '$_POST[$f_94]', 
		// 	$f_95 = '$_POST[$f_95]', 
		// 	$f31 = '$_POST[$f31]',
		// 	$f32 = '$_POST[$f32]',
		// 	$f33 = '$_POST[$f33]',
		// 	$f34 = '$_POST[$f34]',
		// 	$f35 = '$_POST[$f35]',
		// 	$f36 = '$_POST[$f36]',
		// 	$f37 = '$_POST[$f37]'  

		// 	";
		// 		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		// 		$result = mysqli_query($koneksi, $query);

		// 		$query2  = "UPDATE $tabelmirror SET 
		// 	$f2 = '$_POST[$f2]',
		// 	$f3 = '$_POST[$f3]' ";
		// 		$query2 .= "WHERE $f1 = '$_POST[$f1]' ";
		// 		$result2 = mysqli_query($koneksi, $query2);

		// 		if (!$result) {
		// 			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
		// 				" - " . mysqli_error($koneksi));
		// 		} else {
		// 			echo "<script>alert('Data berhasil diubahh.')</script>";
		// 			echo "<script>history.go(-2)</script>";
		// 		}
		// 	} else {
		// 		echo "<script>alert('Ekstensi gambar yang boleh hanya jpg jpeg bmp atau png. atau file tsb lebih dari 100 Kb');</script>";
		// 		echo "<script>history.go(-1)</script>";
		// 	}
		// } else {
		// jalankan query UPDATE berdasarkan ID yang produknya kita edit
		// $query  = "UPDATE $tabel SET 
		// 	$f2 = '$_POST[$f2]',
		// 	$f3 = '$hargake_1inti', 
		// 	$f_31 = '$hargaroundup_1', 
		// 	$f_32 = '$hargaroundup_2', 
		// 	$f_33 = '$hargaroundup_3', 
		// 	$f_34 = '$hargaroundup_4', 
		// 	$f_35 = '$hargaroundup_5', 
		// 	$f4 = '$_POST[$f4]', 
		// 	$f_41 = '$_POST[$f4]', 
		// 	$f_42 = '$_POST[$f_42]', 
		// 	$f_43 = '$_POST[$f_43]', 
		// 	$f_44 = '$_POST[$f_44]', 
		// 	$f_45 = '$_POST[$f_45]',
		// 	$f9 = '$quantitybarang', 
		// 	$f_91 = '$_POST[$f_91]', 
		// 	$f_92 = '$_POST[$f_92]', 
		// 	$f_93 = '$_POST[$f_93]', 
		// 	$f_94 = '$_POST[$f_94]', 
		// 	$f_95 = '$_POST[$f_95]',
		// 	$f31 = '$_POST[$f31]',
		// 	$f32 = '$_POST[$f32]',
		// 	$f33 = '$_POST[$f33]',
		// 	$f34 = '$_POST[$f34]',
		// 	$f35 = '$_POST[$f35]',
		// 	$f36 = '$_POST[$f36]',
		// 	$f37 = '$_POST[$f37]'  
		// ";
		// $query .= "WHERE $f1 = '$_POST[$f1]' ";
		// $result = mysqli_query($koneksi, $query);

		// if (!$result) {
		// 	die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
		// 		" - " . mysqli_error($koneksi));
		// } else {
		// 	echo "<script>alert('Data berhasil diubah.')</script>";
		// 	echo "<script>history.go(-2)</script>";
		// }
	} elseif ($route == $tujuan and $act == 'tes') {
		$query = "SELECT kd_brg,id_kat_satuan,hrg_pcs FROM barang";
		$result = mysqli_query($koneksi, $query);

		while ($row = mysqli_fetch_assoc($result)) {
			if (!empty($row["id_kat_satuan"]) && !empty($row["hrg_pcs"])) {
				$idbarang = $row["kd_brg"];
				$idkatbarang = $row["id_kat_satuan"];
				$hargakat = floatval($row["hrg_pcs"]);
				$querykat = "SELECT id_kat_satuan,Satuan_1,Satuan_2,Satuan_3,Satuan_4,Satuan_5,nilai1,nilai2,nilai3,nilai4,nilai5 FROM `kategori_satuan` JOIN `kategori_nilai` ON kategori_nilai.id_kategoriNilai = LEFT(kategori_satuan.id_kat_satuan,1) WHERE id_kat_satuan = '$idkatbarang';";
				$resultkat = mysqli_query($koneksi, $querykat);
				$row2 = mysqli_fetch_assoc($resultkat);

				$Satuan_1 = $row2["Satuan_1"];
				$Satuan_2 = empty($row2["Satuan_2"]) ? $Satuan_1 : $row2["Satuan_2"];
				$Satuan_3 = empty($row2["Satuan_3"]) ? $Satuan_1 : $row2["Satuan_3"];
				$Satuan_4 = empty($row2["Satuan_4"]) ? $Satuan_1 : $row2["Satuan_4"];
				$Satuan_5 = empty($row2["Satuan_5"]) ? $Satuan_1 : $row2["Satuan_5"];

				$nilai1 = $hargakat + ($hargakat * floatval($row2["nilai1"]) / 100);
				$nilai2 = empty($row2["Satuan_2"]) ? $nilai1 : $hargakat + ($hargakat * floatval($row2["nilai2"]) / 100);
				$nilai3 = empty($row2["Satuan_3"]) ? $nilai1 : $hargakat + ($hargakat * floatval($row2["nilai3"]) / 100);
				$nilai4 = empty($row2["Satuan_4"]) ? $nilai1 : $hargakat + ($hargakat * floatval($row2["nilai4"]) / 100);
				$nilai5 = empty($row2["Satuan_5"]) ? $nilai1 : $hargakat + ($hargakat * floatval($row2["nilai5"]) / 100);

				$queryupdate  = "UPDATE $tabel SET 
				`$Satuan_1`='$nilai1', 
				`$Satuan_2`='$nilai2', 
				`$Satuan_3`='$nilai3', 
				`$Satuan_4`='$nilai4', 
				`$Satuan_5`='$nilai5' WHERE `kd_brg` = '$idbarang';";
				$resultupdate = mysqli_query($koneksi, $queryupdate);
			}
		}
		echo "<script>alert('Harga berhasil diubah.')</script>";
		echo "<script>history.back()</script>";
	} else if ($route == $tujuan and $act == 'hide') {
		$id = $_GET['id'];
		mysqli_query($koneksi, "UPDATE $tabel SET kd_subgrup = 'deleted' WHERE $f1 = '$id'");

		echo "<script>alert('Data berhasil di hide');</script>";
		header("Location: ../../main.php?route=barang&act&ide=" . $_SESSION['employee_number'] . "&asal=barang");
		exit;
	} else if ($route == $tujuan and $act == 'undo_hide') {
		$id = $_GET['id'];
		mysqli_query($koneksi, "UPDATE $tabel SET kd_subgrup = NULL WHERE $f1 = '$id'");

		echo "<script>alert('Data berhasil di-restore');</script>";
		header("Location: ../../main.php?route=barang&act&ide=" . $_SESSION['employee_number'] . "&asal=barang");
		exit;
	} elseif ($route == $tujuan && $act == 'edit_idbarang') {
		// Get POST data
		$field_name = $_POST['field_name'] ?? null;
		$new_value = $_POST[$field_name] ?? null;
		$old_value = $_POST['old_value'] ?? null;

		// Debug: show what we're working with
		// echo "DEBUG:<br>";
		// echo "Field Name: $field_name<br>";
		// echo "New Value: $new_value<br>";
		// echo "Old Value: $old_value<br><br>";

		// Validation
		if (empty($field_name) || empty($new_value) || empty($old_value)) {
			echo "<script>alert('Semua field harus diisi.'); history.go(-1);</script>";
			exit;
		}

		// Check if 'barang' table exists before starting transaction
		$check_barang = mysqli_query($koneksi, "SHOW TABLES LIKE 'barang'");
		if (mysqli_num_rows($check_barang) == 0) {
			echo "<script>alert('Tabel barang tidak ditemukan di database.');</script>";
			exit;
		}

		// Start transaction
		mysqli_autocommit($koneksi, false);
		$success = true;
		$main_table_updated = false;

		// Tables and their SQL queries (use backticks for safety)
		$tables_to_update = [
			[
				'table' => 'barang',
				'sql' => "UPDATE `barang` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'Main barang table'
			],
			[
				'table' => 'assembly_components',
				'sql' => "UPDATE `assembly_components` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'Assembly components table'
			],
			[
				'table' => 'assembly_results',
				'sql' => "UPDATE `assembly_results` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'Assembly results table'
			],
			[
				'table' => 'batal_jualdetil',
				'sql' => "UPDATE `batal_jualdetil` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'batal_jualdetil table'
			],
			[
				'table' => 'jualdetil',
				'sql' => "UPDATE `jualdetil` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'jualdetil table'
			],
			[
				'table' => 'inventory',
				'sql' => "UPDATE `inventory` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'inventory table'
			],
			[
				'table' => 'mutasi_stok',
				'sql' => "UPDATE `mutasi_stok` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'mutasi_stok table'
			],
			[
				'table' => 'payment_detail',
				'sql' => "UPDATE `payment_detail` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'payment_detail table'
			],
			[
				'table' => 'pembelian_detail',
				'sql' => "UPDATE `pembelian_detail` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'pembelian_detail table'
			],
			[
				'table' => 'pembelian_invoice_detail',
				'sql' => "UPDATE `pembelian_invoice_detail` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'pembelian_invoice_detail table'
			],
			[
				'table' => 'penerimaan_barang',
				'sql' => "UPDATE `penerimaan_barang` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'penerimaan_barang table'
			],
			[
				'table' => 'penerimaan_barang_detail_internal',
				'sql' => "UPDATE `penerimaan_barang_detail_internal` SET `kd_barang` = ? WHERE `kd_barang` = ?",
				'description' => 'penerimaan_barang_detail_internal table'
			],
			[
				'table' => 'pengiriman_barang_detail_internal',
				'sql' => "UPDATE `pengiriman_barang_detail_internal` SET `kd_barang` = ? WHERE `kd_barang` = ?",
				'description' => 'pengiriman_barang_detail_internal table'
			],
			[
				'table' => 'permintaan_barang_detail',
				'sql' => "UPDATE `permintaan_barang_detail` SET `kd_barang` = ? WHERE `kd_barang` = ?",
				'description' => 'permintaan_barang_detail table'
			],
			[
				'table' => 'retur_pembelian',
				'sql' => "UPDATE `retur_pembelian` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'retur_pembelian table'
			],
			[
				'table' => 'retur_penjualan',
				'sql' => "UPDATE `retur_penjualan` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'retur_penjualan table'
			],
			[
				'table' => 'stok_opname',
				'sql' => "UPDATE `stok_opname` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'stok_opname table'
			],
			[
				'table' => 'supplier_barang',
				'sql' => "UPDATE `supplier_barang` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'supplier_barang table'
			],
			[
				'table' => 'transfer_inventory_detail',
				'sql' => "UPDATE `transfer_inventory_detail` SET `kd_brg` = ? WHERE `kd_brg` = ?",
				'description' => 'transfer_inventory_detail table'
			]
		];

		// Loop through tables and execute updates
		foreach ($tables_to_update as $table_info) {
			echo "Processing table: {$table_info['table']}<br>";

			$stmt = mysqli_prepare($koneksi, $table_info['sql']);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, "ss", $new_value, $old_value);
				if (!mysqli_stmt_execute($stmt)) {
					$success = false;
					echo "❌ Gagal eksekusi di tabel {$table_info['table']}: " . mysqli_stmt_error($stmt) . "<br>";
				} else {
					$affected = mysqli_stmt_affected_rows($stmt);
					echo "✅ Tabel {$table_info['table']} - Baris terpengaruh: $affected<br>";

					if ($table_info['table'] === 'barang' && $affected > 0) {
						$main_table_updated = true;
					}
				}
				mysqli_stmt_close($stmt);
			} else {
				$success = false;
				echo "❌ Prepare gagal untuk tabel {$table_info['table']}: " . mysqli_error($koneksi) . "<br>";
			}
		}

		// Commit or rollback based on results
		if ($success && $main_table_updated) {
			mysqli_commit($koneksi);
			mysqli_autocommit($koneksi, true);
			echo "<script>alert('✅ Data berhasil diubah.'); history.go(-2);</script>";
		} else {
			if (!$main_table_updated) {
				echo "<script>alert('⚠️ Tidak ada perubahan pada tabel barang.');</script>";
			}
			mysqli_rollback($koneksi);
			mysqli_autocommit($koneksi, true);
			echo "<script>alert('❌ Data gagal diubah.'); history.go(-2);</script>";
		}
	}
}
