<?php

include "../../../../config/koneksi.php";
include "../../../../config/fungsi_rupiah.php";
include "../../../../config/library.php";
include "../../../../config/fungsi_indotgl.php";


session_start();

$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<link href='../../../../dist/style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<div class='wrapper'><a href=../../../../index.php><b>LOGIN</b></a></div></center>";
} else {

    $judulform = "Inventory Sales";

    $data = 'lap_baru';
    $rute = 'list_lap_baru';
    $aksi = 'aksi_list_lap_baru';

    $tabel = 'mutasi_stok';
    $f1 = 'tgl';
    $f2 = 'kd_cus';
    $f3 = 'kd_brg';
    $f4 = 'satuan';
    $f5 = 'qty_awal';
    $f6 = 'nilai_awal';
    $f7 = 'qty_beli';
    $f8 = 'nilai_beli';
    $f9 = 'qty_beli_retur';
    $f10 = 'nilai_beli_retur';
    $f11 = 'qt_tersedia';
    $f12 = 'nilai_tersedia';
    $f13 = 'harga_rata';
    $f14 = 'qt_jual';
    $f15 = 'nilai_jual';
    $f16 = 'hpp_jual';
    $f17 = 'qt_akhir';
    $f18 = 'nilai_akhir';
    $f19 = 'stok_opname';
    $f20 = 'nilai_opname';

    $j1 = 'Tanggal';
    $j2 = 'Kode Customer';
    $j3 = 'Kode Barang';
    $j4 = 'Satuan';
    $j5 = 'Qty Awal';
    $j6 = 'Nilai Awal';
    $j7 = 'Qty Beli';
    $j8 = 'Nilai Beli';
    $j9 = 'Qty Beli Retur';
    $j10 = 'Nilai Beli Retur';
    $j11 = 'Qty Tersedia';
    $j12 = 'Nilai Tersedia';
    $j13 = 'Harga Rata-Rata';
    $j14 = 'Qty Jual';
    $j15 = 'Nilai Jual';
    $j16 = 'HPP Jual';
    $j17 = 'Qty Akhir';
    $j18 = 'Nilai Akhir';
    $j19 = 'Stok Opname';
    $j20 = 'Nilai Opname';


    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];
    $filter = $_GET['filter'];
    $nilai = $_GET['nilai'];
    $tipe_laporan = $_GET['tipe_laporan'];
    $tipe_lokasi = $_GET['tipe_lokasi'];
    $tipe_lokasi_filter = "";

    if ($tipe_lokasi == 1) {
        $tipe_lokasi_filter =  "AND penjualan.b_paking = 1";
    } else if ($tipe_lokasi == 2) {
        $tipe_lokasi_filter =  "AND penjualan.b_paking > 1";
    }
    $keterangan_lokasi = "Semua";
    if ($tipe_lokasi == 1) {
        $keterangan_lokasi = "Retail";
    } else if ($tipe_lokasi == 2) {
        $keterangan_lokasi = "Grosir";
    }


    $barangsearch = $_GET['barangsearch'] ?? '';
    $barangsearch_array = array_filter(explode(',', $barangsearch)); // will be empty array if no selection

    if (in_array('__select_all__', $barangsearch_array) || empty($barangsearch_array)) {
        $barangsearch_filter = "";
    } else {
        $escaped_barangsearch = array_map(function ($barang) use ($koneksi) {
            return "'" . mysqli_real_escape_string($koneksi, $barang) . "'";
        }, $barangsearch_array);
        $barangsearch_in = implode(',', $escaped_barangsearch);

        $barangsearch_filter = "AND jualdetil.kd_brg IN ($barangsearch_in)";
    }

    // $tgl_terakhir=$tgl_akhir+interval 1 day;

    // echo '<br/><br/><br/>';

    // echo "<br/>".$tgl_awal;
    // echo "<br/>".$tgl_akhir;
    // echo "<br/>".$filter;
    // echo "<br/>".$nilai;

    if ($filter == 'outlet') {
        $kondisi = "AND kd_unit='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        $kondisi_join = '';
        $kondisi_group = '';
    } elseif ($filter == 'area') {
        $newnilai = sprintf("%02s", $nilai);
        $kondisi = "AND kd_cus='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        $kondisi_join = '';
        $kondisi_group = '';
        // $kondisi_group= ',regional';
    } elseif ($filter == 'unitkerja') {
        $kondisi = "AND kd_unit='$nilai'";
        $query = mysqli_query($koneksi, "SELECT * FROM unit_kerja WHERE kd_cus='$nilai' ");
        $q1 = mysqli_fetch_array($query);
        $judul_nilai = $q1['nama'];
        $kondisi_join = '';
        $kondisi_group = '';
    } else {
        $kondisi = "";
        $judul_nilai = '';
        $kondisi_join = '';
        $kondisi_group = '';
    }


    $judul = $judulform;
    $judul2 = "";
    $judul3 = 'Periode : ' . $tgl_awal . " / " . $tgl_akhir;

    // echo '<br> kondisi :'.$kondisi;
    // echo '<br> judul Nilai :'.$judul_nilai;
    // echo '<br> kondisi Join :'.$kondisi_join;


    include '../header_lap_mutasi.php';
