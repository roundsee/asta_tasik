<?php
include '../../../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kd_brg = $_POST['kd_brg'];
    $kd_po = $_POST['kd_po'];
    $urut = $_POST['urut'];
    $diskon_baru = str_replace(",", "", $_POST['diskon_baru']);

    // Persiapkan query untuk mencegah SQL Injection
    $stmt = $koneksi->prepare("UPDATE pembelian_detail SET disc = ? WHERE kd_brg = ? AND kd_po = ? AND urut = ?");
    $stmt->bind_param("issi", $diskon_baru, $kd_brg, $kd_po, $urut);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "Harga berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui harga: " . $stmt->error;
    }

    $stmt->close();
}
?>
