<?php
include '../../../../config/koneksi.php';

$judulform = "Purchase Order";

$data = 'lap_invoice_pembelian';
$aksi = 'aksi_invoice_pembelian';
$rute = 'invoice_pembelian';

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


// Aktivasi error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['no_invoice'])) {
    $no_invoice = $_GET['no_invoice'];

    // Update status_pembelian menjadi 3
    $update_status = mysqli_query($koneksi, "UPDATE $tabel SET status_print = 1 WHERE no_invoice = '$no_invoice'");

    if ($update_status) {
        echo "<script>window.print();</script>";
    } else {
        echo "<script>alert('Gagal mengupdate status pembelian');</script>";
    }

    // Query untuk mendapatkan data pembelian berdasarkan kd_beli
    $sql = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE no_invoice='$no_invoice'");
    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail pembelian dari tabel kedua
    $sql2 = mysqli_query($koneksi, "SELECT *, barang.nama FROM $tabel2 
    JOIN barang ON barang.kd_brg = $tabel2.kd_brg
    WHERE no_invoice='$no_invoice'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Invoice</title>

</head>

<body onload="window.print();" style="font-family: 'Segoe UI', Tahoma, sans-serif; color: #333; background-color: #f9f9f9;">
    <div style="max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

        <h2 style="text-align: center; color: #3b5998; font-size: 26px; margin-bottom: 10px;">Detail Invoice</h2>

        <div style="margin-bottom: 30px;">
            <p><strong>Nomor Invoice:</strong> <?php echo $data[$f1]; ?></p>
            <p><strong>Tanggal:</strong> <?php echo $data[$f2]; ?></p>
            <p><strong>Kode PO:</strong> <?php echo $data[$f3]; ?></p>
        </div>

        <h3 style="text-align: center; color: #333; border-bottom: 2px solid #3b5998; padding-bottom: 10px; margin-bottom: 20px;">Invoice</h3>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <thead>
                <tr style="background-color: #f2f2f2; text-align: left;">
                    <th style="border: 1px solid #ddd; padding: 10px;">No</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Kode Barang</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Nama Barang</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: right;">Jumlah Pcs</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: right;">Diskon</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: right;">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $subtotal = 0;
                $diskon = 0;
                while ($item = mysqli_fetch_array($sql2)) {
                    $subtotal += $item[$ff4];
                    $diskon += $item['disc'];
                    $total = $subtotal - $diskon;
                ?>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><?php echo $no++; ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $item['kd_brg']; ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px;"><?php echo $item['nama']; ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: right;"><?php echo number_format($item[$ff6]); ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: right;"><?php echo number_format($item[$ff5]); ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: right;"><?php echo number_format($item[$ff4]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right; padding: 10px; border-top: 1px solid #ccc;">Sub Total</td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: right; border-top: 1px solid #ccc;"><?php echo number_format($subtotal); ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right; padding: 10px; border-top: 1px solid #ccc;">Diskon</td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: right; border-top: 1px solid #ccc;"><?php echo number_format($diskon); ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right; padding: 10px; border-top: 2px solid #4CAF50; color: #4CAF50;"><strong>Total</strong></td>
                    <td style="border: 1px solid #ddd; padding: 10px; text-align: right; border-top: 2px solid #4CAF50; color: #4CAF50;"><strong><?php echo number_format($total); ?></strong></td>
                </tr>
            </tfoot>

        </table>

        <footer style="text-align: center; margin-top: 40px; color: #555;">
            <p>Terima kasih telah memilih layanan kami.</p>
            <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami di <strong>support@example.com</strong>.</p>
        </footer>

    </div>

    <script>
        window.onafterprint = function() {
            window.location.href = 'purchase_order.php';
        };
    </script>

</body>


</html>