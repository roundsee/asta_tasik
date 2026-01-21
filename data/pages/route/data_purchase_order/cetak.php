<?php
include '../../../../config/koneksi.php';

session_start();

$employee = $_SESSION['employee_number'];

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
$jj3 = 'Banyak';
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
    $update_status = mysqli_query($koneksi, "UPDATE $tabel SET status_pembelian = 3 WHERE kd_beli = '$kd_beli'");

    // if ($update_status) {
    //     echo "<script>window.print();</script>";
    // } else {
    //     echo "<script>alert('Gagal mengupdate status pembelian');</script>";
    // }

    // Query untuk mendapatkan data pembelian berdasarkan kd_beli
    $sql = mysqli_query($koneksi, "SELECT $tabel.kd_po,$tabel.tgl_rilis,$tabel.kd_supp,$tabel.ppn,
    supplier.nama as nama_supplier FROM $tabel Join supplier ON supplier.kd_supp = $tabel.kd_supp WHERE kd_beli='$kd_beli'");
    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail pembelian dari tabel kedua
    $sql2 = mysqli_query($koneksi, "SELECT $tabel2.satuan as satuan, barang.nama, 
    $tabel2.jml,$tabel2.price,$tabel2.disc
    FROM $tabel2 
    JOIN barang ON barang.kd_brg = $tabel2.kd_brg
    WHERE kd_beli='$kd_beli'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pembelian</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }

        p strong {
            font-weight: 500;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2980b9;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        tr:last-child td {
            border-top: 2px solid #2980b9;
        }

        td strong {
            font-size: 16px;
            color: #2c3e50;
        }

        /* Total styling */
        td.total {
            font-weight: bold;
            font-size: 18px;
            color: #e74c3c;
        }

        @media print {
            body {
                font-size: 12px;
                color: #000;
            }

            h2 {
                color: #000;
            }

            th,
            td {
                font-size: 12px;
            }

            tr:last-child td {
                border-top: 2px solid #000;
            }
        }
    </style>
</head>

<body onload="printOut()">
    <h2>Detail Purchase Order</h2>
    <p>Kode PO: <strong><?php echo $data['kd_po']; ?></strong></p>
    <p>Tanggal: <strong><?php echo $data['tgl_rilis']; ?></strong></p>
    <p>Kode Supplier: <strong><?php echo $data[$f3]; ?></strong></p>
    <p>Nama Supplier: <strong><?php echo $data['nama_supplier']; ?></strong></p>

    <h3>Detail Barang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Banyak</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>SubTotal</th>
                <th>Diskon</th>
                <th>PPN</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $subtotal = 0;
            while ($item = mysqli_fetch_array($sql2)) {
                $jumlahBarang = $item['jml'];
                $total_harga = $jumlahBarang * $item['price'];
                $total = $total_harga - $item['disc'];

                if ($data[$f7] == 1) {
                    $nilai_pajak = $total * $data['tarif_ppn'] / 100;
                } else {
                    $nilai_pajak = 0;
                }

                $satuan = $item['satuan'];

                $finalTotal = $total + $nilai_pajak;

                $subtotal += $finalTotal;
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $item['nama']; ?></td>
                    <td><?php echo $jumlahBarang; ?></td>
                    <td><?php echo $satuan ?></td>
                    <td><?php echo number_format($item['price']); ?></td>
                    <td><?php echo number_format($total_harga); ?></td>
                    <td><?php echo number_format($item['disc']); ?></td>
                    <td><?php echo number_format($nilai_pajak); ?></td>
                    <td><?php echo number_format($finalTotal); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="8" style="text-align:right;"><strong>Subtotal:</strong></td>
                <td class="total"><?php echo number_format($subtotal); ?></td>
            </tr>
        </tbody>
    </table>

    <script>
        var employee = "<?php echo $employee; ?>";
        var lama = 3000;
        var t = null;

        function printOut() {
            window.print();
            t = setTimeout(function() {
                document.location.replace(`../../main.php?route=purchase_order&act&ide=${employee}`);
            }, lama);
        }
    </script>
</body>

</html>


</html>