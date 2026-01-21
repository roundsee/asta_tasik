<?php
include '../../../../config/koneksi.php';

$judulform = "Purchase Order";

$data = 'data_purchase_order';
$rute = 'purchase_order';
$aksi = 'aksi_purchase_order';

// $rute_detail = 'beli_detail';

$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';


$j1 = 'Kode Pembelian';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';


$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Discount';
$jj8 = 'urut';


$pengaju = 'pengaju';

$p1 = 'brand';
$p2 = 'direktur';
$p3 = 'direktorat';
$p4 = 'manager';
$p5 = 'unitkerja';
$p6 = 'kode_pengaju';
$p7 = 'no_rek';
$p8 = 'employee_no';
$p9 = 'nama';
$p10 = 'nama_unit';

$rek_tujuan = 'rek_tujuan';
$r1 = 'no_rek';
$r2 = 'nama_bank';
$r3 = 'atas_nama';
$r4 = 'cat1';

$jr1 = 'No Rekening';
$jr2 = 'Nama Bank';
$jr3 = 'Atas Nama';
$jr4 = 'Cat 1';


// Aktivasi error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['kd_beli'])) {
    $kd_beli = $_GET['kd_beli'];

    // Update status_pembelian menjadi 3
    // $update_status = mysqli_query($koneksi, "UPDATE $tabel SET status_pembelian = 3 WHERE kd_beli = '$kd_beli'");

    // if ($update_status) {
    //     echo "<script>window.print();</script>";
    // } else {
    //     echo "<script>alert('Gagal mengupdate status pembelian');</script>";
    // }

    // Query untuk mendapatkan data pembelian berdasarkan kd_beli
    $sql = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE kd_beli='$kd_beli'");
    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail pembelian dari tabel kedua
    $sql2 = mysqli_query($koneksi, "SELECT *, $tabel2.satuan as satuan, barang.nama FROM $tabel2 
    JOIN barang ON barang.kd_brg = $tabel2.kd_brg
    WHERE kd_beli='$kd_beli' ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pembelian</title>
    <style>
        /* Tambahkan CSS untuk format cetak */
        @media print {
            body {
                font-family: 'Roboto', sans-serif;
                margin: 20px;
                color: #333;
                background-color: #f5f5f5;
            }

            h2,
            h3 {
                color: #2c3e50;
                text-align: center;
                margin-bottom: 20px;
            }

            p {
                margin: 0 0 10px 0;
                font-size: 14px;
                color: #555;
            }

            .header {
                text-align: center;
                padding: 10px;
                border-bottom: 2px solid #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: left;
                font-size: 14px;
                color: #333;
            }

            th {
                background-color: #3498db;
                color: white;
                text-transform: uppercase;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            tr:last-child td {
                border-top: 2px solid #333;
            }

            td strong {
                font-size: 16px;
            }

            /* Footer */
            .footer {
                margin-top: 20px;
                text-align: center;
                font-size: 12px;
                color: #777;
                border-top: 1px solid #ddd;
                padding-top: 10px;
            }
        }
    </style>
</head>

<body onload="printOut();">
    <div class="header">
        <h2>Detail Barang Yang Akan diterima</h2>
        <p>Kode Pembelian: <strong><?php echo $data['kd_beli']; ?></strong></p>
        <p>Tanggal PO: <strong><?php echo $data[$f2]; ?></strong></p>
        <p>Kode Supplier: <strong><?php echo $data[$f3]; ?></strong></p>
    </div>

    <h3>Detail Barang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $subtotal = 0;
            while ($item = mysqli_fetch_array($sql2)) {
                $jumlahBarang = $item['jml'] ;
                $total = $item['jml'] * $item['price'];
                $subtotal += $jumlahBarang;
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $item['nama']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($jumlahBarang, 0 , ',' , '.'); ?></td>
                    <td><?php echo $item['satuan']?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2" style="text-align:right;"><strong>Total:</strong></td>
                <td style="text-align: right;"><strong><?php echo number_format($subtotal); ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?php echo date('d-m-Y'); ?></p>
    </div>

    <script>
        var lama = 3000;
        t= null;
        function printOut(){
            window.print();
            t= setTimeout("self.close()", lama)
        }
    </script>
</body>

</html>
