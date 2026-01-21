<?php
session_start();


$employee = $_SESSION['employee_number'];
$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';

$j1 = 'no_invoice';
$j2 = 'Tanggal Invoice';
$j3 = 'Kode Po';
$j4 = 'Kode Supp';
$j5 = 'Status Payment';
$j6 = 'Status Print';
$j7 = 'Status Invoice';

$tabel2 = 'pembelian_invoice_detail';
$ff1 = 'no_invoice';
$ff2 = 'kd_po';
$ff3 = 'kd_brg';
$ff4 = 'nilai';
$ff5 = 'disc';
$ff6 = 'jml_pcs';


$jj1 = 'no invoice';
$jj2 = 'Kode Po';
$jj3 = 'Kode Barang';
$jj4 = 'Nilai';
$jj5 = 'Disc';
$jj6 = 'Jumlah Pcs';

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

    // Tambah Staff
    if ($route == 'payment_add' && $act == 'input') {
        // Ambil data dari form
        $no_invoice = $_POST['nomor_invoice']; // Nomor Invoice
        $kd_po = $_POST[$f1]; // Kode PO
        $kd_supp = $_POST[$f3]; // Kode Supplier
        $nama_supp = $_POST['nama_supplier']; // Nama Supplier
        $ppn = $_POST['ppn']; // PPN status
        $tanggal_payment = $_POST['tanggal_payment']; // Tanggal Pembayaran
        $metode_payment = $_POST['metode_payment']; // Jenis Transaksi
        $akun = $_POST['akun']; // Akun
        $reff = $_POST['reff']; // Referensi 
        $jumlah_payment = $_POST['jumlah_payment']; // Jumlah Pembayaran
        $status = $_POST['status_lunas'];
        $payment_nota = $_POST['nama_nota_retur'] ?? '';
        if (!empty($payment_nota)) {
            $update_status_Retur_beli_nota = "UPDATE retur_pembelian SET no_invoice = '$no_invoice',`status_retur`=1 WHERE nota_retur = '$payment_nota'";
            if (mysqli_query($koneksi, $update_status_Retur_beli_nota)) {
                // echo "Update Daa.";
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }


        $status_payment = ($status == 'LUNAS') ? 2 : 1;

        // Ambil data detail barang dari form
        $id = isset($_POST['id']) ? $_POST['id'] : [];
        $kd_brg = isset($_POST['kd_brg']) ? $_POST['kd_brg'] : [];
        $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];
        $jumlah_datang = isset($_POST['jumlah_datang']) ? $_POST['jumlah_datang'] : [];
        $harga = isset($_POST['harga']) ? $_POST['harga'] : [];
        $diskon = isset($_POST['diskon']) ? $_POST['diskon'] : [];
        $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : [];

        // Iterasi untuk detail barang
        // echo "\nDetail Barang:\n";
        // if (is_array($kd_brg) && count($kd_brg) > 0) {
        //     foreach ($kd_brg as $index => $value) {
        //         echo "Kode Barang: " . $kd_brg[$index] . "\n";
        //         echo "Jumlah Barang: " . $jumlah[$index] . "\n";
        //         echo "Harga Barang: " . $harga[$index] . "\n";
        //         echo "Diskon: " . $diskon[$index] . "\n";
        //         echo "Subtotal: " . $subtotal[$index] . "\n\n";
        //     }
        // } else {
        //     echo "Tidak ada detail barang yang dimasukkan.\n";
        // }
        $tanggal_payment = $_POST['tanggal_payment']; // Tanggal Pembayaran
        $tahun_bulan = date('ym', strtotime($tanggal_payment)); // Format tahun dan bulan: YYMM

        // Query untuk mencari payment terakhir di bulan yang sama
        $query_last_payment = mysqli_query($koneksi, "SELECT no_payment FROM payment WHERE no_payment LIKE 'PAY-OUT-$tahun_bulan%' ORDER BY no_payment DESC LIMIT 1");

        if (mysqli_num_rows($query_last_payment) > 0) {
            // Jika sudah ada payment di bulan tersebut
            $data_last_payment = mysqli_fetch_assoc($query_last_payment);
            $last_no_payment = $data_last_payment['no_payment'];

            // Ambil nomor terakhir dan tambahkan 1
            $last_number = (int)substr($last_no_payment, 14); // Ambil angka setelah PAY-OUT-YYMM-
            $new_number = str_pad($last_number + 1, 5, '0', STR_PAD_LEFT); // Tambahkan dan format dengan 5 digit
        } else {
            // Jika belum ada payment di bulan tersebut, mulai dari 00001
            $new_number = "00001";
        }

        // Buat no_payment baru
        $no_payment = "PAY-OUT-$tahun_bulan-$new_number";

        // Simpan $no_payment ke database atau gunakan dalam proses selanjutnya



        // Normalisasi nilai harga dan diskon
        // $harga = array_map('floatval', array_map('str_replace', [',', ',', '.'], ['', '', ''], $harga));
        // $diskon = array_map('floatval', array_map('str_replace', [',', ',', '.'], ['', '', ''], $diskon));
        // $jumlah = array_map('intval', $jumlah);
        // $jumlah_datang = array_map('intval', $jumlah_datang);

        $update_status_pembelian_invoice = "UPDATE pembelian_invoice SET status_payment = '$status_payment' WHERE no_invoice = '$no_invoice'";
        if (mysqli_query($koneksi, $update_status_pembelian_invoice)) {
            // echo "Update Daa.";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

        // Query insert pembayaran
        $query = "INSERT INTO payment (no_invoice, jumlah_payment, no_payment, tanggal_payment, insert_oleh, metode_payment, akun, reff, status, ppn)
              VALUES ('$no_invoice', '$jumlah_payment', '$no_payment', '$tanggal_payment', '$employee', '$metode_payment', '$akun', '$reff', '$status_payment', '$ppn')";

        if (mysqli_query($koneksi, $query)) {
            // echo "Data pembayaran berhasil disimpan.";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

        // Proses data barang (detail pembayaran)
        // foreach ($kd_brg as $key => $value) {
        //     if (isset($id[$key])) {
        //         $kd_barang = $kd_brg[$key];
        //         $jumlah_barang = $jumlah[$key];
        //         $jumlah_datang_barang = $jumlah_datang[$key];
        //         $harga_barang = $harga[$key];
        //         $diskon_barang = $diskon[$key];

        //         // // Query insert detail pembayaran
        //         $query_detail = "INSERT INTO payment_detail (no_payment, kd_brg, jumlah, jumlah_datang, harga, disc)
        //                      VALUES ('$no_payment', '$kd_barang', '$jumlah_barang', '$jumlah_datang_barang','$harga_barang', '$diskon_barang')";

        //         if (mysqli_query($koneksi, $query_detail)) {
        //             echo "Detail barang berhasil disimpan.";
        //         } else {
        //             echo "Error: " . mysqli_error($koneksi);
        //         }
        //     }
        // }
        echo "<script>alert('berhasil melakukan pembayaran')</script>";
        echo "<script>history.go(-2)</script>";
    } elseif ($route == 'payment_based_supplier' and $act == 'report') {


        // $tgl_awal = $_POST['tgl_awal'];
        // $tgl_akhir = $_POST['tgl_akhir'];
        $supplier = $_POST['supplier'];
        $outlet = $_POST['outlet'];
        $area = $_POST['area'];

        // echo '<br/>' . $tgl_awal;
        // echo '<br/>' . $tgl_akhir;
        // echo '<br/>' . $kota;
        // echo '<br/>' . $outlet;
        // echo '<br/>' . $area;

        if ($supplier != '') {
            $filter = 'supplier';
            $nilai = $supplier;
        } elseif ($outlet != '') {
            $filter = 'outlet';
            $nilai = $outlet;
        } elseif ($area != '') {
            $filter = 'area';
            $nilai = $area;
        } else {
            $filter = 'semua';
            $nilai = 'semua';
        }

        header('location:../../main.php?route=' . $route . '&act=report&filter=' . $filter . '&nilai=' . $nilai);
    }
}
