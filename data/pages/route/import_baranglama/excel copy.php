<?php
// Sertakan autoloader dari PHPExcel
// require_once 'excel/Classes/PHPExcel/Autoloader.php';
require 'excel/Classes/PHPExcel/Autoloader.php';

// Sertakan file-file yang diperlukan secara manual (contoh)
require 'excel/Classes/PHPExcel/IOFactory.php';
require 'excel/Classes/PHPExcel.php';

// Koneksi ke database
require 'db_config.php';

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Lokasi file Excel
$inputFileName = 'testt.xlsx';

// Load file Excel
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($inputFileName);

// Ambil data dari sheet pertama (misalnya)
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

// Loop melalui data Excel
foreach ($sheetData as $row) {
    // Siapkan data untuk dimasukkan ke database
    $tgl = $row['A']; // Kolom A
    $regional = $row['B']; // Kolom B
    $kd_cus = $row['C']; // Kolom C
    $nama_outlet = $row['D'];
    $kd_sage = $row['E'];
    $nama_barang = $row['F'];
    $satuan = $row['G'];
    $qty_awal = $row['H'];
    $nilai_awal = $row['I'];
    $qty_beli = $row['J'];
    $nilai_beli = $row['K'];
    $qt_produksi = $row['L'];
    $nilai_produksi = $row['M'];
    $qt_terima_int = $row['N'];
    $nilai_terima_int = $row['O'];
    $qt_tersedia = $row['P'];
    $nilai_tersedia = $row['Q'];
    $harga_rata = $row['R'];
    $qt_kirim_int = $row['S'];
    $nilai_kirim_int = $row['T'];
    $qt_pake = $row['U'];
    $nilai_pake = $row['V'];
    $qt_jual = $row['W'];
    $nilai_jual = $row['X'];
    $hpp_jual = $row['Y'];
    $qt_akhir = $row['Z'];
    $nilai_akhir = $row['AA'];
    $harga_patokan_hpp = $row['AB'];
    $nilai_qty_hpp = $row['AC'];
    // Lanjutkan dengan kolom lainnya...

    // Buat query untuk memasukkan data ke tabel mutasi_a
    $sql = "INSERT INTO mutasi_a (tgl, regional, kd_cus, nama_outlet, kd_sage, nama_barang, satuan, qty_awal, nilai_awal, qty_beli, nilai_beli, qt_produksi, nilai_produksi, qt_terima_int, nilai_terima_int, qt_tersedia, nilai_tersedia, harga_rata, qt_kirim_int, nilai_kirim_int, qt_pake, nilai_pake, qt_jual, nilai_jual, hpp_jual, qt_akhir, nilai_akhir, harga_patokan_hpp, nilai_qty_hpp)
            VALUES ('$tgl', '$regional', '$kd_cus', '$nama_outlet', '$kd_sage', '$nama_barang', '$satuan', '$qty_awal', '$nilai_awal', '$qty_beli', '$nilai_beli', '$qt_produksi', '$nilai_produksi', '$qt_terima_int', '$nilai_terima_int', '$qt_tersedia', '$nilai_tersedia', '$harga_rata', '$qt_kirim_int', '$nilai_kirim_int', '$qt_pake', '$nilai_pake', '$qt_jual', '$nilai_jual', '$hpp_jual', '$qt_akhir', '$nilai_akhir', '$harga_patokan_hpp', '$nilai_qty_hpp')";

    // Jalankan query
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diimpor.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
