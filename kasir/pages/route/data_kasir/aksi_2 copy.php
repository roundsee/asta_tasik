<?php
include '../../../../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];
$kodeAppValue = $_COOKIE['kode_kategori_tambahan'] ?? 0;

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$tgl = date('Y-m-d');

$nama_bln = array(
	1 => "Januari",
	"Februari",
	"Maret",
	"April",
	"Mei",
	"Juni",
	"Juli",
	"Agustus",
	"September",
	"Oktober",
	"November",
	"Desember"
);

$query = mysqli_query($koneksi, "SELECT * FROM setup ");
$q = mysqli_fetch_array($query);

$perusahaan = $q['perusahaan'];
$naper_mini = $q['naper_mini'];
$naper1 = $q['naper1'];
$naper2 = $q['naper2'];
$ver = $q['ver'];
// $perusahaan='PT Waroeng Steak Indonesia';
// $naper_mini='WG';
// $naper1='Steak';
// $naper2='& Shake';
// $ver='v 1.0';

$warna_primary_1 = "#f8f850";
$warna_primary_2 = "#333333";
$warna_primary_3 = "#f8f9fa";
session_start();
$en = $_SESSION['employee_number'];
$query1 = mysqli_query($koneksi, "SELECT kategori_kasir from employee where employee_number='$en' ");
$q1 = mysqli_fetch_array($query1);
$kategoripenguranganstok = $q1['kategori_kasir'];

$no_inv 				= $_POST['no_inv'];
$kd_cus 				= $_POST['kd_cus'];
// $kd_aplikasi 		= $_SESSION['kd_aplikasi']; 
$kd_aplikasi 		= $_COOKIE['kode_app'];
// echo $kd_aplikasi;
$no_meja 				= $_POST['no_meja'];
$nama_member 		= $_POST['nama_member'];
$oleh 					= $_POST['oleh'];
$subjumlah			= $_POST['subjumlah'];
$ppn						= ceil($_POST['nilai_tax']);
$jumlah 				= $_POST['total'];
$byr_pocer			= $_POST['byr_pocer'];
$byr_non_tunai			= isset($_POST['byr_non_tunai']) ? $_POST['byr_non_tunai'] : 0;
// $kd_alatbayar		= $_POST['kd_alatbayar'];
$tahun					= date('Y');
$bulan					= date('Ym');
$jam 						= date("H:i:s");
$kdsub_alatbayar	= $_POST['kdsub_alatbayar'];
$subjumlah_offline 	= 0;
$dasar_fee			= 0;
$faktur_refund 	= $_POST['faktur_refund'];
$dasar_faktur 	= $_POST['dasar_faktur'];
$no_ref 				= isset($_POST['no_ref']) ? $_POST['no_ref'] : 0;

$tarif_pb1 			= $_POST['tarif_pb1'];
$nama_aplikasi 	= $_POST['nama_aplikasi'];

// $nama_subalat_bayar= $_POST['nama_subalat_bayar'];
$tarif_fee 	= $_POST['tarif_fee'];
$acuan_fee 	= $_POST['acuan_fee'];
$b_packing 	= $_POST['b_packing'];

$kd_alatbayar = substr($kdsub_alatbayar, 0, 3);

if ($_POST['byr_tunai'] == null) {
	$byr_tunai = 0;
} else {
	$byr_tunai			= $_POST['byr_tunai'];
}

$byr_tunai 		= $_COOKIE['nilai_tunai'];
if ($byr_tunai == null) {
	$byr_tunai = 0;
}

$byr_non_tunai	= $_COOKIE['nilai_non_tunai'];
if ($byr_non_tunai == null) {
	$byr_non_tunai = 0;
}

$ongkos_kirim	= $_COOKIE['ongkos_kirim'];
if ($ongkos_kirim == null) {
	$ongkos_kirim = 0;
}
$voucher_nilai_diskon	= $_COOKIE['voucher_nilai_diskon'];
if ($voucher_nilai_diskon == null) {
	$voucher_nilai_diskon = 0;
}
$kode_app = $_COOKIE['kode_app'];

$kd_kota	= $_SESSION['kd_kota'];

