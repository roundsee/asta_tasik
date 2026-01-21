<?php
include '../../../../config/koneksi.php'; // Sesuaikan dengan file koneksi Anda
session_start();

// Periksa koneksi database
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Periksa apakah session login_hash tersedia
if (!isset($_SESSION['login_hash'])) {
    die("Session tidak tersedia.");
}
$login_hash = $_SESSION['login_hash'];

// Periksa apakah surat_jalan ada dalam query string
if (!isset($_GET['surat_jalan'])) {
    die("Surat Jalan tidak ditemukan.");
}
$surat_jalan = $_GET['surat_jalan'];

// Query untuk mengambil detail penerimaan barang
$sql = "SELECT p.*, pembelian.kd_supp , employee.name_e
        FROM penerimaan_barang p
        JOIN employee ON employee.employee_number = p.penerima
        JOIN pembelian ON pembelian.kd_po = p.kd_po
        WHERE p.surat_jalan = '$surat_jalan'";

$result = mysqli_query($koneksi, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $penerimaan_barang = mysqli_fetch_assoc($result);
} else {
    die("Surat Jalan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Receiving Detail</title>
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Good Receiving Detail</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p><strong>Surat Jalan:</strong> <?php echo $penerimaan_barang['surat_jalan']; ?></p>
                    <p><strong>Tanggal Terima:</strong> <?php echo $penerimaan_barang['tgl_terima']; ?></p>
                    <p><strong>Penerima:</strong> <?php echo $penerimaan_barang['name_e']; ?></p>
                    <p><strong>Kode Supplier:</strong> <?php echo $penerimaan_barang['kd_supp']; ?></p>
                </div>

                <!-- Tabel untuk menampilkan detail barang -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Jumlah Barang Datang</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total_jumlah = 0;
                            $total_jumlah_datang = 0;

                            $sql_items = "SELECT penerimaan_barang.*, barang.nama AS nama_barang
                            FROM penerimaan_barang
                            INNER JOIN barang ON barang.kd_brg = penerimaan_barang.kd_brg
                            WHERE surat_jalan = '$surat_jalan'";
                            $result_items = mysqli_query($koneksi, $sql_items);
                            if (!$result_items) {
                                die("Query error: " . mysqli_error($koneksi));
                            }

                            while ($item = mysqli_fetch_assoc($result_items)) {
                                // Tambahkan jumlah ke total
                                $total_jumlah += $item['jumlah'];
                                $total_jumlah_datang += $item['jumlah_datang'];
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                    <td><?php echo ucwords(strtolower($item['nama_barang'])); ?></td>
                                    <td class="text-end" style="text-align: right;"><?php echo number_format($item['jumlah']); ?></td>
                                    <td class="text-end" style="text-align: right;"><?php echo number_format($item['jumlah_datang']); ?></td>
                                    <td>Pcs</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-center">Total</th>
                                <th class="text-end" style="text-align: right;"><?php echo number_format($total_jumlah); ?></th>
                                <th class="text-end" style="text-align: right;"><?php echo number_format($total_jumlah_datang); ?></th>
                                <th>Pcs</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

</html>