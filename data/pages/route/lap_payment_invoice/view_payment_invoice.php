<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda
$data = 'lap_payment_invoice';
session_start();

// Pastikan koneksi database berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Pastikan login_hash diambil dari session
if (!isset($_SESSION['login_hash'])) {
    die("Session not set.");
}
$login_hash = $_SESSION['login_hash'];

// Pastikan no_invoice ada dalam query string
if (isset($_GET['no_invoice'])) {
    $no_invoice = $_GET['no_invoice'];

    // Query untuk mengambil detail invoice
    $sql = "SELECT i.*, s.nama AS nama_supplier
            FROM pembelian_invoice i
            JOIN supplier s ON s.kd_supp = i.kd_supp
            WHERE i.no_invoice = '$no_invoice'";

    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $invoice = mysqli_fetch_assoc($result);
    } else {
        die("Invoice tidak ditemukan.");
    }
} else {
    die("No invoice tidak diberikan.");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Invoice Detail</title>
</head>

<body>
    <div class="invoice">
        <div class="information">
            <p>Invoice #: <?php echo $invoice['no_invoice']; ?></p>
            <p>Tanggal: <?php echo $invoice['tanggal_invoice']; ?></p>
            <p>Nama Supplier: <?php echo $invoice['nama_supplier']; ?></p>
        </div>
        <form method="POST" action="route/lap_invoicing_gelondongan/proses_payment.php">
            <input type="hidden" name="no_invoice" value="<?php echo $invoice['no_invoice']; ?>">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="heading">
                            <th>No Invoice</th>
                            <th>Tanggal</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Total Nilai</th>
                            <th>Diskon</th>
                            <th>Tagihan</th>
                            <th>Total Pembayaran</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_items = "SELECT pid.*, b.nama AS nama_barang, i.tanggal_invoice
                                      FROM pembelian_invoice_detail pid
                                      JOIN pembelian_invoice i ON i.no_invoice = pid.no_invoice
                                      JOIN barang b ON b.kd_brg = pid.kd_brg
                                      WHERE pid.no_invoice = '$no_invoice'";
                        $result_items = mysqli_query($koneksi, $sql_items);
                        if (!$result_items) {
                            die("Query error: " . mysqli_error($koneksi));
                        }
                        $totalSemua = 0;
                        $sisa = 0;
                        while ($item = mysqli_fetch_assoc($result_items)) {
                            // Inisialisasi variabel $total_payment_kasir agar tidak error
                            $total_payment_kasir = 0;

                            // Query pembayaran (insert_oleh = 5)
                            $query_payment_pembayaran = "SELECT SUM(jumlah_payment) AS total_payment 
                                    FROM payment 
                                    WHERE no_invoice = '$no_invoice' AND kd_brg = '{$item['kd_brg']}' AND tanggal='{$item['tanggal_invoice']}'";
                            $sql_payment_pembayaran = mysqli_query($koneksi, $query_payment_pembayaran);
                            if (!$sql_payment_pembayaran) {
                                die("Query error: " . mysqli_error($koneksi));
                            }
                            $payment_pembayaran = mysqli_fetch_assoc($sql_payment_pembayaran);
                            $total_payment_pembayaran = $payment_pembayaran['total_payment'] ?? 0;
                            

                            // Hitung total pembayaran
                            $total_pembayaran = $item['nilai'] - $item['disc'] - $total_payment_kasir;
                            $sisa = $total_pembayaran - $total_payment_pembayaran;
                        ?>
                            <tr class="item">
                                <td><?php echo $item['no_invoice']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($item['tanggal_invoice'])); ?></td>
                                <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                <td><?php echo ucwords(strtolower($item['nama_barang'])); ?></td>
                                <td style="text-align: right;"><?php echo number_format($item['nilai']); ?></td>
                                <td style="text-align: right;"><?php echo number_format($item['disc']); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_pembayaran); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_payment_pembayaran); ?></td>
                                <td style="text-align: right;"><?php echo number_format($sisa); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>

        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const paymentInputs = document.querySelectorAll('.payment-input');
                paymentInputs.forEach(input => {
                    new AutoNumeric(input, {
                        digitGroupSeparator: ',',
                        decimalPlaces: 0,
                        allowDecimalPadding: false
                    });
                });
            });
        </script>
    </div>
</body>

</html>