$_SESSION['kd_alatbayar'] = $kd_alatbayar;
$_SESSION['jumlah'] = $jumlah;
$_SESSION['byr_pocer'] = $byr_pocer;
$_SESSION['byr_tunai'] = $byr_tunai;
$_SESSION['byr_non_tunai'] = $byr_non_tunai;
$_SESSION['no_meja'] = $no_meja;
$_SESSION['nama_member'] = $nama_member;
$_SESSION['tarif_pb1'] = $tarif_pb1;
$_SESSION['oleh'] = $oleh;
$_SESSION['nama_aplikasi'] = $nama_aplikasi;


$_SESSION['tarif_fee'] = $tarif_fee;
$_SESSION['acuan_fee'] = $acuan_fee;
$_SESSION['b_packing'] = $b_packing;

// mencari nama sub alat bayar
$query = mysqli_query($koneksi, "SELECT nama FROM subalat_bayar where kdsub_alat ='$kdsub_alatbayar' ");

$q1 = mysqli_fetch_array($query);
$nama_subalat_bayar = isset($q1['nama']) ? $q1['nama'] : 0;




$_SESSION['dibayar'] = $byr_tunai;

// mencari ket_aplikasi,no_online,no_ofline
if ($kd_aplikasi == '11') {
	$ket_aplikasi = 'OF LINE';
	$no_online = 0;
	$no_ofline = 1;
} else {
	$ket_aplikasi = 'ON LINE';
	$no_online = 1;
	$no_ofline = 0;
}
// Jika pembayaran Tunai (kdsub_alatbayar)
if ($kdsub_alatbayar == '0') {
	$kdsub_alatbayar = '100-01';
	$kd_alatbayar = '100';
}


if ($kd_alatbayar != null) {
	$tarif_fee = $tarif_fee;
	$acuan_fee = $acuan_fee;
	$b_paking = $b_packing;
} else {
	$tarif_fee = 0;
	$acuan_fee = "";
	$b_paking = 0;
}


$_SESSION['nama_sub_alat_bayar'] = $nama_subalat_bayar;

//2 double cek utk jumlah START
if ($jumlah == 0) {
	// code...
	$jumlah = $subjumlah + $ppn;
}
// double cek utk jumlah END

if ($byr_pocer >= $jumlah) {
	$input_tunai = 0;
} elseif ($byr_pocer <= $jumlah) {
	$input_tunai = ($jumlah - $byr_non_tunai - $byr_pocer);
}


//3 Double cek utk subjumlah+ppn tdk sama dgn byr_pocer+byr_tunai_+byr_non_tunai START
$nilai_total = $subjumlah + $ppn;
$nilai_total_bayar = $byr_pocer + $input_tunai + $byr_non_tunai;
if ($nilai_total != $nilai_total_bayar) {
	// code...
	if ($kdsub_alatbayar == "100-01") {
		$input_tunai = $subjumlah + $ppn - $byr_pocer;
		$byr_non_tunai = 0;
	} else {
		$byr_non_tunai = $subjumlah + $ppn - $byr_pocer;
		$input_tunai = 0;
	}
}
//3 Double cek utk subjumlah+ppn tdk sama dgn byr_pocer+byr_tunai_+byr_non_tunai END


$transaksi_produk = $_POST['transaksi_produk'];
$transaksi_harga = $_POST['transaksi_harga'];
$transaksi_jumlah = $_POST['transaksi_jumlah'];
$transaksi_total = $_POST['transaksi_total'];
$transaksi_diskon = $_POST['transaksi_diskon'];
$transaksi_ket = $_POST['transaksi_ket'];
$transaksi_kd_promo = $_POST['transaksi_kd_promo'];
$transaksi_harga_dasar = $_POST['transaksi_harga_dasar'];


$transaksi_satuan = $_POST['transaksi_satuan'];
$transaksi_satuan_qty = $_POST['transaksi_satuan_qty'];
$transaksi_satuan_awal = $_POST['transaksi_satuan_awal'];

$transaksi_total_diskon = $_POST['transaksi_total_diskon'];

$transaksi_nama = $_POST['transaksi_nama'];