?>

    <style type="text/css">
        div.dataTables_wrapper div.dataTables_length select {
            width: 50;
        }

        div.dt-buttons {
            padding-left: 20;
        }

        div.dt-container {
            width: 800px;
            margin: 0 auto;
        }

        .table thead th {
            vertical-align: middle;
        }

        th {
            text-align: center;

        }

        table.dataTable tfoot td {
            /*		padding: 10px 10px!important 6px 18px;*/
            padding-right: 1px !important;
            background-color: beige;
        }

        .bg1 {
            background-color: RGBA(100, 149, 237, .1);
        }

        .bg2 {
            background-color: RGBA(100, 149, 237, .2);
        }

        .bg3 {
            background-color: RGBA(100, 149, 237, .3);
        }

        .bg4 {
            background-color: RGBA(100, 149, 237, .4);
        }

        .bg5 {
            background-color: RGBA(100, 149, 237, .5);
        }

        /* CSS for loading spinner */
        #loading-bar {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .spinner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            /* border: 10px solid; */
        }

        .spinner {
            width: 100px;
            height: 100px;
            border: 16px solid #f3f3f3;
            border-top: 8px solid #f8f850;
            border-radius: 50%;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            margin-top: 5px;
            font-size: 1.5rem;
            /* Increased font size */
            font-family: Arial, sans-serif;
            color: #333;
            font-weight: bold;
            /* Added font weight */
        }

        .dot {
            font-size: 2rem;
            /* Match dot size to text */
            animation: blink 1.4s infinite both;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
            animation: blink 1.4s infinite both;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
            animation: blink 1.4s infinite both;
        }

        .dot:nth-child(4) {
            animation-delay: 0.4s;
            animation: blink 1.4s infinite both;
        }

        .dot:nth-child(5) {
            animation-delay: 0.4s;
            animation: blink 1.4s infinite both;
        }

        @keyframes blink {

            0%,
            20%,
            50%,
            80%,
            100% {
                opacity: 1;
            }

            40% {
                opacity: 0;
            }

            60% {
                opacity: 0;
            }
        }

        #example_inventory_sales_wrapper {
            width: 100%;
            overflow-x: auto;
        }

        #example_inventory_sales {
            min-width: 1800px;
            width: 100%;
            table-layout: fixed;
        }

        .wide-table th:first-child {
            width: 30%;
        }
    </style>
    <!-- <div id="loading-bar">
    <div class="spinner-container">
        <div class="spinner"></div>
    </div>
    <div class="loading-text">
        Proses<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
    </div>
