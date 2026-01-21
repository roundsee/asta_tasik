<?php
$dir = "../../../../";
session_start();



//$tabel_sebelum="subalat_bayar";

$judulform = "Pembelian_retur";

$data = 'data_pembelian_retur';
$tujuan = 'pembelian_retur';
$aksi = 'aksi_pembelian_retur';

$rute_detail = 'beli_detail';

$tabel = 'pembelian_retur'; // Sesuai dengan tabel pembelian yang telah dibuat
// Field untuk tabel pembeliansudah
$f1 = 'id_transaksi';       // sudah
$f2 = 'tgl';               // 
$f3 = 'no_bukti';          // sudah
$f4 = 'vendor';            // sudah
$f5 = 'kode_barang';       // sudah
$f6 = 'nama_barang';       // sudah
$f7 = 'satuan';            // sudah
$f8 = 'akun_persediaan';   // sudah
$f9 = 'jumlah';            // sudah
$f10 = 'harga';            // sudah
$f11 = 'sub_total';        // sudah
$f12 = 'ppn';              // sudah
$f13 = 'akun_ppn';         // sudah
$f14 = 'total';            //  sudah
$f15 = 'metode_pembayaran'; //sudah
$f16 = 'akun';             // 

// Judul untuk form
$j1 = 'id_transaksi';
$j2 = 'tgl';
$j3 = 'no_bukti';
$j4 = 'vendor';
$j5 = 'kode_barang';
$j6 = 'nama_barang';
$j7 = 'satuan';
$j8 = 'akun_persediaan';
$j9 = 'jumlah';
$j10 = 'harga';
$j11 = 'sub_total';
$j12 = 'ppn';
$j13 = 'akun_ppn';
$j14 = 'total';
$j15 = 'metode_pembayaran';
$j16 = 'akun';



