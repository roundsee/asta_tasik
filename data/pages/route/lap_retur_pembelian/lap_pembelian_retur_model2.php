<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];

$judulform = 'Retur Pembelian Detail';
$data = 'data_pembelian_retur';
$aksi = 'aksi_pembelian_retur';
$rute = 'pembelian_retur';
$rute_detail = 'pembelian_retur_detail';
$view = 'pembelian_retur_view';


$tabel = 'retur_pembelian';
$f1 = 'tanggal_retur';
$f2 = 'kd_retur';
$f3 = 'faktur';
$f4 = 'kd_brg';
$f5 = 'harga';
$f6 = 'banyak';
$f7 = 'satuan';
$f8 = 'subtotal';
$f9 = 'total_retur';
$f10 = 'login_hash';


$j1 = 'Tanggal Retur';
$j2 = 'Kode Retur';
$j3 = 'Faktur';
$j4 = 'Kode Barang';
$j5 = 'Harga';
$j6 = 'Banyak';
$j7 = 'satuan';
$j8 = 'subtotal';
$j9 = 'Total Retur';
$j10 = 'Login Hash';



$judul = $judulform;

?>

<?php
$dir = "../../";
include $dir . "config/library.php";
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $judul; ?> | <?php echo $judul2; ?> | <?php echo $judul3; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../../../images/favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo $dir; ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $dir; ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- tambahan DatePicker -->
    <link rel="stylesheet" href="<?php echo $dir; ?>dist/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
    <!-- Style tambahan -->
    <!-- <link rel="stylesheet" href="<?php echo $dir; ?>dist/style.css"> -->

    <!-- Tambahkan jqueryUI disini -->
    <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo $dir; ?>jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo $dir; ?>jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!--animate-->
    <!--   <link href="<?php echo $dir; ?>dist/css/animate.css" rel="stylesheet" type="text/css" media="all">
  <script src="<?php echo $dir; ?>dist/js/wow.min.js"></script>
  <script>
   new WOW().init();
 </script> -->
    <!--//end-animate-->
</head>