$_SESSION['transaksi_produk'] = $transaksi_produk;
$_SESSION['transaksi_harga'] = $transaksi_harga;
$_SESSION['transaksi_jumlah'] = $transaksi_jumlah;
$_SESSION['transaksi_total'] = $transaksi_total;
$_SESSION['transaksi_diskon'] = $transaksi_diskon;
$_SESSION['transaksi_ket'] = $transaksi_ket;
$_SESSION['transaksi_kd_promo'] = $transaksi_kd_promo;
$_SESSION['transaksi_harga_dasar'] = $transaksi_harga_dasar;

$_SESSION['transaksi_nama'] = $transaksi_nama;
$_SESSION['transaksi_satuan'] = $transaksi_satuan;
$_SESSION['transaksi_satuan_qty'] = $transaksi_satuan_qty;
$_SESSION['transaksi_satuan_awal'] = $transaksi_satuan_awal;


$_SESSION['transaksi_total_diskon'] = $transaksi_total_diskon;

$jumlah_pembelian = count($transaksi_produk);

// Mencari nilai "Total Subjumlah_offline" START
$tot_subjumlah_offline = 0;

for ($a = 0; $a < $jumlah_pembelian; $a++) {

	$t_jumlah = $transaksi_jumlah[$a];
	$t_harga_dasar = $transaksi_harga_dasar[$a];
	$t_quantity = $transaksi_satuan_qty[$a];

	$tot_subjumlah_offline = $tot_subjumlah_offline + (($t_jumlah  * $t_quantity) * $t_harga_dasar);
}
// Mencari nilai "Total Subjumlah_offline" END


$subjumlah_offline = $tot_subjumlah_offline;

// mencari DASAR_FEE START
$nilai_tarif_fee = $tarif_fee / 100;
$selisih_harga = ($subjumlah - $subjumlah_offline);


if ($acuan_fee == 'Harga Jual') {
	$dasar_fee = $subjumlah * $nilai_tarif_fee;
} elseif ($acuan_fee == 'Selisih Harga Jual') {
	$dasar_fee = $selisih_harga * $nilai_tarif_fee;
} else {
	$dasar_fee = 0;
}

mysqli_autocommit($koneksi, FALSE);
mysqli_begin_transaction($koneksi, MYSQLI_TRANS_START_READ_WRITE);

