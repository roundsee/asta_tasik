<?php

$dir = "../../../../";

$tujuan = 'permintaan_barang';


$judulform = "Permintaan Barang";

$data = 'data_permintaan_barang';
$rute = 'permintaan_barang';
$aksi = 'aksi_permintaan_barang';
$view = 'permintaan_barang_view';

$rute_detail = 'permintaan_barang_detail';

$tabel = 'permintaan_barang';

// Variabel untuk nama kolom tabel permintaan_barang
$f1 = 'kode_permintaan';
$f2 = 'kd_cus_peminta';
$f3 = 'kd_cus_pengirim';
$f4 = 'tanggal_permintaan';
$f5 = 'status_permintaan';
$f6 = 'keterangan';

// Variabel untuk label kolom
$j1 = 'Kode Permintaan';
$j2 = 'Kode Customer Peminta';
$j3 = 'Kode Customer Pengirim';
$j4 = 'Tanggal Permintaan';
$j5 = 'Status Permintaan';
$j6 = 'Keterangan';


$tabel2 = "permintaan_barang_detail";

// Variabel untuk nama kolom tabel permintaan_barang_detail
$ff1 = 'id_detail';
$ff2 = 'kode_permintaan';
$ff3 = 'kd_cus_peminta';
$ff4 = 'kd_barang';
$ff5 = 'nama_barang';
$ff6 = 'qty_diajukan';
$ff7 = 'qty_terkirim';
$ff8 = 'qty_diterima';
$ff9 = 'qty_satuan';
$ff10 = 'satuan';
$ff11 = 'harga';
$ff12 = 'urut';
$ff13 = 'status_item';