<body class="skin-green layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed text-sm" style="height: auto;">

    <!-- ----- Wrapper----- -->
    <div class="wrapper">

        <!-- Navbar -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: ghostwhite;">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Main row -->
                            <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-12 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="box" style="background-color: #eee">

                                        <div class="box-body" style="margin-top: -20px">

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

                                                        </h4>
                                                    </center>
                                                </div><!-- /.container-fluid -->
                                            </section>
                                            <table id="example4" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                <thead style="background-color: #ddd;">
                                                    <tr style="font-weight: 600">
                                                        <th align="center" width="40px">No</th>
                                                        <th>Nomor Retur</th>
                                                        <th>Tanggal Retur</th>
                                                        <th>Pengembalian Oleh</th>
                                                        <th>Gudang</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th align="left">Qty Retur</th>
                                                        <th align="left">Satuan</th>
                                                        <th align="left">Total Qty Retur</th>
                                                        <th align="left" width="140px">Harga</th>
                                                        <th align="right" width="100px">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $current_supplier = 0;
                                                    $total_keseluruhan = 0;

                                                    $sql1 = mysqli_query($koneksi, "SELECT rp.satuan,rp.isi * rp.banyak as subtotal,rp.tanggal_retur,rp.nota_retur as kd_retur,rp.kd_brg,rp.user_input as login_hash,b.nama AS nama_barang,p.nama AS nama_gudang,rp.total_retur,rp.harga,rp.banyak
            FROM retur_pembelian rp 
            LEFT JOIN barang b ON rp.kd_brg=b.kd_brg
            LEFT JOIN pelanggan p ON rp.kd_cus=p.kd_cus
            ORDER BY rp.tanggal_retur,rp.nota_retur ASC  
           
        ");

                                                    if (!$sql1) {
                                                        die("Query error: " . mysqli_error($koneksi));
                                                    }

                                                    while ($s1 = mysqli_fetch_array($sql1)) {
                                                        $total_keseluruhan += $s1['total_retur'] * $s1['harga'];
                                                        // Jika supplier berubah, cetak subtotal supplier sebelumnya (jika ada)

                                                    ?>
                                                        <tr>
                                                            <td align="right"><?php echo $no; ?></td>
                                                            <td style="font-weight: bold;"><a href="main.php?route=pembelian_retur_view&act&id=<?php echo $s1['kd_retur']; ?>&asal=pembelian_retur" title="Detail"><?php echo $s1['kd_retur']; ?></td>
                                                            <td align="left"><?php echo $s1['tanggal_retur']; ?></td>
                                                            <td align="left"><?php echo $s1['login_hash']; ?></td>
                                                            <td align="left"><?php echo $s1['nama_gudang']; ?></td>
                                                            <!-- <td align="left"><?php echo $s1['kd_po']; ?></td> -->
                                                            <td align="left"><?php echo $s1['kd_brg']; ?></td>
                                                            <td align="left"><?php echo $s1['nama_barang']; ?></td>
                                                            <td align="right"><?php echo $s1['banyak']; ?></td>
                                                            <!-- <td align="right"><?php echo  number_format($s1['jumlah_barang_datang'] * $s1['jml_pcs'], 0, ',', '.'); ?></td> -->

                                                            <!-- <td align="right"><?php echo $s1['jumlah_barang_datang']; ?></td> -->
                                                            <td align="left"><?php echo $s1['satuan']; ?></td>
                                                            <td align="right"><?php echo $s1['subtotal']; ?></td>
                                                            <!-- <td align="right"><?php echo $s1['jml_pcs']; ?></td> -->
                                                            <td align="right"><?php echo number_format($s1['harga']); ?></td>
                                                            <td align="right"><?php echo  number_format($s1['total_retur'], 0, ',', '.'); ?></td>

                                                            <!-- <td align="right"><?php echo number_format($s1['tot_disc']); ?></td> -->
                                                            <!-- <td align="right"><?php echo number_format($nilai_pjk); ?></td> -->
                                                            <!-- <td align="right"><?php echo number_format($subtotal); ?></td> -->
                                                        </tr>
                                                    <?php
                                                        $no++;
                                                    }

                                                    // Tampilkan subtotal terakhir setelah loop
                                                    if ($current_supplier != "") {
                                                    ?>
                                                        <!-- <tr>
                                                            <td colspan="9" align="right">Subtotal</td>
                                                            <td align="right"><?php echo number_format($subtotal_supplier); ?></td>
                                                        </tr> -->
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr style="font-weight: 600">
                                                        <td colspan="11" align="right">Total Keseluruhan</td>
                                                        <td align="right"><?php echo number_format($total_keseluruhan); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                                            <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                                            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

                                            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#example').DataTable({
                                                        dom: 'Bfrtip',
                                                        scrollX: true,
                                                        buttons: [
                                                            'copy', 'csv', 'excel', 'pdf', 'print'
                                                        ]
                                                    });
                                                });
                                            </script>
                                            <script>

                                            </script>

                                            <script>
                                                $(document).ready(function() {
                                                    // Menghilangkan loading bar setelah halaman siap
                                                    $("#loading-bar").hide();


                                                });
                                            </script>

                                            <?php
                                            $dir = "../../";
                                            ?>
                                            <!-- Main Footer -->
                                            <footer class="main-footer bg_primary_1" style="padding:.3rem;font-size:.75rem">
                                                <!-- To the right -->
                                                <div class="float-right d-none d-sm-inline">
                                                    <b>Version</b> <?php echo $ver; ?>
                                                </div>
                                                <!-- Default to the left -->
                                                <strong>Copyright &copy; 2020-<?php echo $thn_sekarang . " " . $perusahaan; ?>.</strong> by Develop. All rights Reserved.
                                            </footer>
                                        </div>


                                        <!-- jQuery -->
                                        <script src="../../../../plugins/jquery/jquery.min.js"></script>
                                        <!-- Bootstrap 4 -->
                                        <!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                                        <!-- DataTables  & Plugins -->
                                        <!-- <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

                                        <!-- Bootstrap 4 -->
                                        <!-- <script src="<?php echo $dir; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                                        <!-- DataTables  & Plugins -->
                                        <script src="<?php echo $dir; ?>plugins/datatables/jquery.dataTables.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/jszip/jszip.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/pdfmake/pdfmake.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/pdfmake/vfs_fonts.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
                                        <script src="<?php echo $dir; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


                                        <!-- AdminLTE App -->
                                        <script src="../../../../dist/js/adminlte.min.js"></script>
                                        <!-- AdminLTE for demo purposes -->
                                        <script src="../../../../dist/js/demo.js"></script>
                                        <!-- Page specific script -->


                                        <script>
                                            $(document).ready(function() {
                                                $('#example').DataTable({
                                                    "lengthChange": true,
                                                    dom: 'Bfrtip',
                                                    buttons: [
                                                        'copy', 'csv', 'excel', 'pdf', 'print'
                                                    ]
                                                });
                                            });

                                            $('#example4').DataTable({
                                                dom: 'Bfrtip',
                                                buttons: [{
                                                        extend: 'excelHtml5',
                                                        text: 'Export to Excel',
                                                        customize: function(xlsx) {
                                                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                            $('row c', sheet).each(function() {
                                                                var cellValue = $(this).text();
                                                                // Set all values to string
                                                                $(this).attr('t', 'inlineStr'); // Set the cell type to inline string
                                                                $(this).find('v').replaceWith('<is><t>' + cellValue + '</t></is>'); // Properly wrap the value
                                                            });
                                                        }
                                                    },
                                                    'copy', 'csv', 'pdf', 'print'
                                                ]
                                            });



                                            $(function() {
                                                $("#example1").DataTable({
                                                    lengthMenu: [
                                                        [10, 50, 100, -1],
                                                        [10, 50, 100, 'All'],
                                                    ],
                                                    "responsive": true,
                                                    "lengthChange": true,
                                                    "autoWidth": true,
                                                    "searching": true,
                                                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                                                $('#example2').DataTable({
                                                    "paging": true,
                                                    "lengthChange": false,
                                                    "searching": false,
                                                    "ordering": true,
                                                    "info": true,
                                                    "autoWidth": false,
                                                    "responsive": true,
                                                });

                                                $("#example3").DataTable({
                                                    lengthMenu: [
                                                        [100, 500, 1000, -1],
                                                        [100, 500, 1000, 'All'],
                                                    ],
                                                    "responsive": true,
                                                    "lengthChange": true,
                                                    "autoWidth": true,
                                                    "searching": true,
                                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                                            });
                                        </script>
</body>

</html>


<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html> -->