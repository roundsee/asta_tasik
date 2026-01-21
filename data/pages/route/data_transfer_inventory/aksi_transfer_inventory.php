<?php

$dir = "../../../../";


$judulform = "Transfer inventory";

$data = 'data_transfer_inventory';
$rute = 'transfer_inventory';
$aksi = 'aksi_transfer_inventory';
$view = 'transfer_inventory_view';

$tujuan = 'transfer_inventory';


$rute_detail = 'transfer_inventory_detail';
$tabel = 'transfer_inventory';

// Variabel untuk nama kolom tabel transfer_inventory
$f1 = 'nomor_pengiriman';
$f2 = 'tgl_permintaan';
$f3 = 'tgl_dikirim';
$f4 = 'kd_pengirim';
$f5 = 'kd_penerima';
$f6 = 'status_transfer';

// Variabel untuk label kolom
$j1 = 'Nomor Pengiriman';
$j2 = 'Tanggal Permintaan';
$j3 = 'Tanggal Dikirim';
$j4 = 'Kode Pengirim';
$j5 = 'Kode Penerima';
$j6 = 'Status Transfer';

$tabel2 = 'transfer_inventory_detail';

// Variabel untuk nama kolom tabel transfer_inventory_detail
$ff1 = 'nomor_pengiriman';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'jumlah_pcs';
$ff5 = 'jumlah_datang';
$ff6 = 'harga';
$ff7 = 'disc';
$ff8 = 'satuan';
$ff9 = 'urut';

