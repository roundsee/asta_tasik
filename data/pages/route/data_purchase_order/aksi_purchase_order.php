<?php
$dir = "../../../../";

$judulform = "Purchase Order";

$data = 'data_purchase_order';
$rute = 'purchase_order';
$aksi = 'aksi_purchase_order';

// $rute_detail = 'beli_detail';
$tujuan = 'purchase_order';

$tabel = 'pembelian';
$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'kd_po';
$f10 = 'tgl_po';
$f11 = 'tgl_rilis';
$f12 = 'durasi_kirim';
$f13 = 'term_payment';
$f14 = 'user_input';
$f15 = 'tujuan_kirim';
$f16 = 'statuts_invoice';
$f17 = 'tenggat_waktu';
$f18 = 'user_input_terbit';
$f19 = 'user_input_rilis';
$f20 = 'tarif_ppn';


$j1 = 'Kode Purchase Request';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';
$j9 = 'KD Po';
$J10 = 'Tgl Po';
$j11 = 'Tgl Rilis';
$j12 = 'Durasi Kirim';
$j13 = 'Term Of Payment';
$j14 = 'User Input';
$j15 = 'Tujuan Kirim';
$j16 = 'Status Invoice';
$j17 = 'Tenggat Waktu';
$j18 = 'Penerbit PO';
$j19 = 'Perilis PO';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';
$ff9 = 'satuan';
$ff10 = 'jumlah_pcs';



$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Disc';
$jj8 = 'urut';
$jj9 = 'satuan';



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
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    include $dir . "config/koneksi.php";
    include $dir . "config/library.php";

    $route = $_GET['route'];
    $act = $_GET['act'];
    $employee = $_SESSION['employee_number'];

    //Hapus 
    if ($route == $tujuan and $act == 'hapus') {

        mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");
        mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]'");

        echo "<script>alert('Data berhasil dihapus ');</script>";
        echo "<script>history.go(-1)</script>";
    } elseif ($route == $tujuan and $act == 'submit') {

        $query = mysqli_query($koneksi, "SELECT max(kd_beli) as kodeTerbesar FROM pembelian  ");
        $data = mysqli_fetch_array($query);
        $kode = $data['kodeTerbesar'];

        $urutan = (int) substr($kode, 6, 4);

        $urutan++;

        $kode_po = 'PO-' . sprintf("%04s", $urutan);

        echo "Nilai kd_beli yang baru: $kode_po<br>";


        $nilai_submit = 2;

        $query  = "UPDATE $tabel SET 
		status_pembelian = $nilai_submit,
        kd_beli='$kode_po'";

        $query .= "WHERE $f1 = '$_GET[id]' ";
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            // echo "<script>alert('Data berhasil diubah1.')</script>";
            // echo "<script>history.go(-1)</script>";
        }
    } elseif ($route == $tujuan and $act == 'hapus-detail') {

        // $query = mysqli_query($koneksi, "SELECT * FROM $tabel2 WHERE no_pengajuan = '$_GET[id]' AND no_account='$_GET[id2]' "); 


        mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]' AND $ff2='$_GET[id2]' AND $ff8 = '$_GET[id3]' ");

        // echo "<script>alert('Data berhasil dihapus ');</script>";
        echo "<script>history.go(-1)</script>";
    } elseif ($route == $tujuan and $act == 'cancel') {

        $query  = "UPDATE $tabel SET 
            status_pembelian = 1 ";
        $query .= "WHERE $f1 = '$_GET[id]' ";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            // Menampilkan pesan kesalahan jika query gagal dijalankan
            die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            // Kembali ke halaman sebelumnya jika query berhasil
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
        $ff4_value = isset($_POST[$ff4]) && is_numeric($_POST[$ff4]) ? intval($_POST[$ff4]) : 0;
        $ff7_value = isset($_POST[$ff7]) && is_numeric($_POST[$ff7]) ? intval($_POST[$ff7]) : 0;

        // Gunakan query dengan kondisi yang benar-benar integer atau NULL
        $query  = "UPDATE $tabel2 SET 
			$ff3 = $ff3_value,
			$ff9 = '$satuan',
			$ff10 = '$isi',
			$ff4 = $ff4_value,
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
    } elseif ($route == $tujuan and $act == 'edit') {

        $ppn = $_POST['ppn'];
        // echo $ppn;
        $query  = "UPDATE $tabel SET 
        $f3 = '$_POST[$f3]',
		$f15 = '$_POST[$f15]',
		$f13 = '$_POST[$f13]',
		$f7 = '$ppn',
        $f20 = '$_POST[$f20]'
		";
        $query .= "WHERE $f1 = '$_POST[$f1]' ";
        $result = mysqli_query($koneksi, $query);
        // var_dump($query);
        if (!$result) {
            die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil diubah.')</script>";
            echo "<script>history.go(-1)</script>";
        }
    } elseif ($route == $tujuan and $act == 'hapus-detail') {

        // $query = mysqli_query($koneksi, "SELECT * FROM $tabel2 WHERE no_pengajuan = '$_GET[id]' AND no_account='$_GET[id2]' "); 


        mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]' AND $ff2='$_GET[id2]' ");

        // echo "<script>alert('Data berhasil dihapus ');</script>";
        echo "<script>history.go(-1)</script>";
    } elseif ($route == $tujuan and $act == 'batal_rilis_po') {
        $tanggal_update = date('Y-m-d');

        $sql = "UPDATE pembelian 
        SET status_pembelian = -1, 
            tgl_batal_rilis = '$tanggal_update', 
            user_input_bata_rilis = '$employee'
        WHERE kd_beli = '{$_GET['id']}'";

        if (mysqli_query($koneksi, $sql)) {
            echo "Query OK: " . $sql;
        } else {
            echo "Query FAILED: " . $sql . " | Error: " . mysqli_error($koneksi);
        }

        echo "<script>
        alert('Berhasil Membatalkan PO');
        window.location = '../../main.php?route=po&act&ide={$_SESSION['employee_number']}';
        </script>";
    }
}