try {
	mysqli_query($koneksi, "LOCK TABLES penjualan WRITE");
	$char = substr($no_inv, 0, 14);

	$hasil = mysqli_query($koneksi, "SELECT max(no_urut) as max_nourut FROM penjualan WHERE substr(faktur,1,14) ='$char'");
	if (!$hasil) throw new Exception("Gagal mengambil no_urut: " . mysqli_error($koneksi));

	$hsl = mysqli_fetch_array($hasil);
	$no_urut = $hsl['max_nourut'];
	$no_urut = ($no_urut != "") ? $no_urut + 1 : 1;

	$noInvoice = substr($no_inv, 0, 14) . '-' . sprintf("%04s", $no_urut);
	$_SESSION['id'] = $noInvoice;
	mysqli_query($koneksi, "UNLOCK TABLES");

	// Insert into penjualan
	$penjualan_sql = "INSERT INTO penjualan (
        faktur,tanggal,kd_cus,kd_aplikasi,no_meja,oleh,subjumlah,ppn,jumlah,
        byr_pocer,byr_tunai,byr_non_tunai,kd_alatbayar,no_urut,tahun,bulan,jam,
        kdsub_alatbayar,subjumlah_offline,ket_aplikasi,dasar_fee,acuan_fee,
        tarif_fee,b_paking,no_online,no_ofline,tarif_pb1,faktur_refund,dasar_faktur,
        dibayar,no_ref,ongkir,voucher_nilai_diskon
    ) VALUES (
        '$noInvoice',null,'$kd_cus','$kd_aplikasi','$no_meja','$oleh','$subjumlah','$ppn','$jumlah',
        '$byr_pocer','$input_tunai','$byr_non_tunai','$kd_alatbayar','$no_urut','$tahun','$bulan','$jam',
        '$kdsub_alatbayar','$subjumlah_offline','$ket_aplikasi','$dasar_fee','$acuan_fee',
        '$tarif_fee','$kodeAppValue','$no_online','$no_ofline','$tarif_pb1','$faktur_refund','$dasar_faktur',
        '$byr_tunai','$no_ref','$ongkos_kirim','$voucher_nilai_diskon'
    )";
	$penjualan = mysqli_query($koneksi, $penjualan_sql);
	if (!$penjualan) throw new Exception("Insert penjualan gagal: " . mysqli_error($koneksi));

	// Gudang order if needed
	if ($kodeAppValue != 1) {
		$order_gudang = mysqli_query($koneksi, "INSERT INTO gudang_order (faktur,tanggal,oleh) VALUES ('$noInvoice',null,'$oleh')");
		if (!$order_gudang) throw new Exception("Insert gudang_order gagal: " . mysqli_error($koneksi));
	}
	// Insert jualdetil + update inventory/mutasi
	$urut = 1;
	for ($a = 0; $a < $jumlah_pembelian; $a++) {
		$t_produk = $transaksi_produk[$a];
		$t_harga = $transaksi_harga[$a];
		$t_jumlah = $transaksi_jumlah[$a];
		$t_total = $transaksi_total[$a];
		$t_diskon = $transaksi_diskon[$a];
		$t_ket = $transaksi_ket[$a];
		$t_kd_promo = $transaksi_kd_promo[$a];
		$t_harga_dasar = $transaksi_harga_dasar[$a];
		$t_satuan = $transaksi_satuan[$a];
		$t_satuan_qty = $transaksi_satuan_qty[$a];
		$t_satuan_awal = $transaksi_satuan_awal[$a];

		$kd_detail_barang = $kd_kota . '-' . $kd_aplikasi . '-' . $t_produk;
		$hitungan_total = $t_total - $t_diskon;

		$jadi = $noInvoice . "-" . sprintf("%04s", $urut);
		$quantity = $t_jumlah * $t_satuan_qty;
		$negative_quantity = -$quantity;

		// Inventory update
		$kd_cus_tambahan = ($kodeAppValue != 1) ? 8001 : 1316;
		$updatestock = mysqli_query($koneksi, "UPDATE inventory SET stok = stok - $quantity WHERE kd_brg = '$t_produk' AND kd_cus = $kd_cus_tambahan");
		if (mysqli_affected_rows($koneksi) == 0) {
			$insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok, satuan) VALUES ('$t_produk', '$kd_cus_tambahan', '$negative_quantity', 'Pcs')");
			if (!$insertstock) throw new Exception("Insert inventory gagal: " . mysqli_error($koneksi));
		}

		// Insert jualdetil
		$jualdetil_sql = "INSERT INTO jualdetil VALUES (
            '$jadi','$noInvoice',NULL,'$kd_cus','$kd_aplikasi','$t_kd_promo','$t_produk',
            '$t_jumlah','$t_harga','$t_diskon','$hitungan_total',NULL,'$t_ket','0','$t_satuan','$t_satuan_qty')";
		$jualdetil = mysqli_query($koneksi, $jualdetil_sql);
		if (!$jualdetil) throw new Exception("Insert jualdetil gagal: " . mysqli_error($koneksi));
		// simpan atau update mutasi
		$query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tgl' AND kd_cus = '$kd_cus_tambahan' AND kd_brg = '$t_produk'";
		$result_check = mysqli_query($koneksi, $query_check);

		if (mysqli_num_rows($result_check) > 0) {
			$query_update = "UPDATE mutasi_stok SET 
				qt_jual = qt_jual + $qt_jual ,
                nilai_jual = nilai_jual + $nilai_jual,
                hpp_jual = qt_jual * harga_rata,
                qt_akhir = qt_akhir - $qt_jual,
                nilai_akhir = IF(qt_akhir = 0,0, qt_akhir * harga_rata)
			   WHERE tgl = '$tgl' AND kd_cus = '$kd_cus_tambahan' AND kd_brg = '$t_produk'";
			$resut_update = mysqli_query($koneksi, $query_update);
			if (!$resut_update) {
				die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
			}
		} else {
			$query_awal = "SELECT
			tgl AS tgl_terakhir, 
			nilai_akhir AS nilai_awalakhir,
			qt_akhir AS qty_awalakhir,
			stok_opname, nilai_opname       
			FROM mutasi_stok 
			WHERE kd_cus = '$kd_cus_tambahan' AND kd_brg = '$t_produk' 
			ORDER BY 
			tgl_terakhir DESC 
			LIMIT 1";

			$result_awal = mysqli_query($koneksi, $query_awal);

			if (!$result_awal) {
				die("Query untuk mendapatkan nilai awal, qty awal, nilai beli sebelumnya, dan qty beli sebelumnya gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
			}

			if (mysqli_num_rows($result_awal) > 0) {
				$row_awal = mysqli_fetch_assoc($result_awal);
				$nilai_awal = $row_awal['nilai_awalakhir'];
				$qty_awal = $row_awal['qty_awalakhir'];
				$stok_opname = $row_awal['stok_opname'];
				$nilai_opname = $row_awal['nilai_opname'];
			} else {
				$nilai_awal = 0;
				$qty_awal = 0;
				$stok_opname = 0;
				$nilai_opname = 0;
			}

			$qty_awal = $stok_opname != 0 ? $stok_opname : $qty_awal;
			$nilai_awal = $nilai_opname != 0 ? $nilai_opname : $nilai_awal;
			$nilai_awal = is_numeric($nilai_awal) ? $nilai_awal : 0;
			$qty_awal = is_numeric($qty_awal) ? $qty_awal : 0;
			if ($qty_awal != 0) {
				$harga_rata_sebelumnya = $nilai_awal / $qty_awal;
			} else {
				$harga_rata_sebelumnya = 0;
			}
			$query_insert = "INSERT INTO mutasi_stok 
				(tgl, qty_awal, nilai_awal, qt_tersedia, nilai_tersedia,  
				harga_rata , kd_cus, kd_brg, satuan,
				qt_jual, nilai_jual,hpp_jual,
				qt_akhir, nilai_akhir) VALUES (
					'$tgl',
					'$qty_awal',
					'$nilai_awal',
					'$qty_awal',
					'$nilai_awal',
					'$harga_rata_sebelumnya',
					'$kd_cus_tambahan',
					'$t_produk',
					'Pcs',
					'$qt_jual',
					'$nilai_jual',
					'$harga_rata_sebelumnya' * '$qt_jual',
					'$qty_awal' - '$qt_jual',
					'$harga_rata_sebelumnya' * ( '$qty_awal' - '$qt_jual' )
				)";
			$result_insert = mysqli_query($koneksi, $query_insert);
			if (!$result_insert) {
				die("Query insert ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
			}
		}
		$urut++;
	}
	// Log transaksi
	$log_trans = mysqli_query($koneksi, "INSERT INTO log_trans (id_log, tanggal, jenis_transaksi, no_faktur, kd_cus, id_user)
        VALUES (NULL, NULL, 'Transaksi', '$noInvoice', '$kd_cus', '$en')");
	if (!$log_trans) throw new Exception("Insert log_trans gagal: " . mysqli_error($koneksi));

	// Update voucher if applicable
	if (isset($_POST['voucher_produk'])) {
		$voucher_produk = $_POST['voucher_produk'];
		$voucher_nilai = $_POST['voucher_nilai'];
		for ($b = 0; $b < count($voucher_produk); $b++) {
			$v_produk = $voucher_produk[$b];
			$update_voucher = mysqli_query($koneksi, "UPDATE retur_penjualan SET status_voucher = 2, faktur_voucher = '$noInvoice' WHERE no_voucher = '$v_produk'");
			if (!$update_voucher) throw new Exception("Update voucher gagal: " . mysqli_error($koneksi));
		}
	}

	// All successful
	mysqli_commit($koneksi);
	$_SESSION['status_simpan'] = 'berhasil';
	$result = [
		'success' => true,
		'message' => "Data berhasil disimpan",
		'no_invoice' => $noInvoice
	];
} catch (Exception $e) {
	mysqli_rollback($koneksi);
	$_SESSION['status_simpan'] = 'gagal';
	$result = [
		'success' => false,
		'message' => "Transaksi gagal: " . $e->getMessage()
	];
}

header("Content-type: application/json");
echo json_encode($result, JSON_PRETTY_PRINT);