$tabelmirror = 'barangnas';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";

	$route = $_GET['route'];
	$act = $_GET['act'];
	// var_dump($_GET);

	//Hapus area
	if ($route == $tujuan and $act == 'hapus') {

		mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");

		echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	}

	// Tambah
	elseif ($route == $tujuan and $act == 'input-berdasarkan_po') {



		// Ambil tanggal input dan tanggal saat ini
		$tgl_input = $_POST[$f2]; // Tanggal yang diinputkan
		$tgl_sekarang = date('Y-m-d'); // Tanggal saat ini

		// Generate nomor urut untuk id_transaksi
		$query = mysqli_query($koneksi, "SELECT MAX(SUBSTRING(id_transaksi, -4)) as max_id FROM pembelian_retur WHERE DATE(tgl) = '$tgl_input'");
		$result = mysqli_fetch_assoc($query);
		$last_id = $result['max_id'] ?? 0; // Jika null, set ke 0
		$new_id = str_pad(($last_id + 1), 4, '0', STR_PAD_LEFT); // Format nomor urut 0001

		$id_transaksi = "trans-$new_id"; // Format id_transaksi: trans/tgl_input/0001

		// Generate nomor urut untuk no_bukti
		$query = mysqli_query($koneksi, "SELECT MAX(SUBSTRING(no_bukti, -4)) as max_no_bukti FROM pembelian_retur WHERE DATE(tgl) = '$tgl_sekarang'");
		$result = mysqli_fetch_assoc($query);
		$last_no_bukti = $result['max_no_bukti'] ?? 0; // Jika null, set ke 0
		$new_no_bukti = str_pad(($last_no_bukti + 1), 4, '0', STR_PAD_LEFT); // Format nomor urut 0001

		$no_bukti = "bkt-$new_no_bukti"; // Format no_bukti: bkt/tgl_sekarang/0001

		// Simpan data ke database
		$sql = "INSERT INTO pembelian_retur 
		(id_transaksi, tgl, vendor, no_bukti, ppn, kode_barang, nama_barang, satuan, akun_persediaan, jumlah, harga, sub_total, akun_ppn, total, metode_pembayaran, akun) 
		VALUES 
		('$_POST[$f1]', 
		 '$_POST[$f2]', 
		 '$_POST[$f4]', 
		 '$_POST[$f3]', 
		 '$_POST[$f12]', 
		 '$_POST[$f5]', 
		 '$_POST[$f6]', 
		 '$_POST[$f7]', 
		 '$_POST[$f8]', 
		 '$_POST[$f9]', 
		 '$_POST[$f10]', 
		 '$_POST[$f11]', 
		 '$_POST[$f13]', 
		 '$_POST[$f14]', 
		 '$_POST[$f15]', 
		 '$_POST[$f16]'
		)";

		// Tampilkan query untuk debugging
		// echo "<pre>$sql</pre>";

		// Eksekusi query
		$simpan = mysqli_query($koneksi, $sql);
		if (!$simpan) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";
			// echo "<script>history.go(-2)</script>";
		}
	}

	// Tambah
	elseif ($route == $tujuan and $act == 'input') {

		$employee = $_SESSION['employee_number'];
		// echo "<br>" . $employee;

		$query_kdcus = mysqli_query($koneksi, "SELECT kd_cus FROM user_login where employee_number = '$employee'");
		$q1= mysqli_fetch_assoc($query_kdcus);
		$kd_cus = $q1['kd_cus'];
		


		$jumlah =  $_POST[$f9];


		// Ambil tanggal input dan tanggal saat ini
		$tgl_input = $_POST[$f2]; // Tanggal yang diinputkan
		$tgl_sekarang = date('Y-m-d'); // Tanggal saat ini

		// update ke stok di table barang
		$update_stok = mysqli_query($koneksi, "UPDATE barang SET Quantity = Quantity - '$jumlah' WHERE kd_brg = '$_POST[$f5]' ");

		// Generate nomor urut untuk no_bukti
		$query = mysqli_query($koneksi, "SELECT MAX(SUBSTRING(no_bukti, -4)) as max_no_bukti FROM pembelian_retur WHERE DATE(tgl) = '$tgl_sekarang'");
		$result = mysqli_fetch_assoc($query);
		$last_no_bukti = isset($result['max_no_bukti']) ? intval($result['max_no_bukti']) : 0; // Pastikan ini adalah integer
		$new_no_bukti = str_pad(($last_no_bukti + 1), 4, '0', STR_PAD_LEFT); // Format nomor urut 0001
		$no_bukti = "bkt-$new_no_bukti"; // Format no_bukti

		// Generate id_transaksi
		$id_transaksi = "trans-$new_no_bukti"; // Misalnya sama dengan no_bukti untuk contoh ini


		// Simpan data ke database
		$sql = "INSERT INTO pembelian_retur 
		(kd_cus, user_input, tgl, vendor, no_bukti, ppn, kode_barang, nama_barang, satuan, akun_persediaan, jumlah, harga, sub_total, akun_ppn, total, metode_pembayaran, akun) 
		VALUES 
		( 
		 '$kd_cus',
		 '$employee',
		 '$_POST[$f2]', 
		 '$_POST[$f4]', 
		 '$no_bukti', 
		 '$_POST[$f12]', 
		 '$_POST[$f5]', 
		 '$_POST[$f6]', 
		 '$_POST[$f7]', 
		 '$_POST[$f8]', 
		 '$_POST[$f9]', 
		 '$_POST[$f10]', 
		 '$_POST[$f11]', 
		 '$_POST[$f13]', 
		 '$_POST[$f14]', 
		 '$_POST[$f15]', 
		 '$_POST[$f16]'
		)";

		// Tampilkan query untuk debugging
		// echo "<pre>$sql</pre>";

		// Eksekusi query
		$simpan = mysqli_query($koneksi, $sql);
		if (!$simpan) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>history.go(-2)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit') {
		$simpan = mysqli_query($koneksi, "UPDATE pembelian_retur SET 
			$f2 = '$_POST[$f2]',
			$f4 = '$_POST[$f4]',
			$f5 = '$_POST[$f5]',
			$f6 = '$_POST[$f6]',
			$f7 = '$_POST[$f7]',
			$f8 = '$_POST[$f8]',
			$f9 = '$_POST[$f9]',
			$f10 = '$_POST[$f10]',
			$f11 = '$_POST[$f11]',
			$f12 = '$_POST[$f12]',
			$f13 = '$_POST[$f13]',
			$f14 = '$_POST[$f14]',
			$f15 = '$_POST[$f15]',
			$f16 = '$_POST[$f16]'
		WHERE id_transaksi = '$_POST[$f1]' ");

		if (!$simpan) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diupdate.');</script>";
			echo "<script>history.go(-2)</script>";
		}
	}
}
