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

    $judulform = "Pending Purchase Orders By Item";

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
    $filter = $_GET['filter'];
    $nilai = $_GET['nilai'];

    $supplier_string = $_GET['supplier'] ?? '';
    $supplier_array = array_filter(explode(',', $supplier_string)); // will be empty array if no selection

    if (in_array('__select_all__', $supplier_array) || empty($supplier_array)) {
        $supplier_filter = "";
    } else {

        // Sanitize supplier codes
        $escaped_supplier = array_map(function ($supp) use ($koneksi) {
            return "'" . mysqli_real_escape_string($koneksi, $supp) . "'";
        }, $supplier_array);

        // Create IN clause
        $supplier_in = implode(',', $escaped_supplier);

        $supplier_filter = "AND pembelian_detail.kd_brg IN ($supplier_in)";
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
    $judul3 = 'Periode : ' . $tgl_awal;

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

        #example_vendor_pending_items_wrapper {
            width: 100%;
            overflow-x: auto;
        }

        #example_vendor_pending_items {
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
                </h4>
            </center>
        </div><!-- /.container-fluid -->
    </section>
    <!-- <div class="table-responsive"> -->
    <div class="table-responsive">

        <table id="example_vendor_pending_items" class="table table-bordered table-striped">
            <thead style="background-color: lightgray;" class="elevation-2">
                <tr>
                    <th>Name</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kode PO</th>
                    <th>Tanggal PO</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th class="bg1">Total Tagihan Sesuai PO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql1 = mysqli_query($koneksi, "SELECT 
                    pembelian.tgl_po,
                    pembelian.tgl_rilis,
                    supplier.nama as nama_supplier,
                    ((pembelian_detail.jml * pembelian_detail.price) - pembelian_detail.disc) + 
                    IF(pembelian.ppn = 1,
                        ((pembelian_detail.jml * pembelian_detail.price) - pembelian_detail.disc) * pembelian.tarif_ppn / 100,
                        0
                    ) AS total,
                    pembelian.kd_beli,
                    pembelian_detail.satuan,
                    pembelian_detail.jml,pembelian_detail.kd_brg,barang.nama as nama_barang,
                    pembelian.kd_po
                    from pembelian
                    JOIN pembelian_detail ON pembelian_detail.kd_beli = pembelian.kd_beli
                    LEFT JOIN supplier on supplier.kd_supp = pembelian.kd_supp 
                    LEFT JOIN barang on barang.kd_brg = pembelian_detail.kd_brg
                    WHERE status_pembelian >= 1 AND status_pembelian <=3 $supplier_filter
                    GROUP BY kd_beli
                 ");

                if (!$sql1) {
                    die("Query gagal: " . mysqli_error($koneksi));
                }
                $suppliers_data = [];
                while ($s1 = mysqli_fetch_array($sql1)) {
                    $supplier = $s1['nama_supplier'];
                    if (!isset($suppliers_data[$supplier])) {
                        $suppliers_data[$supplier] = [];
                    }
                    $suppliers_data[$supplier][] = $s1;
                }
                $grandtotal = 0;

                foreach ($suppliers_data as $supplier_name => $invoices) {
                    $totaljumlahharga = 0;
                ?>
                    <tr align="left" style="background-color: #ced4da;">
                        <td><?php echo $supplier_name; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bg1" align="right"></td>
                    </tr>
                    <?php


                    foreach ($invoices as $invoice) {
                        $totaljumlahharga += $invoice['total'];
                        $grandtotal += $invoice['total'];
                    ?>
                        <tr align="left" style="background-color: #dee2e6;">
                            <td class="hide-export" style="text-align: right; color: transparent;"><?php echo $invoice['nama_supplier']; ?></td>
                            <td><?php echo $invoice['kd_brg']; ?></td>
                            <td><?php echo $invoice['nama_barang']; ?></td>
                            <td style="font-weight: bold;" class="force-string">
                                <a href="../../main.php?route=po_view&act&id=<?php echo $invoice['kd_beli']; ?>&asal=purchase_order&temp=purchase_order" title="Detail"><?php echo $invoice['kd_po']; ?>
                            </td>
                            <td><?php echo $invoice['tgl_po']; ?></td>
                            <td><?php echo $invoice['jml']; ?></td>
                            <td><?php echo $invoice['satuan']; ?></td>
                            <td class="bg1" align="right"><?php echo number_format($invoice['total']); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr align="left" style="background-color: #e9ecef;">
                        <td class="hide-export" style="text-align: right; color: transparent;"><?php echo $supplier_name; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bg1" align="right"><?php echo number_format($totaljumlahharga); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- <h1><?php echo $grandtotal; ?></h1> -->
    </div>



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
        //   $('#example_vendor_pending_items').DataTable({
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

            $('#example_vendor_pending_items').DataTable({
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