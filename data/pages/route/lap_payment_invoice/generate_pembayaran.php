<?php
include '../../../../config/koneksi.php';
session_start();
$employee = $_SESSION['employee_number'];

if (isset($_POST['kd_beli'])) {
    // Ambil data dari form
    $kd_beli = $_POST['no_payment'];
    $kd_po = $_POST['kd_po'];
    $tanggal_payment = $_POST['tanggal_payment'];
    $metode_payment = $_POST['metode_payment'];
    $reff = $_POST['reff'];
    $total_tagihan = $_POST['total_tagihan'];
    $jumlah_payment = $_POST['jumlah_payment'];
    $nilai_sisa = $_POST['nilai_sisa'];
    $status_pembayaran = $_POST['status_pembayaran'];

    // Ambil data array dari qty_terima
    $qty_terima = $_POST['qty_terima'];

    // Tampilkan data yang diambil
    // echo "<h2>Data Pembayaran</h2>";
    // echo "Kode Pembelian: $kd_beli<br>";
    // echo "Kode PO: $kd_po<br>";
    // echo "Tanggal Pembayaran: $tanggal_payment<br>";
    // echo "Metode Pembayaran: $metode_payment<br>";
    // echo "Referensi: $reff<br>";
    // echo "Total Tagihan: $total_tagihan<br>";
    // echo "Jumlah Pembayaran: $jumlah_payment<br>";
    // echo "Nilai Sisa: $nilai_sisa<br>";
    // echo "Status Pembayaran: $status_pembayaran<br>";


    // Tentukan status berdasarkan status pembayaran
    $status = ($status_pembayaran === 'Lunas') ? 2 : 1;

    echo "<h3>Detail Barang</h3>";
    if (!empty($qty_terima)) {
        foreach ($qty_terima as $key => $qty) {
            echo "Qty Terima Barang ke-" . ($key + 1) . ": $qty<br>";
        }
    } else {
        echo "Tidak ada barang yang diterima.<br>";
    }



    // SQL untuk update tabel payment berdasarkan no_invoice
    $sqlUpdatePayment = "UPDATE payment 
                         SET jumlah_payment = jumlah_payment + '$jumlah_payment', 
                             tanggal_payment = '$tanggal_payment', 
                             insert_oleh = '$employee', 
                             metode_payment = '$metode_payment', 
                             reff = '$reff',
                             status = '$status'
                         WHERE no_payment = '$kd_beli'";

    // Eksekusi query update ke tabel payment
    if (mysqli_query($koneksi, $sqlUpdatePayment)) {
        echo "Tabel payment berhasil diupdate.";
    } else {
        echo "Error updating payment: " . mysqli_error($koneksi);
    }

    // SQL untuk update tabel pembelian_detail berdasarkan kd_beli
    $sqlUpdatePembelianDetail = "UPDATE payment_detail 
                                 SET tanggal_payment = '$tanggal_payment'
                                 WHERE no_payment = '$kd_beli'";

    // Eksekusi query update ke tabel pembelian_detail
    if (mysqli_query($koneksi, $sqlUpdatePembelianDetail)) {
        echo "Tabel pembelian_detail berhasil diupdate.";
    } else {
        echo "Error updating pembelian_detail: " . mysqli_error($koneksi);
    }
    

echo "<script>alert('pembayaran berhasil di lakukan ')</script>";
echo "<script>history.go(-1)</script>";

} else {
    echo "Tidak ada data yang dikirim.";
}
?>
