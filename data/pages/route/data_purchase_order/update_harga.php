<?php
include '../../../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kd_brg = $_POST['kd_brg'];
    $kd_po = $_POST['kd_po'];
    $urut = $_POST['urut'];
    $harga_baru = str_replace(",", "", $_POST['harga_baru']);

    // Persiapkan query untuk mencegah SQL Injection
    $stmt = $koneksi->prepare("UPDATE pembelian_detail SET price = ? WHERE kd_brg = ? AND kd_po = ? AND urut = ?");
    $stmt->bind_param("issi", $harga_baru, $kd_brg, $kd_po, $urut);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "Harga berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui harga: " . $stmt->error;
    }

    $stmt->close();
}
?>
