<?php
include "../../../../config/koneksi.php";
header('Content-Type: application/json');
$employee = isset($_GET['user']) ? $_GET['user'] : '';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';
$barang = isset($_GET['barang']) ? $_GET['barang'] : '';
$jumlah = isset($_GET['jumlah']) ? $_GET['jumlah'] : '';

$query_barang = "SELECT harga FROM barang WHERE kd_brg = '$barang'";
$result_barang = mysqli_query($koneksi, $query_barang);

if (mysqli_num_rows($result_barang) > 0) {
    $row = mysqli_fetch_assoc($result_barang);
    $harga = $row['harga'];
}
// $query_update = "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'";
// $result_update = mysqli_query($koneksi, $query_update);

// if (!$result_update) {
//     die("Error Update Inventory: " . mysqli_error($koneksi));
// }
// $updatestock = mysqli_query($koneksi, "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
// if (mysqli_affected_rows($koneksi) == 0) {
//     $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok,satuan) VALUES ('$barang', '$lokasi', '$jumlah','Pcs')");
// }
$check = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM inventory WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
$row = mysqli_fetch_assoc($check);

if ($row['count'] > 0) {
    // Record exists, update it
    $updatestock = mysqli_query($koneksi, "UPDATE inventory SET stok = '$jumlah' WHERE kd_brg = '$barang' AND kd_cus = '$lokasi'");
} else {
    // Record doesn't exist, insert it
    $insertstock = mysqli_query($koneksi, "INSERT INTO inventory (kd_brg, kd_cus, stok, satuan) VALUES ('$barang', '$lokasi', '$jumlah', 'Pcs')");
}

$query_check = "SELECT kd_cus FROM mutasi_stok WHERE tgl = '$tanggal' AND kd_cus = '$lokasi' AND kd_brg = '$barang'";
$result_check = mysqli_query($koneksi, $query_check);

if (mysqli_num_rows($result_check) > 0) {

    $query_update = "UPDATE mutasi_stok SET 
    qt_opname_hari = qt_opname_hari + ($jumlah - qt_akhir),
    nilai_opname_hari = nilai_opname_hari + (($jumlah * $harga) - nilai_akhir),
    qt_akhir = qt_akhir + ($jumlah - qt_akhir),
    qt_tersedia = $jumlah,
    nilai_tersedia = $jumlah * $harga,
    harga_rata = CASE 
                 WHEN qt_tersedia > 0 THEN nilai_tersedia / qt_tersedia
                 ELSE $harga
                 END,                          
    hpp_jual = CASE 
                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_jual
                 ELSE $harga * qt_jual
                 END,
    nilai_akhir = CASE 
                 WHEN qt_tersedia > 0 THEN (nilai_tersedia / qt_tersedia) * qt_akhir
                 ELSE $harga * qt_akhir
                 END
    WHERE tgl = '$tanggal' AND kd_cus = '$lokasi' AND kd_brg = '$barang'";

    $resut_update = mysqli_query($koneksi, $query_update);
    if (!$resut_update) {
        die("Query update ke mutasi_semua gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }
    $nilai = $jumlah * $harga;


    $insertstock = mysqli_query($koneksi, "INSERT INTO opname_detail (kd_cus, kd_brg, tgl, stok_opname, nilai_opname, user_input) VALUES ('$lokasi', '$barang', '$tanggal', '$jumlah', '$nilai', '$employee')");
}

if (!$barang || !$lokasi || !$tanggal || !$jumlah) {
    echo json_encode([
        'error' => 'missing parameter(s)',
        'barang' => $barang,
        'lokasi' => $lokasi,
        'tanggal' => $tanggal,
        'jumlah' => $jumlah
    ]);
    exit;
} else {
    echo json_encode([
        'success' => true,
        'barang' => $barang,
        'lokasi' => $lokasi,
        'tanggal' => $tanggal,
        'jumlah' => $jumlah
    ]);
    exit;
}
