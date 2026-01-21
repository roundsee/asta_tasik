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
        <!-- Anda dapat menambahkan detail tambahan dari invoice di sini -->
        <form method="POST" action="route/lap_payment_invoice/proses_payment.php">
            <input type="hidden" name="no_invoice" value="<?php echo $invoice['no_invoice']; ?>">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="heading">
                            <th>No Invoice</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>No Kartu</th>
                            <th>Nama Karyawan</th>
                            <th>Tindakan</th>
                            <th>Total Nilai</th>
                            <th>Diskon</th>
                            <th>Dibayar Kasir</th>
                            <th>Tagihan</th>
                            <th>Total Pembayaran</th>
                            <th>Sisa</th>
                            <?php if ($login_hash == 6 || $login_hash == 6) { ?>
                                <th style="width: 240px;">Payment</th>
                            <?php } ?>
                            <?php if ($login_hash == 6) { ?>
                                <th>Print</th>
                            <?php } ?>
                            <?php if ($login_hash == 6) { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_items = "SELECT ipd.no_invoice, p.nama_pasien, ipd.nilai, ipd.tanggal, ipd.item, ipd.no_card, ipd.tindakan,ipd.diskon
                        FROM invoice_perusahaan_detail ipd
                        JOIN pasien p ON p.kd_pasien = ipd.item 
                        WHERE ipd.no_invoice = '$no_invoice'";
                        $result_items = mysqli_query($koneksi, $sql_items);
                        if (!$result_items) {
                            die("Query error: " . mysqli_error($koneksi));
                        }
                        $totalSemua = 0;
                        while ($item = mysqli_fetch_assoc($result_items)) {
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
                            

                            // Hitung nilai yang tersisa setelah pembayaran
                            $total_pembayaran = $item['nilai'] - $item['diskon'] - $total_payment_kasir;
                            $sisa = $total_pembayaran - $total_payment_pembayaran;
                        ?>
                            <tr class="item">
                                <td>
                                    <a href="main.php?route=detail_payment&no_invoice=<?php echo $item['no_invoice']; ?>&kode_pasien=<?php echo $item['item']; ?>&tanggal=<?php echo $item['tanggal']; ?>">
                                        <?php echo $item['no_invoice']; ?>
                                    </a>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($item['tanggal'])); ?></td>
                                <td><?php echo ucwords(strtolower($item['nama_pasien'])); ?></td>
                                <td><?php echo $nasabah_no_card; ?></td>
                                <td><?php echo ucwords(strtolower($nasabah_nama_nasabah)); ?></td>
                                <td><?php echo ucwords(strtolower($item['tindakan'])); ?></td>
                                <td style="text-align: right;"><?php echo number_format($item['nilai']); ?></td>
                                <td style="text-align: right;"><?php echo number_format($item['diskon']); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_payment_kasir); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_pembayaran); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_payment_pembayaran); ?></td>
                                <td style="text-align: right;"><?php echo number_format($sisa); ?></td>
                                <?php if ($login_hash == 5 || $login_hash == 2) { ?>
                                    <td>
                                        <input type="hidden" name="tanggal[<?php echo $item['item']; ?>][<?php echo $item['tanggal']; ?>]" value="<?php echo $item['tanggal']; ?>">
                                        <input type="text" name="payment[<?php echo $item['item']; ?>][<?php echo $item['tanggal']; ?>]" value="" class="form-control payment-input" style="text-align: left;">
                                    </td>
                                <?php } ?>
                                <?php if ($login_hash == 4) { ?>
                                    <td>
                                        <a href="route/<?php echo $data; ?>/print_invoice_personal.php?no_invoice=<?php echo $invoice['no_invoice']; ?>&item=<?php echo $item['item']; ?>" class="btn btn-success">
                                            <i class="fa-solid fa-print"></i> Print
                                        </a>
                                    </td>
                                <?php } ?>
                                <?php if ($login_hash == 14) { ?>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='main.php?route=edit_invoice&item=<?php echo $item['item']; ?>'">Edit</button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
                <?php if ($login_hash == 5 || $login_hash == 2) { ?>
                    <div style="text-align: right;">
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                <?php } ?>
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