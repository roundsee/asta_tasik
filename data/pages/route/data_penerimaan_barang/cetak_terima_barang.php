<?php
include '../../../../config/koneksi.php';

// Aktivasi error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['surat_jalan'])) {
    $surat_jalan = $_GET['surat_jalan'];

    // Query untuk mendapatkan data penerimaan barang berdasarkan surat jalan
    $sql = mysqli_query($koneksi, "
        SELECT supplier.nama as nama_supplier,penerimaan_barang.surat_jalan,penerimaan_barang.tgl_terima
        FROM penerimaan_barang 
        JOIN pembelian ON pembelian.kd_po = penerimaan_barang.kd_po
        JOIN supplier ON supplier.kd_supp = pembelian.kd_supp
        WHERE penerimaan_barang.surat_jalan = '$surat_jalan'
    ");

    // Ambil satu baris data untuk digunakan dalam detail pembelian
    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail barang
    $sql2 = mysqli_query($koneksi, "
        SELECT jumlah_datang,jumlah,nama, penerimaan_barang.satuan
        FROM penerimaan_barang 
        JOIN barang ON barang.kd_brg = penerimaan_barang.kd_brg 
        WHERE penerimaan_barang.surat_jalan = '$surat_jalan'
    ");
} else {
    die('Surat jalan tidak ditemukan.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Terima Barang</title>
    <style>
        /* Global Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 24px;
            letter-spacing: 2px;
        }

        h3 {
            color: #343a40;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        p strong {
            color: #333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        td {
            text-align: right;
        }

        td:first-child,
        th:first-child {
            text-align: left;
        }

        .total-row {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .total-row td {
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #868e96;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }

        @media print {
            .container {
                box-shadow: none;
            }

            h2 {
                color: #000;
            }

            th {
                background-color: #000;
                color: #fff;
            }

            .total-row {
                background-color: #000;
                color: #fff;
            }
        }
    </style>
</head>

<body onload="printOut()">
    <div class="container">
        <h2>Detail Penerimaan Barang</h2>

        <p>Surat Jalan: <strong><?php echo $data['surat_jalan'] ?? '-'; ?></strong></p>
        <p>Tanggal Terima Barang: <strong><?php echo $data['tgl_terima'] ?? '-'; ?></strong></p>
        <p>Nama Supplier: <strong><?php echo $data['nama_supplier'] ?? '-'; ?></strong></p>

        <h3>Detail Barang</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty Sesuai PO</th>
                    <th>Qty Datang</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $subtotal = 0;
                $subtotalpo = 0;
                while ($item = mysqli_fetch_array($sql2)) {
                    $subtotal += $item['jumlah_datang'];
                    $subtotalpo += $item['jumlah'];

                    $row_style = ($item['jumlah'] == 0) ? 'background-color: #ADD8E6;' : ''; // Warna biru muda

                ?>
                    <tr style="<?php echo $row_style; ?>">
                        <td><?php echo $no++; ?></td>
                        <td style="text-align: left;"><?php echo $item['nama']; ?></td>
                        <td class="text-center"><?php echo number_format($item['jumlah'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?php echo number_format($item['jumlah_datang'], 0, ',', '.'); ?></td>
                        <td><?php echo $item['satuan'] ?></td>

                    </tr>
                <?php } ?>
                <tr class="total-row">
                    <td colspan="2" style="text-align: right;">Subtotal:</td>
                    <td><?php echo number_format($subtotalpo); ?></td>
                    <td><?php echo number_format($subtotal); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Dicetak pada: <?php echo date('d-m-Y'); ?></p>
        </div>
    </div>

    <script>
        var lama = 3000;
        t = null;

        function printOut() {
            window.print();
            t = setTimeout("self.close()", lama);
        }
    </script>

</body>

</html>