<?php
include '../../../../config/koneksi.php';

session_start();

$employee = $_SESSION['employee_number'];

$judulform = 'Retur Penjualan';
$data = 'data_penjualan_retur';
$aksi = 'aksi_penjualan_retur';
$rute = 'penjualan_retur';
$rute_detail = 'penjualan_retur_detail';
$view = 'penjualan_retur_view';


$tabel = 'retur_penjualan';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';


// Aktivasi error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['no_voucher'])) {
    $kd_voucher = $_GET['no_voucher'];

    // Update status_pembelian menjadi 3
    $update_status = mysqli_query($koneksi, "UPDATE $tabel SET status_voucher = 1 WHERE no_voucher = '$kd_voucher'");

    // if ($update_status) {
    //     echo "<script>window.print();</script>";
    // } else {
    //     echo "<script>alert('Gagal mengupdate status pembelian');</script>";
    // }

    // Query untuk mendapatkan data pembelian berdasarkan kd_beli
    $sql = mysqli_query($koneksi, "SELECT 
            rp.tanggal_retur,
            rp.kd_retur,
            rp.faktur,
            rp.login_hash,
            rp.no_voucher,
            SUM(rp.banyak) AS faktur_seluruh,
            SUM(rp.total_retur) AS seluruh_retur,
            SUM(rp.banyak * rp.harga) AS total_nilai_faktur, -- Perbaikan nilai faktur
            SUM(rp.total_retur * rp.harga) AS total_nilai_retur -- Perbaikan nilai retur
        FROM retur_penjualan rp 
        WHERE rp.no_voucher = '$kd_voucher'
        GROUP BY rp.faktur
        ORDER BY rp.tanggal_retur, rp.faktur ASC
           ");
    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail pembelian dari tabel kedua

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Voucher</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background: #f8f9fa;
        }

        .voucher-container {
            width: 350px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .voucher-detail {
            text-align: left;
            font-size: 16px;
            margin: 10px 0;
        }

        .voucher-detail strong {
            color: #007bff;
        }

        .voucher-total {
            font-size: 18px;
            font-weight: bold;
            color: #d9534f;
            margin-top: 15px;
            border-top: 2px solid #007bff;
            padding-top: 10px;
        }

        .print-btn {
            margin-top: 15px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .print-btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body onload="printOut()">
    <div class="voucher-container">
        <h2>Voucher Retur</h2>
        <div class="voucher-detail">
            <p>Kode Retur: <strong><?php echo $data['kd_retur']; ?></strong></p>
            <p>Tanggal Retur: <strong><?php echo $data['tanggal_retur']; ?></strong></p>
            <p>Faktur: <strong><?php echo $data['faktur']; ?></strong></p>
            <p>Voucher: <strong><?php echo $data['no_voucher']; ?></strong></p>
        </div>
        <div class="voucher-total">
            Total Retur: Rp <?php echo number_format($data['total_nilai_retur'], 0, ',', '.'); ?>
        </div>
    </div>
    <script>
        var employee = "<?php echo $employee; ?>";
        var lama = 3000;
        var t = null;

        function printOut() {
            window.print();
            t = setTimeout(function() {
                document.location.replace(`../../main.php?route=penjualan_retur&act&ide=${employee}`);
            }, lama);
        }
    </script>

</html>


</html>