// Variabel untuk label kolom
$jj1 = 'ID Detail';
$jj2 = 'Kode Permintaan';
$jj3 = 'Kode Customer Peminta';
$jj4 = 'Kode Barang';
$jj5 = 'Nama Barang';
$jj6 = 'Jumlah Diajukan';
$jj7 = 'Jumlah Terkirim';
$jj8 = 'Jumlah Diterima';
$jj9 = 'Jumlah Satuan';
$jj10 = 'Satuan';
$jj11 = 'Harga';
$jj12 = 'Urut';
$jj13 = 'Status Item';

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

	//Tambah 
	elseif ($route == $tujuan and $act == 'input') {
		$tgl = date('ymd');
		$no_pengajuan = 'AJU-' . $_POST['no_pengajuan'];
		// echo $no_pengajuan;

		$kd_acc = $_POST['kd_acc'];
		// echo '<br/> kd acc = '.$kd_acc;

		$cabang_e = $_SESSION['cabang_e'];
		$area_e = $_SESSION['area_e'];

		if ($cabang_e == '0000') {
			$kode_manajer = sprintf("%02s", $area_e);

			$query = mysqli_query($koneksi, "SELECT * from pengaju where manager='$kode_manajer' ");
			$q = mysqli_fetch_array($query);
		} elseif ($area_e == '0') {
			$kode_cabang = sprintf("%04s", $cabang_e);

			$query = mysqli_query($koneksi, "SELECT * from pengaju where unitkerja='$kode_cabang' ");
			$q = mysqli_fetch_array($query);
		}


		$query = mysqli_query($koneksi, "SELECT max(no_pengajuan) as kodeTerbesar FROM pengajuan where left(no_pengajuan,13)='$no_pengajuan' ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		// echo '<br/> kode 1 :';
		// echo $kodeBarang;

		$urutan = (int) substr($kode, 21, 4);

		echo '<br/> urutan :' . $urutan;

		// echo '<br/> === :';

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;

		$kode = $no_pengajuan . '-' . $tgl . '-' . sprintf("%04s", $urutan);
		echo '<br/> kode :' . $kode;


		$query2 = mysqli_query($koneksi, "SELECT * FROM account WHERE no_account='$kd_acc' ");
		$q2 = mysqli_fetch_array($query2);

		$pph = $q2['pph'];


		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6, $f9,$f16,$f17,$f18) 
		VALUES (
			'$kode', 
			'$_POST[$f2]', 
			'$_POST[$f3]',  
			'$_POST[$f4]',  
			'$_POST[$f5]',  
			'$_POST[$f6]',
			'$_POST[$f9]',
			'$kode_cabang',
			'$kode_manajer',
			'$_POST[$f18]'
		)";
		$result = mysqli_query($koneksi, $query);


		$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7, $ff8) 
		VALUES (
			'$kode', 
			'$kd_acc', 
			'$_POST[$ff3]',  
			'$_POST[$ff4]',  
			'$_POST[$ff7]',
			'$urut'
		)";
		$result2 = mysqli_query($koneksi, $query2);


		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>history.go(-2)</script>";
		}
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
	} elseif ($route == $tujuan and $act == 'input-detail-supllier-barang') {
		// Mengambil data dari form yang dikirim melalui metode POST
		$kdSupp = $_POST['kd_supp'];
		$kdAccArray = $_POST['kd_acc'];

		// Melakukan iterasi melalui setiap elemen dalam array
		foreach ($kdAccArray as $kd_acc) {
			// Menyiapkan query untuk memasukkan data ke tabel supplier_barang
			$query2 = "INSERT INTO supplier_barang (kd_supp, kd_brg) VALUES ('$kdSupp', '$kd_acc')";

			// Menjalankan query
			$result2 = mysqli_query($koneksi, $query2);

			// Cek jika query berhasil dijalankan
			if (!$result2) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
			}
		}

		// Redirect atau notifikasi berhasil
		echo "<script>alert('Data berhasil ditambah.');</script>";
		// echo "<script>history.go(-1)</script>";
		echo "<script>history.go(-1); window.location.href = window.location.href + '?refresh=true';</script>";
	}
	//Tambah baru
	elseif ($route == $tujuan and $act == 'input-baru') {
		$tgl = date('ymd');

		$kd_cus_peminta = $_POST[$f2];
		$tanggal = date("Ymd");

		// Query untuk mendapatkan nomor urut terakhir berdasarkan format kode
		$query = mysqli_query($koneksi, "
			SELECT MAX(CAST(SUBSTRING_INDEX(kode_permintaan, '-', -1) AS UNSIGNED)) AS kodeTerbesar 
			FROM permintaan_barang 
			WHERE kode_permintaan LIKE 'REQ-$tanggal-$kd_cus_peminta-%'
		");
		$data = mysqli_fetch_array($query);

		// Jika ada data, ambil nomor urutan terakhir, jika tidak, mulai dari 0
		$urutan = isset($data['kodeTerbesar']) ? (int) $data['kodeTerbesar'] : 0;
		$urutan++;

		// Buat kode permintaan baru
		$kodeUrut = sprintf("%04s", $urutan);
		$kode_permintaan = "REQ-$tanggal-$kd_cus_peminta-$kodeUrut";





		$query = "INSERT INTO $tabel ( $f1, $f2, $f4,$f3) 
		VALUES (
			'$kode_permintaan', 
			'$_POST[$f2]', 
			'$_POST[$f4]',
			'$_POST[$f3]'
		)";

		// echo $query;

		$result = mysqli_query($koneksi, $query);



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
				$qtyDiajukan = str_replace(".", "", $qtyDiajukanArray[$index]);
				$harga = $hargaArray[$index];
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
					WHERE '$qtySatuan' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5 ) AND kd_brg=  '$kdAcc'");

				// Memeriksa hasil query
				if ($data = mysqli_fetch_array($query)) {
					$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
					$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
				}

				$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE $ff2='$kode_permintaan' ");
				$data = mysqli_fetch_array($query);
				$urut = $data['urut_max'];
				$urut++;



				$query2 = "INSERT INTO $tabel2( $ff2, $ff3, $ff4, $ff5, $ff6, $ff9, $ff10, $ff11, $ff12, user_input)
					VALUES(
						'$kode_permintaan',
						'$_POST[$f2]',
						'$kdAcc',
						'$namaBarang',
						'$qtyDiajukan',
						'$qtySatuan',
						'$satuan',
						'$harga',
						'$urut',
						'$employee'
					)";

				echo "<br>";
				// echo $query2;

				$result2 = mysqli_query($koneksi, $query2);

				if (!$result2) {
					$error_massage = "query Error" . mysqli_error($koneksi);
					echo "<script>alert('$error_massage')</script>";
					die();
				}
			}
		}


		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>window.location='../../main.php?route=permintaan_barang_detail&act&id=$kode_permintaan'</script>";
		}
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
	} elseif ($route == $tujuan and $act == 'selesaikan_permintaan') {

		mysqli_query($koneksi, "UPDATE permintaan_barang SET status_permintaan = 2 WHERE $f1 = '$_GET[id]'");

		echo "<script>alert('Data terupdate selesai ');</script>";
		echo "<script>history.go(-1)</script>";
	}
}
