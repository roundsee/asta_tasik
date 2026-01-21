<?php
$dir = "../../../../";

//$tabel_sebelum="subalat_bayar";

$judulform = "Payment Tambah";


$data = 'lap_payment_invoice';
$tujuan = 'payment_invoice';
$aksi = 'aksi_payment';

$tabel = 'payment';
$f1 = 'id_payment';
$f2 = 'no_invoice';
$f3 = 'jumlah_payment';
$f4 = 'no_payment';
$f5 = 'tanggal_payment';
$f6 = 'insert_oleh';
$f7 = 'tanggal';
$f8 = 'metode_payment';

$j1 = 'id_payment';
$j2 = 'no_invoice';
$j3 = 'jumlah_payment';
$j4 = 'no_payment';
$j5 = 'tanggal_payment';
$j6 = 'insert_oleh';
$j7 = 'tanggal';
$j8 = 'Metode Payment';

$tabelmirror = 'barangnas';

session_start();
$employee = $_SESSION['employee_number'];
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
	elseif ($route == $tujuan and $act == 'input') {

        $kode= $_POST[$f2];
        echo $kode ;
		
	
		// Ambil tanggal input dan tanggal saat ini
		$tgl_input = $_POST[$f2]; // Tanggal yang diinputkan
		$tgl_sekarang = date('Y-m-d'); // Tanggal saat ini
	
		// Generate nomor urut untuk id_transaksi
		$query = mysqli_query($koneksi, "SELECT MAX(SUBSTRING(no_payment, -4)) as max_id FROM payment WHERE DATE(tgl) = '$tgl_input'");
		$result = mysqli_fetch_assoc($query);
		$last_id = $result['max_id'] ?? 0; // Jika null, set ke 0
		$new_id = str_pad(($last_id + 1), 4, '0', STR_PAD_LEFT); // Format nomor urut 0001
	
		$id_payment = "payment-$new_id"; // Format id_transaksi: trans/tgl_input/0001
	
		// Generate nomor urut untuk no_bukti
		$query = mysqli_query($koneksi, "SELECT MAX(SUBSTRING(no_payment, -4)) as max_no_bukti FROM payment WHERE DATE(tgl) = '$tgl_sekarang'");
		$result = mysqli_fetch_assoc($query);
		$last_no_bukti = $result['max_no_bukti'] ?? 0; // Jika null, set ke 0
		$new_no_bukti = str_pad(($last_no_bukti + 1), 4, '0', STR_PAD_LEFT); // Format nomor urut 0001
	
		$no_bukti = "bkt-$new_no_bukti"; // Format no_bukti: bkt/tgl_sekarang/0001
	
		// Simpan data ke database
		$sql = "INSERT INTO payment 
		(no_invoice, jumlah_payment, no_payment, tanggal_payment, insert_oleh, tanggal, metode_payment) 
		VALUES 
		(
		 '$_POST[$f2]', 
		 '$_POST[$f3]', 
		 '$id_payment', 
		 '$tgl_sekarang', 
		 '$employee', 
		 '$tgl_sekarang', 
	
		 '$_POST[$f8]'
		
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
	}
	


	elseif ($route == $tujuan and $act == 'edit') {
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
