<?php
$dir = "../../../../";

$judulform = "DATA SUPPLIER";

$data = 'data_supplier';
$tujuan = 'supplier';
$aksi = 'aksi_supplier';


$tabel = "supplier";
$f1 = 'kd_supp';
$f2 = 'nama';
$f3 = 'alamat';
$f4 = 'telp';
$f5 = 'id_sales';
$f6 = 'area';
$f7 = 'term';
$f8 = 'kd_kota';
$f9 = 'kd_area';
$f10 = 'kd_dispenda';
$f11 = 'id_kat';
$f12 = 'hari_pengiriman';
$f13 = 'term_of_payment';

$j1 = 'Kode Supplier';
$j2 = 'Nama Supplier';
$j3 = 'Alamat';
$j4 = 'Telepon';
$j5 = 'ID Sales';
$j6 = 'Area';
$j7 = 'Durasi kirim';
$j8 = 'Kode Kota';
$j9 = 'Kode Area';
$j10 = 'Dispenda';
$j11 = 'Kode Kategori';
$j12 = 'Hari Pengiriman';
$j13 = 'Term Of payment';


$tabel2 = 'supplier_barang';
$ff1 = 'kd_brg';
$ff2 = 'kd_supp';
$ff3 = 'durasi_kirim';
$ff4 = 'minimum_order';

$jj1 = 'Kode Barang';
$jj2 = 'Kode Supplier';
$jj3 = 'Durasi Kirim';
$jj4 = 'Minimum Order';


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

		$query = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE kd_pur = '$_GET[id]' ");

		if (($query->num_rows > 0) or ($query->num_rows > 0)) {
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
		echo $_POST[$f13];
		$tgl = date('Y-m-d');
		// echo "satu : ";
		// echo $_POST[$f1];
		// echo "dua : ";
		// echo $_POST[$f2];
		// echo "tiga : ";
		// echo $_POST[$f3];

		$query = mysqli_query($koneksi, "SELECT max(kd_supp) as kodeTerbesar FROM $tabel ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		// echo "<br/>".$kode;

		$urutan = (int) substr($kode, 5, 4);
		// echo "<br/>".$urutan;

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;
		// echo "<br/>".$urutan;

		$kode = "SUPP-" . sprintf("%04s", $urutan);

		$rs = mysqli_query($koneksi, "INSERT into $tabel (
			$f1,$f2,$f3,$f4,$f5,$f7,$f8,$f9, $f12,$f13) 
		values (
			'" . $kode . "',
			'" . $_POST[$f2] . "',
			'" . $_POST[$f3] . "',
			'" . $_POST[$f4] . "',
			'" . $_POST[$f5] . "',
			'" . $_POST[$f7] . "',
			'" . $_POST[$f8] . "',
			'" . $_POST[$f9] . "',
			'" . $_POST[$f12] . "',
			'" . $_POST[$f13] . "'
		)") or die(mysqli_error($koneksi));

		echo "<script>window.location='../../main.php?route=supplier_barang&act&id=$kode'</script>";
	} elseif ($route == $tujuan and $act == 'edit') {
	

		$query  = "UPDATE $tabel SET 
		$f2 = '$_POST[$f2]',
		$f3 = '$_POST[$f3]', 
		$f4 = '$_POST[$f4]',
		$f5 = '$_POST[$f5]',
		$f7 = '$_POST[$f7]',
		$f8 = '$_POST[$f8]',
		$f9 = '$_POST[$f9]',
		$f12 = '$_POST[$f12]',
		$f13 = '$_POST[$f13]'";
		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		$result = mysqli_query($koneksi, $query);

		// $query1  = "UPDATE $tabelmirror SET 
		// $f2 = '$_POST[$f2]',
		// $f3 = '$_POST[$f3]', 
		// $f4 = '$_POST[$f4]',
		// $f5 = '$_POST[$f5]',
		// $f6 = '$_POST[$f6]',
		// $f7 = '$_POST[$f7]'";
		// $query1 .= "WHERE $f1 = '$_POST[$f1]' ";
		// $result1 = mysqli_query($koneksi, $query1);

		if (!$result) {
			die("Query gagal dijalankan : " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diubah.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'input-detail') {

		$id = $_GET['id']; // Ambil ID supplier dari URL

		// Ambil data yang dikirim dari form
		$kd_brg = $_POST['kd_acc'];
		$durasi_Kirim = $_POST['durasi_kirim'];
		$minimum_order = $_POST['minimum_order'];
		// Debugging: Cek data yang diambil dari form
		// echo "<pre>";
		// echo "ID: " . $id . "\n";
		// echo "Kode Barang:\n";
		// print_r($kd_brg);
		// echo "Durasi Kirim:\n";
		// print_r($durasi_Kirim);
		// echo "Minimum Order:\n";
		// print_r($minimum_order);
		// echo "</pre>";
		// Siapkan query untuk memasukkan data ke tabel supplier_barang
		$query = "INSERT INTO supplier_barang (kd_supp, kd_brg, durasi_kirim, minimum_order) VALUES ";

		// Loop untuk menambahkan data ke query
		$values = [];
		for ($i = 0; $i < count($kd_brg); $i++) {
			$values[] = "('$id', '" . $kd_brg[$i] . "', '" . $durasi_Kirim[$i] . "', '" . $minimum_order[$i] . "')";
		}

		$query .= implode(', ', $values);

		// Eksekusi query
		if (mysqli_query($koneksi, $query)) {
			echo "<script>alert('Data berhasil disimpan.')</script>";
			echo "<script>history.go(-1)</script>";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
		}
	} elseif ($route == $tujuan and $act == 'edit-detail') {
		$query  = "UPDATE $tabel2 SET 
		$ff3 = '$_POST[$ff3]',
		$ff4 = '$_POST[$ff4]'
		";
		$query .= "WHERE $ff1 = '$_GET[id]' AND $ff2 = '$_GET[id2]'";
		// echo $query;
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'hapus-detail') {

		// $query = mysqli_query($koneksi, "SELECT * FROM $tabel2 WHERE no_pengajuan = '$_GET[id]' AND no_account='$_GET[id2]' "); 


		mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]' AND $ff2='$_GET[id2]' ");

		// echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	}
}