// Variabel untuk label kolom
$jj1 = 'Nomor Pengiriman';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Jumlah PCS';
$jj5 = 'Jumlah Datang';
$jj6 = 'Harga';
$jj7 = 'Diskon';
$jj8 = 'Satuan';
$jj9 = 'Urut';

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

		mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");
		mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]'");

		echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	} elseif ($route == $tujuan and $act == 'hapus-detail') {

		// $query = mysqli_query($koneksi, "SELECT * FROM $tabel2 WHERE no_pengajuan = '$_GET[id]' AND no_account='$_GET[id2]' "); 


		mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]' AND $ff2='$_GET[id2]' AND $ff8 = '$_GET[id3]' ");

		// echo "<script>alert('Data berhasil dihapus ');</script>";
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
		$kodepo = $_POST['kd_po'];
		$jumlahArray = $_POST['jumlah'];
		$kdAccArray = $_POST['kd_acc'];
		$uraianArray = $_POST['uraian'];
		$hargaArray = $_POST['harga'];
		$satuanArray = $_POST['satuan'];
		$jumlahpcsArray = $_POST['total_pcs'];
		$diskonArray = $_POST['diskon'];

		foreach ($jumlahArray as $index => $jumlah) {
			$jumlah_angka = str_replace(".", "", $jumlah);
			$kd_acc = $kdAccArray[$index];
			$satuan = $satuanArray[$index];
			$uraian = $uraianArray[$index];
			$jumlahpcs = $jumlahpcsArray[$index];
			$diskon = $diskonArray[$index];
			$harga_angka = str_replace(".", "", $hargaArray[$index]);

			// echo "Index: $index<br>";
			// echo "Jumlah: $jumlah<br>";
			// echo "Jumlah Angka: $jumlah_angka<br>";
			// echo "Kode Account: $kd_acc<br>";
			// echo "Uraian: $uraian<br>";
			// echo "Harga Angka: $harga_angka<br>";

			// Query SQL
			$query = mysqli_query($koneksi, "SELECT kd_brg, nama,
			CASE 
				WHEN qty_satuan1 = '$jumlahpcs' THEN Satuan1
				WHEN qty_satuan2 = '$jumlahpcs' THEN Satuan2
				WHEN qty_satuan3 = '$jumlahpcs' THEN Satuan3
				WHEN qty_satuan4 = '$jumlahpcs' THEN Satuan4
				WHEN qty_satuan5 = '$jumlahpcs' THEN Satuan5
				ELSE 'Tidak ada'
			END AS satuan,
			CASE 
				WHEN qty_satuan1 = '$jumlahpcs' THEN qty_satuan1
				WHEN qty_satuan2 = '$jumlahpcs' THEN qty_satuan2
				WHEN qty_satuan3 = '$jumlahpcs' THEN qty_satuan3
				WHEN qty_satuan4 = '$jumlahpcs' THEN qty_satuan4
				WHEN qty_satuan5 = '$jumlahpcs' THEN qty_satuan5
				ELSE NULL
			END AS qty
			 FROM barang
			 WHERE '$jumlahpcs' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5) AND $ff2=  '$kd_acc' ");

			// Memeriksa hasil query
			if ($data = mysqli_fetch_array($query)) {
				$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
				$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
			}




			$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE $ff1='$id' ");
			$data = mysqli_fetch_array($query);
			$urut = $data['urut_max'];
			$urut++;

			$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff6, $ff7, $ff9, $ff8 , $ff4)  
        VALUES (
            '$id', 
            '$kd_acc', 
            '$jumlah_angka', 
            '$harga_angka', 
            '$diskon',  
            '$urut',
			'$satuan',
			'$jumlahpcs'

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

		$query = mysqli_query($koneksi, "SELECT max(nomor_pengiriman) as kodeTerbesar FROM transfer_inventory ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		$urutan = (int) substr($kode, 4, 4);

		$urutan++;

		$nomor_pengiriman = 'TF-' . sprintf("%04s", $urutan);
	
		// echo '<br/> nomor_pengiriman :' . $nomor_pengiriman;
		// echo '<br>';

		// PENGAJUAN

		$query = "INSERT INTO $tabel ( $f1, $f2, $f4,$f5) 
		VALUES (
			'$nomor_pengiriman', 
			'$_POST[$f2]', 
			'$_POST[$f4]',
			'$_POST[$f5]'
		)";

		echo $query;

		$result = mysqli_query($koneksi, $query);

		// DETAIL

		$jumlah_angka = str_replace(".", "", $_POST[$ff4]);
		// echo '<br> kode account : '.$_POST['kode_account'];

		if (isset($_POST['kd_acc'])) {
			// echo "masuk ke kd accnya ada ";
			$kdAccArray = $_POST['kd_acc'];
			$jmlArray = $_POST['jumlah'];
			$priceArray = $_POST['price'];
			$satuanArray = $_POST['satuan'];
			$jumlahPcsArray = $_POST['hasil_perkalian'];
		
			$diskonArray = $_POST['diskon'];
			$isiArray = $_POST['total_pcs'];

		


			foreach ($kdAccArray as $index => $kdAcc) {
				$jml = $jmlArray[$index];
				$price = $priceArray[$index];
				$satuan = $satuanArray[$index];
				$jumlahPcs = $jumlahPcsArray[$index];
				$diskon = $diskonArray[$index];
				$isi = $isiArray[$index];


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
		WHERE '$isi' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5 ) AND $ff2=  '$kdAcc'");

				// Memeriksa hasil query
				if ($data = mysqli_fetch_array($query)) {
					$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
					$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
				}

				$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE $ff1='$nomor_pengiriman' ");
				$data = mysqli_fetch_array($query);
				$urut = $data['urut_max'];
				$urut++;



				$query2 = "INSERT INTO $tabel2($ff1, $ff2, $ff3, $ff6, $ff7, $ff9, $ff8, $ff4)
			VALUES(
				'$nomor_pengiriman',
				'$kdAcc',
				'$jml',
				'$price',
				'$diskon',
				'$urut',
				'$satuan',
				'$isi'
			)";

				$result2 = mysqli_query($koneksi, $query2);

				if (!$result2) {
					$error_massage = "query Error" . mysqli_error($koneksi);
					echo "<script>alert('$error_massage')</script>";
					die();
				}
			}
		} else {

			// Mengambil nilai dari input POST dan melakukan sanitasi
			$isi = $_POST[$ff10];

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
 WHERE '$isi' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5) 
      AND $ff2 = '{$_POST['kd_brg']}'
");
			// Memeriksa hasil query
			if ($data = mysqli_fetch_array($query)) {
				$satuan = $data['satuan']; // Mengambil nilsai dari kolom 'satuan'
				$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
			}





			$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7, $ff8, $ff9, $ff10, $ff11) 
		VALUES (
			'$kode', 
			'$_POST[kd_brg]', 
			'$_POST[$ff3]',  
			'$jumlah_angka', 
            '$_POST[$ff7]',  
            1,
			'$satuan',
			'$isi',
			'$kode_po'
		)";

			// echo '<br> query2 : ';
			// printf($query2);
			$result2 = mysqli_query($koneksi, $query2);


			if (!$result2) {
				die("Query gagal dijalankan: 2" . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			}
		}



		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>window.location='../../main.php?route=transfer_inventory_detail&act&id=$nomor_pengiriman'</script>";
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
		$f4 = '$_POST[$f4]',
		$f5 = '$_POST[$f5]',
		$f2 = '$_POST[$f2]'
		
		";
		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		$result = mysqli_query($koneksi, $query);
		// var_dump($query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diSimpan.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit-detail') {

		$kode_barang = $_POST[$ff2];

	


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
	WHERE '$isi' IN (qty_satuan1, qty_satuan2, qty_satuan3, qty_satuan4, qty_satuan5) AND $ff2 = $kode_barang");

		// Memeriksa hasil query
		if ($data = mysqli_fetch_array($query)) {
			$satuan = $data['satuan']; // Mengambil nilai dari kolom 'satuan'
			$qty = $data['qty'];       // Mengambil nilai dari kolom 'qty'
		}

		// Pastikan bahwa semua nilai dari POST di-set sebagai integer atau NULL jika kosong
		$ff3_value = isset($_POST[$ff3]) && is_numeric($_POST[$ff3]) ? intval($_POST[$ff3]) : 0;
		$ff6_value = isset($_POST[$ff6]) && is_numeric($_POST[$ff6]) ? intval($_POST[$ff6]) : 0;
		$ff7_value = isset($_POST[$ff7]) && is_numeric($_POST[$ff7]) ? intval($_POST[$ff7]) : 0;

		// Gunakan query dengan kondisi yang benar-benar integer atau NULL
		$query  = "UPDATE $tabel2 SET 
			$ff3 = $ff3_value,
			$ff8 = '$satuan',
			$ff4 = '$isi',
			$ff6 = $ff6_value,
			$ff7 = $ff7_value
		";

		// echo $query;

		// $query  = "UPDATE $tabel2 SET 
		// $ff3 = '$_POST[$ff3]',
		// $ff9 = 'pcs',
		// $ff10 = 1,
		// $ff4 = '$_POST[$ff4]',
		// $ff7 = '$_POST[$ff7]'
		// ";

		// echo $query;
		$query .= "WHERE $ff1 = '$_GET[id]' AND $ff2 = '$_GET[id2]' AND $ff8='$_GET[id3]' ";
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
