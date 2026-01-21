<?php

$dir = "../../../../";

$tujuan = 'stok_opname';


$judulform = "STOK OPNAME ";

$data = 'data_stok_opname';
$rute = 'stok_opname';
$aksi = 'aksi_stok_opname';
$view = 'stok_opname_view';

$rute_detail = 'stok_opname_detail';

$tabel = 'stok_opname';

// Variabel untuk nama kolom tabel stokopname
$f1 = 'tgl_stokopname';
$f2 = 'kd_cus';
$f3 = 'kd_brg';
$f4 = 'jml';
$f5 = 'jml_pcs';
$f6 = 'satuan';
$f7 = 'harga';
$f8 = 'qty_terakhir';
$f9 = 'input_oleh';
$f10 = 'diperintahkan_oleh';

// Variabel untuk label kolom
$j1 = 'Tanggal Stok Opname';
$j2 = 'Kode Customer';
$j3 = 'Kode Barang';
$j4 = 'Jumlah';
$j5 = 'Jumlah (Pcs)';
$j6 = 'Satuan';
$j7 = 'Harga';
$j8 = 'Qty Terakhir';
$j9 = 'Input Oleh';
$j10 = 'Diperintahkan Oleh';

$tabel_attachment = 'pengajuan_attachment';
$fa1 = 'no_pengajuan';
$fa2 = 'tgl';
$fa3 = 'ket';
$fa4 = 'photo';
$fa5 = 'file';

$ja1 = 'No Pengajuan';
$ja2 = 'Tgl';
$ja3 = 'Ket';
$ja4 = 'Photo';
$ja5 = 'File';

$tabel_note = 'pengajuan_note';
$fn1 = 'no_pengajuan';
$fn2 = 'tgl';
$fn3 = 'ket';
$fn4 = 'supervisi';


$jn1 = 'No Pengajuan';
$jn2 = 'Tgl Note';
$jn3 = 'Keterangan';
$jn4 = 'Supervisi';

session_start();
$employee = $_SESSION['employee_number'];



