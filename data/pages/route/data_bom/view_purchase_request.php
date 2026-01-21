<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda
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

// Pastikan kd_beli ada dalam query string
if (!isset($_GET['kd_beli'])) {
    die("pembelian tidak ditemukan.");
}
$kd_beli = $_GET['kd_beli'];

// Query untuk mengambil detail pembelian
$sql = "SELECT *
        FROM pembelian p
        JOIN pembelian_detail pb ON pb.kd_beli = p.kd_beli
        WHERE p.kd_beli = '$kd_beli'";

$result = mysqli_query($koneksi, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $pembelian = mysqli_fetch_assoc($result);
} else {
    die("pembelian tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request Detail</title>
    <!-- Bootstrap CSS -->
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Purchase Request Detail</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p><strong>Kode Purchase:</strong> <?php echo $pembelian['kd_beli']; ?></p>
                    <p><strong>Tanggal PO :</strong> <?php echo $pembelian['tgl_beli']; ?></p>
                    <p><strong>Kode Supplier:</strong> <?php echo $pembelian['kd_supp']; ?></p>
                    <p><strong>Status:</strong>

                        <?php if ($pembelian['status_pembelian'] == 0) { ?>
                            Belum Terbit PO
                        <?php } elseif ($pembelian['status_pembelian'] == 1) { ?>
                            Terbit PO
                        <?php } else { ?>
                            PO Sudah Rilis
                        <?php } ?>



                </div>

                <!-- Tabel untuk menampilkan detail barang -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_items = "SELECT pembelian_detail.*, barang.nama AS nama_barang
                                         FROM pembelian_detail
                                         JOIN barang ON barang.kd_brg = pembelian_detail.kd_brg
                                         WHERE kd_beli = '$kd_beli'";
                            $result_items = mysqli_query($koneksi, $sql_items);
                            if (!$result_items) {
                                die("Query error: " . mysqli_error($koneksi));
                            }

                            while ($item = mysqli_fetch_assoc($result_items)) {
                            ?>
                                <tr>
                                    <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                    <td><?php echo ucwords(strtolower($item['nama_barang'])); ?></td>
                                    <td class="text-end" style="text-align: right;"><?php echo number_format($item['jml'] * $item['jumlah_pcs']); ?></td>
                                    <td class="text-end" style="text-align: right;"><?php echo number_format($item['price']); ?></td>
                                    <td><?php echo ucwords(strtolower($item['satuan'])); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <!-- <a href="#" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                </div> -->
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>