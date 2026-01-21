<?php
include '../../../../config/koneksi.php';

session_start();

$employee = $_SESSION['employee_number'];


$judulform = "Pengiriman Barang";

$data = 'data_pengiriman_barang';
$rute = 'pengiriman_barang';
$aksi = 'aksi_pengiriman_barang';
$view = 'pengiriman_barang_view';
$view2 = 'permintaan_barang_view_detail';

$rute_detail = 'pengiriman_barang_detail';

$tabel = 'permintaan_barang';

// Variabel untuk nama kolom tabel permintaan_barang
$f1 = 'kode_permintaan';
$f2 = 'kd_cus_peminta';
$f3 = 'kd_cus_pengirim';
$f4 = 'tanggal_permintaan';
$f5 = 'status_permintaan';
$f6 = 'keterangan';

// Variabel untuk label kolom
$j1 = 'Kode Permintaan';
$j2 = 'Penerima';
$j3 = 'Pengirim';
$j4 = 'Tanggal Permintaan';
$j5 = 'Status Permintaan';
$j6 = 'Keterangan';

$tabel2 = "permintaan_barang_detail";

// Variabel untuk nama kolom tabel permintaan_barang_detail
$ff1 = 'id_detail';
$ff2 = 'kode_permintaan';
$ff3 = 'kd_cus_peminta';
$ff4 = 'kd_barang';
$ff5 = 'nama_barang';
$ff6 = 'qty_diajukan';
$ff7 = 'qty_terkirim';
$ff8 = 'qty_diterima';
$ff9 = 'qty_satuan';
$ff10 = 'satuan';
$ff11 = 'harga';
$ff12 = 'urut';
$ff13 = 'status_item';

// Variabel untuk label kolom
$jj1 = 'ID Detail';
$jj2 = 'Kode Permintaan';
$jj3 = 'Kode Customer Peminta';
$jj4 = 'Kode Barang';
$jj5 = 'Nama Barang';
$jj6 = 'Quantity Permintaan';
$jj7 = 'Quantity Terkirim';
$jj8 = 'Quantity Diterima';
$jj9 = 'Quantity Satuan';
$jj10 = 'Satuan';
$jj11 = 'Harga';
$jj12 = 'Urut';
$jj13 = 'Status Item';



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

if (isset($_GET['kode_permintaan'])) {
    $kode_permintaan = $_GET['kode_permintaan'];



    // Query untuk mendapatkan data pembelian berdasarkan kd_beli
    $sql = mysqli_query($koneksi, "SELECT pengiriman_barang_internal.*, pelanggan.nama as nama_pengirim
    FROM pengiriman_barang_internal
    Join $tabel ON $tabel.kode_permintaan = pengiriman_barang_internal.kode_permintaan 
    JOIN pelanggan  ON pelanggan.kd_cus = $tabel.kd_cus_pengirim
    WHERE pengiriman_barang_internal.kode_permintaan='$kode_permintaan'");

    $data = mysqli_fetch_array($sql);

    // Query untuk mendapatkan detail pembelian dari tabel kedua
    $sql2 = mysqli_query($koneksi, "SELECT *, pengiriman_barang_detail_internal.satuan as satuan, barang.nama FROM pengiriman_barang_detail_internal
    JOIN barang ON barang.kd_brg = pengiriman_barang_detail_internal.kd_barang
    JOIN pengiriman_barang_internal ON pengiriman_barang_internal.kode_pengiriman = pengiriman_barang_detail_internal.kode_pengiriman
    WHERE pengiriman_barang_internal.kode_permintaan='$kode_permintaan'");
    
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
    <h2>Detail Pengiriman Barang</h2>
    <p>Kode Permintaan: <strong><?php echo $data['kode_permintaan']; ?></strong></p>
    <p>Kode Pengirimgan: <strong><?php echo $data['kode_pengiriman']; ?></strong></p>
    <p>Kode Pengirim : <strong><?php echo $data['kd_cus_pengirim']; ?> - <?php echo $data['nama_pengirim']; ?> </strong></p>

    <h3>Detail Barang</h3>
    <table>
        <thead>
            <tr>
            <td align="center"> No</td>
			<td align="center">Tanggal Pengiriman</td>
			<td align="center">Kode Barang</td>	
			<td align="center">nama Barang</td>	
			<td align="right">Qty Kirim</td>
			<td align="center">Satuan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $subtotal = 0;
            while ($item = mysqli_fetch_array($sql2)) {
                $qty_dikirim = $item['qty_dikirim'];
              

                $subtotal += $qty_dikirim;
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $item['tanggal_pengiriman']; ?></td>
                    <td><?php echo $item['kd_brg']; ?></td>
                    <td><?php echo $item['nama']; ?></td>
                    <td><?php echo $item['qty_dikirim']; ?></td>
                    <td><?php echo $item['satuan']; ?></td>
            
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Subtotal:</strong></td>
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
                document.location.replace(`../../main.php?route=pengiriman_barang&act&ide=${employee}`);
            }, lama);
        }
    </script>
</body>

</html>


</html>