if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";
	include $dir . "config/library.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$employee'");
	$q1 = mysqli_fetch_assoc($query_kdcus);
	$kd_cus = $q1['kd_cus'];


	//Hapus 
	if ($route == $tujuan and $act == 'hapus') {

		mysqli_query($koneksi, "DELETE from $tabel2 where $ff2 = '$_GET[id]'");
		mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");

		echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	} elseif ($route == $tujuan and $act == 'hapus-detail') {


		mysqli_query($koneksi, "DELETE from $tabel2 where $ff2 = '$_GET[id]' AND $ff4='$_GET[id2]' AND $ff12 = '$_GET[id3]' ");

		echo "<script>history.go(-1)</script>";
	}

	//Tambah Detail
	elseif ($route == $tujuan and $act == 'input-detail') {
		$id = $_GET['id'];
		$kodePermintaan = $_POST['kode_permintaan'];
		$kd_cus_penerima = $_POST['kd_cus_penerima'];
		$kdBarangArray = $_POST['kd_acc'];
		$namaBarangArray = $_POST['uraian'];
		$satuanArray = $_POST['satuan'];
		$qtySatuanArray = $_POST['total_pcs'];
		$qtyDiajukanArray = $_POST['jumlah'];
		$hargaArray = $_POST['harga'];

		foreach ($kdBarangArray as $index => $kdBarang) {
			$namaBarang = $namaBarangArray[$index];
			$qtyDiajukan = str_replace(".", "", $qtyDiajukanArray[$index]);
			$harga = str_replace(".", "", $hargaArray[$index]);
			$satuan = $satuanArray[$index];
			$qtySatuan = $qtySatuanArray[$index];


			// Query SQL
			$query = mysqli_query($koneksi, "SELECT kd_brg, nama,
			CASE 
				WHEN qty_satuan1 = '$qtySatuan' THEN Satuan1
				WHEN qty_satuan2 = '$qtySatuan' THEN Satuan2
				WHEN qty_satuan3 = '$qtySatuan' THEN Satuan3
				WHEN qty_satuan4 = '$qtySatuan' THEN Satuan4
				WHEN qty_satuan5 = '$qtySatuan' THEN Satuan5
				ELSE 'Tidak ada'
			END AS satuan,
			CASE 
				WHEN qty_satuan1 = '$qtySatuan' THEN qty_satuan1
				WHEN qty_satuan2 = '$qtySatuan' THEN qty_satuan2
				WHEN qty_satuan3 = '$qtySatuan' THEN qty_satuan3
				WHEN qty_satuan4 = '$qtySatuan' THEN qty_satuan4
				WHEN qty_satuan5 = '$qtySatuan' THEN qty_satuan5
				ELSE NULL
			END AS qty
			 FROM barang
			 WHERE '$qtySatuan' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5) AND kd_brg=  '$kdBarang' ");

			// Memeriksa hasil query
			if ($data = mysqli_fetch_array($query)) {
				$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
				$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
			}




			$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE $ff2='$id' ");
			$data = mysqli_fetch_array($query);
			$urut = $data['urut_max'];
			$urut++;

			$query2 = "INSERT INTO $tabel2( $ff2,$ff3,  $ff4, $ff5, $ff6, $ff9, $ff10, $ff11, $ff12)
					VALUES(
						'$id',
						'$kd_cus_penerima',
						'$kdBarang',
						'$namaBarang',
						'$qtyDiajukan',
						'$qtySatuan',
						'$satuan',
						'$harga',
						'$urut'
					)";
			// printf($query2);
			$result2 = mysqli_query($koneksi, $query2);
		}
		if (!$result2) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>history.go(-1)</script>";
		}
	}
	//Tambah baru
	elseif ($route == $tujuan and $act == 'input-baru') {

		echo "hallo";
		$tgl = date('ymd');

		$kode_cus_stok_opname = $_POST[$f2];
		$diperintahkan_oleh = $_POST[$f10];
		$tanggal = date("Ymd");
		// Query untuk mendapatkan nomor urut terakhir berdasarkan format kode
		$query = mysqli_query($koneksi, "
		SELECT MAX(CAST(SUBSTRING_INDEX(kd_opname, '-', -1) AS UNSIGNED)) AS kodeTerbesar 
		FROM stok_opname 
		WHERE kd_opname LIKE 'STO-$tanggal-$kode_cus_stok_opname-%'
	");
		$data = mysqli_fetch_array($query);

		// Jika ada data, ambil nomor urutan terakhir, jika tidak, mulai dari 0
		$urutan = isset($data['kodeTerbesar']) ? (int) $data['kodeTerbesar'] : 0;
		$urutan++;

		// Buat kode permintaan baru
		$kodeUrut = sprintf("%04s", $urutan);
		$kd_opname = "STO-$tanggal-$kode_cus_stok_opname-$kodeUrut";



		if (isset($_POST['kd_acc'])) {
			// echo "masuk ke kd accnya ada ";
			$kdBarangArray = $_POST['kd_acc'];
			$namaBarangArray = $_POST['uraian'];
			$satuanArray = $_POST['satuan'];
			$qtySatuanArray = $_POST['total_pcs'];
			$qtyDiajukanArray = $_POST['jumlah'];
			$hargaArray = $_POST['price'];





			foreach ($kdBarangArray as $index => $kdAcc) {
				$namaBarang = $namaBarangArray[$index];
				$qtyOpname = str_replace(".", "", $qtyDiajukanArray[$index]);
				$harga = $hargaArray[$index];
				$satuan = $satuanArray[$index];
				$qtySatuan = $qtySatuanArray[$index];



				$sql = "SELECT stok FROM inventory WHERE kd_cus = '$kode_cus_stok_opname'";
				$result = mysqli_query($koneksi, $sql);


				if ($result) {
					if ($row = mysqli_fetch_assoc($result)) {
						$stok = $row['stok'];
					} else {
						$stok = 0;
					}
				} else {
					echo "Error: " . mysqli_error($koneksi);
				}


				// Query SQL
				$query = mysqli_query($koneksi, "SELECT kd_brg, nama,
				CASE 
					WHEN qty_satuan1 = '$qtySatuan' THEN Satuan1
					WHEN qty_satuan2 = '$qtySatuan' THEN Satuan2
					WHEN qty_satuan3 = '$qtySatuan' THEN Satuan3
					WHEN qty_satuan4 = '$qtySatuan' THEN Satuan4
					WHEN qty_satuan5 = '$qtySatuan' THEN Satuan5
					ELSE 'Tidak ada'
				END AS satuan,
				CASE 
					WHEN qty_satuan1 = '$qtySatuan' THEN qty_satuan1
					WHEN qty_satuan2 = '$qtySatuan' THEN qty_satuan2
					WHEN qty_satuan3 = '$qtySatuan' THEN qty_satuan3
					WHEN qty_satuan4 = '$qtySatuan' THEN qty_satuan4
					WHEN qty_satuan5 = '$qtySatuan' THEN qty_satuan5
					ELSE NULL
				END AS qty
					FROM barang
					WHERE '$qtySatuan' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5 ) AND kd_brg=  '$kdAcc'");

				// Memeriksa hasil query
				if ($data = mysqli_fetch_array($query)) {
					$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
					$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
				} else {
					$satuan = 'pcs';
				}

				$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM stok_opname WHERE kd_opname='$kd_opname' ");
				$data = mysqli_fetch_array($query);
				$urut = $data['urut_max'];
				$urut++;



				$query2 = "INSERT INTO stok_opname( kd_opname,tgl_stokopname, kd_cus, kd_brg, jml, jml_pcs, satuan, harga, qty_terakhir, urut, input_oleh,diperintahkan_oleh )
					VALUES(
						'$kd_opname',
						'$tgl',
						'$kode_cus_stok_opname',
						'$kdAcc',
						'$qtyOpname',
						'$qtySatuan',
						'$satuan',
						'$harga',
						'$stok',
						'$urut',
						'$employee',
						'$diperintahkan_oleh'
					)";

				// echo "<br>";
				// print_r($query2);

				$result2 = mysqli_query($koneksi, $query2);

				if (!$result2) {
					$error_massage = "query Error" . mysqli_error($koneksi);
					echo "<script>alert('$error_massage')</script>";
					continue; // Skip ke iterasi berikutnya jika data tidak ditemukan
				}



				// UNTUK UPDATE DAN INSERT KE TABLE MUTASI STOK
				// Cek apakah data dengan tanggal, kd_cus, dan kd_barang_sage yang sama sudah ada
				$query_check = "SELECT * FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kode_cus_stok_opname' AND kd_brg = '$kdAcc'";
				$result_check = mysqli_query($koneksi, $query_check);

				if (mysqli_num_rows($result_check) > 0) {
					// Data sudah ada, update data yang ada dengan menjumlahkan banyak
					$query_update = "UPDATE mutasi_stok SET 
				 stok_opname = ('$qtyOpname' * '$qtySatuan'),
				 nilai_opname = ('$harga' * ('$qtyOpname' * '$qtySatuan'))
			 	 WHERE tgl = '$tgl' AND kd_cus = '$kode_cus_stok_opname' AND kd_brg = '$kdAcc'";
					$result_update = mysqli_query($koneksi, $query_update);

					if (!$result_update) {
						die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
					}
				} else {
					// Data belum ada, masukkan data baru
					$query_insert = "INSERT INTO mutasi_stok (tgl,kd_cus,kd_brg,satuan,
				 	stok_opname, nilai_opname) VALUES (
					   '$tgl', 
					   '$kode_cus_stok_opname', 	
					   '$kdAcc',  
					   'Pcs',
					   '$qtyOpname' * '$qtySatuan',
					   ('$harga' * ('$qtyOpname' * '$qtySatuan'))

				   )";

					$result_insert = mysqli_query($koneksi, $query_insert);

					if (!$result_insert) {
						die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
					}
				}

				// KE MUTASI STOK SELESAI

				// UPDATE ATAU INSERT KE INVENTORY
				// Mengupdate atau menambah ke inventory
				$query_check = "SELECT * FROM inventory WHERE kd_cus = '$kode_cus_stok_opname' AND kd_brg = '$kdAcc' ";
				$result_check = mysqli_query($koneksi, $query_check);

				if (mysqli_num_rows($result_check) > 0) {
					$query_update = "UPDATE inventory SET 
					stok = '$qtyOpname' * '$qtySatuan'
					WHERE kd_cus = '$kode_cus_stok_opname' AND kd_brg = '$kdAcc' ";
					$result_update = mysqli_query($koneksi, $query_update);

					if (!$result_update) {
						die("Query update gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
					}
				} else {
					// Data belum ada, masukkan data baru
					$query_insert = "INSERT INTO inventory (kd_cus,kd_brg,stok,satuan) VALUES (
					'$kode_cus_stok_opname', 
					'$kdAcc',  
					'$qtyOpname' * '$qtySatuan',
					'Pcs'
					)";

					$result_insert = mysqli_query($koneksi, $query_insert);

					if (!$result_insert) {
						die("Query insert gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
					}
				}

				// UPDATE ATAU INSERT KE INVENTORY SELESAI
			}
		}


		echo "<script>alert('Data berhasil ditambah.');</script>";
		echo "<script>window.location='../../main.php?route=stok_opname'</script>";
	}
	//Tambah Langsung
	elseif ($route == $tujuan and $act == 'input-langsung') {
		$tgl = date('ymd');
		$no_pengajuan = 'AJU-' . $_POST['no_pengajuan'];
		// echo $no_pengajuan;

		$kd_acc = $_POST['kd_acc'];
		// echo '<br/> kd acc = '.$kd_acc;


		$query = mysqli_query($koneksi, "SELECT max(no_pengajuan) as kodeTerbesar FROM pengajuan where left(no_pengajuan,12)='$no_pengajuan' ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		// echo '<br/> kode 1 :';
		// echo $kodeBarang;

		$urutan = (int) substr($kode, 20, 4);

		// echo '<br/> urutan :'. $urutan;

		// echo '<br/> === :';

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;

		$kode = $no_pengajuan . '-' . $tgl . '-' . sprintf("%04s", $urutan);
		// echo '<br/> kode :'.$kode;


		$query2 = mysqli_query($koneksi, "SELECT * FROM account WHERE no_account='$kd_acc' ");
		$q2 = mysqli_fetch_array($query2);

		$pph = $q2['pph'];


		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6, $f9) 
		VALUES (
			'$kode', 
			'$_POST[$f2]', 
			'$_POST[$f3]',  
			'$_POST[$f4]',  
			'$_POST[$f5]',  
			'$_POST[$f6]',
			'$_POST[$f9]'
		)";
		$result = mysqli_query($koneksi, $query);

		$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7) 
		VALUES (
			'$kode', 
			'$kd_acc', 
			'$_POST[$ff3]',  
			'$_POST[$ff4]',  
			'$_POST[$ff7]'
		)";
		$result2 = mysqli_query($koneksi, $query2);


		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil ditambah.');</script>";
			// echo "<script>history.go(-2)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit') {

		// echo $ppn;
		$query  = "UPDATE $tabel SET 
		$f3 = '$_POST[$f3]'
		";
		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		$result = mysqli_query($koneksi, $query);
		// var_dump($query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil disimpan.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit-detail') {

		$kode_barang = $_POST[$ff4];
		$qtyDiajukan = $_POST[$ff6];

		$isi =  isset($_POST['isi_hidden']) && is_numeric($_POST['isi_hidden']) ? intval($_POST['isi_hidden']) : 0;
		// Query SQL
		$query = mysqli_query($koneksi, "SELECT kd_brg, nama,
   CASE 
	   WHEN qty_satuan1 = '$isi' THEN Satuan1
	   WHEN qty_satuan2 = '$isi' THEN Satuan2
	   WHEN qty_satuan3 = '$isi' THEN Satuan3
	   WHEN qty_satuan4 = '$isi' THEN Satuan4
	   WHEN qty_satuan5 = '$isi' THEN Satuan5
	   ELSE 'Tidak ada'
   END AS satuan,
   CASE 
	   WHEN qty_satuan1 = '$isi' THEN qty_satuan1
	   WHEN qty_satuan2 = '$isi' THEN qty_satuan2
	   WHEN qty_satuan3 = '$isi' THEN qty_satuan3
	   WHEN qty_satuan4 = '$isi' THEN qty_satuan4
	   WHEN qty_satuan5 = '$isi' THEN qty_satuan5
	   ELSE NULL
   END AS qty
	FROM barang
	WHERE '$isi' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5) AND kd_brg = $kode_barang");

		// Memeriksa hasil query
		if ($data = mysqli_fetch_array($query)) {
			$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
			$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
		}

		// Gunakan query dengan kondisi yang benar-benar integer atau NULL
		$query  = "UPDATE $tabel2 SET 
			$ff10 = '$satuan',
			$ff9 = '$isi',
			$ff6 = '$qtyDiajukan'
		";

		// echo $query;
		$query .= "WHERE $ff2 = '$_GET[id]' AND $ff4 = '$_GET[id2]' AND $ff12='$_GET[id3]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diedit.')</script>";
			echo "<script>history.go(-2)</script>";
		}
	} elseif ($route == $tujuan and $act == 'submit') {

		$query  = "UPDATE $tabel SET 
		submit = 2 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'cancel') {

		$query  = "UPDATE $tabel SET 
		submit = 1 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'pengajuan_ulang') {

		$query  = "UPDATE $tabel SET 
		submit = 0 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	}
	//Input Gambar 
	elseif ($route == 'pengajuan' and $act == 'gambar') {
		// echo "<br/>id :".$_GET['id'];
		$gambar_produk = $_FILES['photo']['name'];
		$ket = $_POST['ket'];
		// echo "<br/>ket :".$ket;
		// echo "<br/>nama :".$gambar_produk;

		//cek dulu jika ada gambar produk jalankan coding ini
		if ($gambar_produk != "") {
			$rand = rand();
			$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
			$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['photo']['tmp_name'];
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				$xx = $rand . '_' . $gambar_produk;
				move_uploaded_file($file_tmp, '../../../../images/attach_photo/' . $rand . '_' . $gambar_produk); //memindah file gambar ke folder gambar

				$query = "INSERT INTO $tabel_attachment ($fa1,$fa3,$fa4) values ('$_GET[id]','$_POST[$fa3]','$xx') ";
				$result = mysqli_query($koneksi, $query);

				if (!$result) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
						" - " . mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil diUpdate.');</script>";
					echo "<script>history.go(-1)</script>";
				}
			} else {
				echo "<script>alert('Ekstensi gambar yang boleh hanya jpg , bmp , jpeg atau png.');</script>";
				echo "<script>history.go(-1)</script>";
			}
		}
	}
	//Input File 
	elseif ($route == 'pengajuan' and $act == 'file') {
		// echo "<br/>id :".$_GET['id'];
		$gambar_produk = $_FILES['file']['name'];
		$ket = $_POST['ket'];
		// echo "<br/>ket :".$ket;
		// echo "<br/>nama :".$gambar_produk;

		//cek dulu jika ada gambar produk jalankan coding ini
		if ($gambar_produk != "") {
			$rand = rand();
			$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
			$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['file']['tmp_name'];
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === false) {
				$xx = $rand . '_' . $gambar_produk;
				move_uploaded_file($file_tmp, '../../../../images/attach_file/' . $rand . '_' . $gambar_produk); //memindah file gambar ke folder gambar

				$query = "INSERT INTO $tabel_attachment ($fa1,$fa2,$fa3,$fa5) values ('$_GET[id]','$tgl_sekarang','$_POST[$fa3]','$xx') ";
				$result = mysqli_query($koneksi, $query);

				if (!$result) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
						" - " . mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil diUpdate.');</script>";
					echo "<script>history.go(-1)</script>";
				}
			} else {
				echo "<script>alert('Ekstensi gambar tidak boleh jpg , bmp , jpeg atau png.');</script>";
				echo "<script>history.go(-1)</script>";
			}
		}
	}

	//nete Input 
	elseif ($route == 'pengajuan' and $act == 'nego-input') {
		// echo "<br/>id :".$_GET['id'];
		// echo "<br/>idp :".$_GET['idp'];


		$query = "INSERT INTO $tabel_note ($fn1,$fn2,$fn3,$fn4) values ('$_GET[id]','$_POST[$fn2]','$_POST[$fn3]','$_POST[$fn4]') ";
		$result = mysqli_query($koneksi, $query);

		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil di Input.');</script>";
			echo "<script>history.go(-2)</script>";
		}
	}
}