</div> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <!-- <div class="container"> -->

    <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="list-gds">
                        <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">report</small>

                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../main.php?route=home">Beranda</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                        <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                    </ol>
                </div>

            </div>

            <br>
            <center>
                <h4><?php echo $judul; ?>
                    <!-- <h5><?php echo $judul2; ?></h5> -->
                    <?php echo $judul3; ?>
                    <?php echo $tipe_laporan . " (lokasi : " . $keterangan_lokasi . ")"; ?>
                </h4>
            </center>
        </div><!-- /.container-fluid -->
    </section>
    <!-- <div class="table-responsive"> -->
    <?php if ($tipe_laporan == 'summary') { ?>
        <div class="table-responsive">

            <table id="example_inventory_sales" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;" class="elevation-2">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Transaksi</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th class="bg1">Revenue</th>
                        <th class="bg1">COGS</th>
                        <th class="bg2">Profit</th>
                        <th class="bg3">Margin %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = mysqli_query($koneksi, "
                        SELECT 
                            penjualan.faktur as no_invoice,
                            barang.nama AS nama_barang,
                            barang.Satuan1 AS unit,
                            jualdetil.kd_brg AS kodebarang,
                            COUNT(*) AS jumlah_transaksi,
                            SUM(jualdetil.banyak * jualdetil.qty_satuan) AS quantity,
                            SUM(jualdetil.jumlah) AS total_cost,
                            SUM(mutasi_stok.harga_rata * jualdetil.banyak * jualdetil.qty_satuan) as COGS
                        FROM penjualan
                        JOIN jualdetil ON jualdetil.faktur = penjualan.faktur 
                        LEFT JOIN barang ON barang.kd_brg = jualdetil.kd_brg
                        LEFT JOIN mutasi_stok 
                            ON mutasi_stok.kd_brg = jualdetil.kd_brg
                            AND mutasi_stok.tgl = DATE(penjualan.tanggal)
                            AND mutasi_stok.kd_cus = IF(penjualan.b_paking = 1, 1316, 8001)
                        WHERE penjualan.tanggal >= '$tgl_awal' 
                            AND penjualan.tanggal <= DATE_ADD('$tgl_akhir', INTERVAL 1 DAY)
                            $barangsearch_filter 
                            $tipe_lokasi_filter
                        GROUP BY jualdetil.kd_brg
                        HAVING SUM(jualdetil.banyak * jualdetil.qty_satuan) > 0
                        ORDER BY jualdetil.kd_brg ASC
                        ");

                    if (!$sql1) {
                        die("Query gagal: " . mysqli_error($koneksi));
                    }
                    $totaltransaksi = 0;
                    $totaljumlahharga = 0;
                    $totaljumlahcogs = 0;
                    $totaljumlahprofit = 0;

                    while ($s1 = mysqli_fetch_array($sql1)) {
                        $totaltransaksi += $s1['jumlah_transaksi'];
                        $totaljumlahharga += $s1['total_cost'];
                        $totaljumlahcogs += $s1['COGS'];
                        $totaljumlahprofit += $s1['total_cost'] - $s1['COGS'];
                        $array_BarangData = [];
                        $array_BarangData[] = $s1['kodebarang'];
                        $array_new_barang_string = implode(',', $array_BarangData);
                    ?>
                        <tr align="left" style="background-color: #dee2e6;">
                            <td><?php echo $s1['kodebarang']; ?></td>
                            <td><?php echo $s1['nama_barang']; ?></td>
                            <td style="font-weight: bold;" class="force-string"><a href="../../route/lap_baru/inventory_sales_model.php?filter=semua&nilai=semua&tipe_laporan=detail&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&barangsearch=<?php echo $array_new_barang_string; ?>&tipe_lokasi=<?php echo $tipe_lokasi; ?>"><?php echo $s1['jumlah_transaksi']; ?></td>
                            <td align="right"><?php echo number_format($s1['quantity']); ?></td>
                            <td align="right"><?php echo $s1['unit']; ?></td>
                            <td class="bg1" align="right"><?php echo number_format($s1['total_cost']); ?></td>
                            <td class="bg1" align="right"><?php echo number_format($s1['COGS']); ?></td>
                            <td class="bg2" align="right"><?php echo number_format($s1['total_cost'] - $s1['COGS']); ?></td>
                            <td class="bg3" align="right"><?php echo number_format(($s1['total_cost'] - $s1['COGS']) / $s1['total_cost'] * 100); ?>%</td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr align="left" style="background-color: #e9ecef;">
                        <td></td>
                        <td></td>
                        <td><?php echo number_format($totaltransaksi); ?></td>
                        <td></td>
                        <td></td>
                        <td class="bg1" align="right"><?php echo number_format($totaljumlahharga); ?></td>
                        <td class="bg1" align="right"><?php echo number_format($totaljumlahcogs); ?></td>
                        <td class="bg2" align="right"><?php echo number_format($totaljumlahprofit); ?></td>
                        <td class="bg3" align="right"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <h1><?php echo $grandtotal; ?></h1> -->
        </div>
    <?php } else if ($tipe_laporan == 'detail') { ?>
        <div class="table-responsive">

            <table id="example_inventory_sales" class="table table-bordered table-striped">
                <thead style="background-color: lightgray;" class="elevation-2">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Faktur</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th class="bg1">Revenue</th>
                        <th class="bg1">COGS</th>
                        <th class="bg2">Profit</th>
                        <th class="bg3">Margin %</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = mysqli_query($koneksi, "SELECT 
                        COALESCE(m.nama, '-') AS customer,
                        penjualan.faktur AS no_invoice,
                        barang.nama AS nama_barang,
                        DATE(penjualan.tanggal) AS tanggal_invoice,
                        barang.Satuan1 AS unit,
                        jualdetil.kd_brg AS kodebarang,
                        (jualdetil.banyak * jualdetil.qty_satuan) AS quantity,
                        jualdetil.jumlah AS total_cost,
                        (mutasi_stok.harga_rata * jualdetil.banyak * jualdetil.qty_satuan) AS COGS
                    FROM penjualan
                    JOIN jualdetil ON jualdetil.faktur = penjualan.faktur 
                    LEFT JOIN barang ON barang.kd_brg = jualdetil.kd_brg
                    LEFT JOIN (
                            SELECT kd_member, nama
                            FROM member
                            GROUP BY kd_member  
                        ) m ON m.kd_member = penjualan.no_meja
                    LEFT JOIN mutasi_stok 
                        ON mutasi_stok.kd_brg = jualdetil.kd_brg
                        AND mutasi_stok.tgl = DATE(penjualan.tanggal)
                        AND mutasi_stok.kd_cus = IF(penjualan.b_paking = 1, 1316, 8001)
                    WHERE penjualan.tanggal >= '$tgl_awal' 
                        AND penjualan.tanggal <= DATE_ADD('$tgl_akhir', INTERVAL 1 DAY) AND (jualdetil.banyak * jualdetil.qty_satuan) > 0
                        $barangsearch_filter 
                        $tipe_lokasi_filter
                    ORDER BY jualdetil.kd_brg ASC
                    ");

                    if (!$sql1) {
                        die("Query gagal: " . mysqli_error($koneksi));
                    }
                    $suppliers_data = [];
                    while ($s1 = mysqli_fetch_array($sql1)) {
                        $supplier = $s1['kodebarang'];
                        if (!isset($suppliers_data[$supplier])) {
                            $suppliers_data[$supplier] = [];
                        }
                        $suppliers_data[$supplier][] = $s1;
                    }
                    $grandtotal = 0;

                    foreach ($suppliers_data as $supplier_name => $invoices) {
                        $totaljumlahharga = 0;
                        $totaljumlahcogs = 0;
                        $totaljumlahprofit = 0;
                    ?>
                        <tr align="left" style="background-color: #ced4da;">
                            <td><?php echo $invoices[0]['nama_barang']; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="bg1" align="right"></td>
                            <td class="bg1" align="right"></td>
                            <td class="bg2" align="right"></td>
                            <td class="bg3" align="right"></td>
                        </tr>
                        <?php

                        foreach ($invoices as $invoice) {
                            $totaljumlahharga += $invoice['total_cost'];
                            $grandtotal += $invoice['total_cost'];
                            $totaljumlahcogs += $invoice['COGS'];
                            $totaljumlahprofit += ($invoice['total_cost'] - $invoice['COGS']);
                            $link = "../../main.php?route=lap_pb1_detil_view&act&id={$invoice['no_invoice']}&asal=pb1";
                        ?>
                            <tr align="left" style="background-color: #dee2e6;">
                                <td class="hide-export" style="text-align: right; color: transparent;"><?php echo $invoice['nama_barang']; ?></td>
                                <td><?php echo $invoice['tanggal_invoice']; ?></td>
                                <td><?php echo $invoice['customer']; ?></td>
                                <td style="font-weight: bold;" class="force-string"><a href="<?php echo $link; ?>" title="Detail"><?php echo $invoice['no_invoice']; ?></a></td>
                                <td align="right"><?php echo number_format($invoice['quantity']); ?></td>
                                <td align="right"><?php echo $invoice['unit']; ?></td>
                                <td class="bg1" align="right"><?php echo number_format($invoice['total_cost']); ?></td>
                                <td class="bg1" align="right"><?php echo number_format($invoice['COGS']); ?></td>
                                <td class="bg2" align="right"><?php echo number_format($invoice['total_cost'] - $invoice['COGS']); ?></td>
                                <td class="bg3" align="right"><?php echo number_format(($invoice['total_cost'] - $invoice['COGS']) / $invoice['total_cost'] * 100); ?>%</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr align="left" style="background-color: #e9ecef;">
                            <td class="hide-export" style="text-align: right; color: transparent;"><?php echo $invoices[0]['nama_barang']; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="bg1" align="right"><?php echo number_format($totaljumlahharga); ?></td>
                            <td class="bg1" align="right"><?php echo number_format($totaljumlahcogs); ?></td>
                            <td class="bg2" align="right"><?php echo number_format($totaljumlahprofit); ?></td>
                            <td class="bg3" align="right"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- <h1><?php echo $grandtotal; ?></h1> -->
        </div>
    <?php } ?>


    <!-- </div> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <script>
        function navigateOpname(button) {
            var row = button.closest('tr');
            const te1s = '<?php echo $en; ?>';
            var tdValue = row.querySelector('td:nth-child(1)').textContent;
            var tdValue2 = row.querySelector('td:nth-child(2)').getAttribute('data-value');
            var tdValue3 = row.querySelector('td:nth-child(3)').textContent;

            const jumlahopname = prompt("Masukan Stock Terbaru");
            if (jumlahopname && jumlahopname.trim() !== '') {
                let jumlah = jumlahopname.replace(/\D/g, '');
                console.log(`tanggal :${tdValue}, Lokasi :${tdValue2}, Barang :${tdValue3}, jumlah :${jumlah}`);
                $.ajax({
                    type: 'GET',
                    url: 'ajax_opname_stock.php?tanggal=' + tdValue + '&lokasi=' + tdValue2 + '&barang=' + tdValue3 + '&jumlah=' + jumlah,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Success response received');
                        console.log('Response:', response);
                        if (response.error) {
                            console.log('Error:', response.error);
                        } else {
                            console.log('Success:', response.success);
                            console.log('Reloading the page');
                            location.reload(); // Page reload
                        }
                        // Log all parameters
                        // console.log('barang:', response.barang);
                        // console.log('lokasi:', response.lokasi);
                        // console.log('tanggal:', response.tanggal);
                        // console.log('jumlah:', response.jumlah);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }
        // $(document).ready(function() {
        //   $('#example_inventory_sales').DataTable({
        //     dom: 'Bfrtip',
        //     scrollX: true,
        //     buttons: [
        //       'copy', 'csv', 'excel', 'pdf', 'print'
        //     ]
        //   });
        // });
    </script>

    <script>
        $(document).ready(function() {
            // Menghilangkan loading bar setelah halaman siap
            $("#loading-bar").hide();

            $('#example_inventory_sales').DataTable({
                "lengthChange": true,
                paging: false,
                ordering: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    // If the cell has 'hide-export' class, return an empty string
                                    if ($(node).hasClass('hide-export')) {
                                        return ''; // Hide this cell in export
                                    }
                                    if ($(node).hasClass('force-string')) {
                                        return '\u200C' + $(node).text().trim(); // 👈 extract only visible text
                                    }
                                    return data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    return $(node).hasClass('hide-export') ? '' : data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    return $(node).hasClass('hide-export') ? '' : data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    return $(node).hasClass('hide-export') ? '' : data;
                                }
                            }
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    return $(node).hasClass('hide-export') ? '' : data;
                                }
                            }
                        }
                    }
                ]
            });


        });
    </script>

<?php include '../footer_lap_mutasi.php';
} ?>