<?php
$login_hash = $_SESSION['login_hash'];
$en = $_SESSION['employee_number'];
$to = $_SESSION['to'];
$area_e = $_SESSION['area_e'];
$area_nama = $_SESSION['area_nama'];

$judulform = "Generate QTY To Order ";

$data = 'data_generate_stok';
$rute = 'generate_stok';
$aksi = 'aksi_generate_stok';

$tabel = 'transaksi';
$f1 = 'reff';
$f2 = 'tanggal';
$f3 = 'kode_pasien';
$f4 = 'kode_asuransi';
$f5 = 'no_invoice';
$f6 = 'tanggal_invoice';
$f7 = 'status_Print';

$j1 = 'Reff';
$j2 = 'Tanggal';
$j3 = 'Kode Pasien';
$j4 = 'Kode Asuransi';
$j5 = 'No Invoice';
$j6 = 'Tanggal Invoice';
$j7 = 'Status Print';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
            //Tampil Data 
        default:
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
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
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Laporan</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <!-- <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s" > -->
                <section class="content wow ">
                    <div class="card card-default">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Main row -->
                            <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-12 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="box">
                                        <div class="box-body">

                                            <!-- Wrapper 1 -->
                                            <div class="wrapper" style="min-height:30%">
                                                <form role="form" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=report" method="post">
                                                    <div class="row">
                                                        <!-- Batas -------------- -->

                                                        <div class="col-lg-2">

                                                            <div class="form-group">
                                                                <label>Tanggal Awal</label>
                                                                <input type="date" class="form-control" name="tgl_awal" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Awal .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Tanggal Akhir</label>
                                                                <input type="date" class="form-control" name="tgl_akhir" onclick="displayHasil(this.value)" placeholder="Masukkan Tanggal Akhir .. (Wajib)" value="<?php echo date('Y-m-d') ?>" required="required">
                                                            </div>
                                                        </div>

                                                        <!-- Filter -->


                                                        <!-- Filter -->
                                                        <div class="col-lg-2">
                                                            <!--  <div class="col-lg-12"> -->
                                                            <div class="form-group">
                                                                <label>Filter
                                                                </label>

                                                                <div>
                                                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="semua"> Rata Rata Jual
                                                                </div>
                                                                <div>
                                                                    <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Asuransi"> Qty Jual tertinggi
                                                                </div>
                                                                <!-- <div>
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Data Siap Print
                                                                        </div> -->

                                                                <!-- <div>
                                                                        <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Outlet
                                                                    </div> -->


                                                                <div class="form-group">
                                                                    <!-- <label>Cakupan terpilih : </label> -->
                                                                    <input type="hidden" id="result" readonly style="width:100;font-size:120%;font-weight:600">
                                                                </div>

                                                            </div>
                                                            <!-- </div> -->
                                                        </div>
                                                        <!-- Filter -->


                                                        <!-- Filter Isian-------------- -->

                                                        <div class="col-lg-3">
                                                            <div class="row">

                                                                <div id="isian0" style="display: none;">
                                                                    <div class="row" style="height:133px">
                                                                        <div class="col-lg-7">
                                                                            <div class="form-group">
                                                                                <form method="post" action="simpan_index.php?act=proses2">
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <!-- Show Utk Kota -->
                                                                <div id="isian1" style="display: none;">
                                                                    <div class="row">
                                                                        <div class="col-lg-10">
                                                                            <div class="form-group">
                                                                                <form method="post" action="simpan_index.php">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">

                                                                                            <label>Kode Asuransi</label>
                                                                                            <input type="text" class="form-control" required="required" id="tampil_asuransi_kode" placeholder="Isi Kode Asuransi">
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariAsuransi">
                                                                                                <i class="fa fa-search"></i> Cari Asuransi
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <label>Asuransi<span id="status_asuransi"></span></label>
                                                                                    <input type="text" class="form-control" name="asuransi" value="" required="required" placeholder="Nama Asuransi .." id="tampil_asuransi_nama" readonly>

                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-5">
                                                                            <div class="form-group">

                                                                                <!-- Modal KOTA-->
                                                                                <div class="modal fade" id="cariAsuransi" tabindex="-1" role="dialog" aria-labelledby="cariAsuransiLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                DATA ASURANSI
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;&nbsp; Close</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">

                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-bordered table-striped table-hover" id="table-datatable-kota">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th class="text-center">NO</th>
                                                                                                                <th>KODE</th>
                                                                                                                <th>ASURANSI/PERUSAHAAN</th>
                                                                                                                <th></th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php
                                                                                                            $no = 1;
                                                                                                            $data = mysqli_query($koneksi, "SELECT kd_perusahaan,nama_perusahaan
                                                                                                                                            FROM perusahaan WHERE kd_perusahaan !='P000'                                                                                                                
                                                                                                                                            ORDER BY kd_perusahaan ASC;
                                                                                                                                            ");
                                                                                                            while ($d = mysqli_fetch_array($data)) {
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                                                                                    <td width="1%" class="text-center"><?php echo $d['kd_perusahaan']; ?></td>
                                                                                                                    <td width="3%"><?php echo $d['nama_perusahaan']; ?></td>
                                                                                                                    <td width="1%">
                                                                                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-asuransi" id="<?php echo $d['kd_perusahaan']; ?>" kode="<?php echo $d['kd_perusahaan']; ?>" nama="<?php echo $d['nama_perusahaan']; ?>" data-dismiss="modal">Pilih</button>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal KOTA End-->

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Show Utk Kota End-->
                                                            </div>

                                                        </div>

                                                        <!-- Filter Isian -->



                                                        <!-- Generate -->
                                                        <div class="col-lg-3">

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <input type="hidden" name="asuransi" id="tampil_asuransi_id">
                                                                    <input type="hidden" name="outlet" id="tampil_outlet_id">
                                                                    <input type="hidden" name="area" id="tampil_area_id">
                                                                    <input type="hidden" name="login_hash" value="<?php echo $login_hash; ?>">

                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-primary elevation-2" style="opacity: .7" value="Generate Report" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Generate -->

                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end Wrapper 1 -->

                                            <hr />

                                            <!-- <input style="width: 100px;"  value="RESET" onclick="window.location='main.php?route=pb1&act';" class="btn btn-sm btn-danger "> -->

                                            <!-- Wraper 3 -->
                                            <div class="wrapper" style="min-height:10">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                            <a href="main.php?route=home" title="Batal"> <button class="btn btn-danger btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Batal</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Wraper 3 -->

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section><!-- /.Left col -->
                            </div><!-- /.row (main row) -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php
            include 'wibjs.php';
            ?>
            <script>
                function displayHasil(tgl_awal) {
                    document.getElementById("tgl_awalHasil").value = tgl_awal;
                };
            </script>

            <script type="text/javascript">
                jQuery(document).ready(function(event) {
                    var x0 = document.getElementById("isian0");
                    var x1 = document.getElementById("isian1");
                    var x2 = document.getElementById("isian2");
                    var x3 = document.getElementById("isian3");

                    x0.style.display = "none";
                    x1.style.display = "none";
                    x2.style.display = "none";
                    x3.style.display = "none";

                });
            </script>

            <!-- Cakupan ========== -->
            <script>
                function displayResult(cakup) {
                    document.getElementById("result").value = cakup;
                    var x = document.getElementById("result").value;
                    var x0 = document.getElementById("isian0");
                    var x1 = document.getElementById("isian1");
                    var x2 = document.getElementById("isian2");
                    var x3 = document.getElementById("isian3");
                    if (x == "Semua") {
                        x0.style.display = "block";
                        x1.style.display = "none";
                        x2.style.display = "none";
                        x3.style.display = "none";
                        // alert(x + " adalah Filter 2");
                    } else if (x == "Asuransi") {
                        x0.style.display = "none";
                        x1.style.display = "block";
                        x2.style.display = "none";
                        x3.style.display = "none";
                        // alert(x + " adalah Filter 3");
                    } else if (x == "Outlet") {
                        x0.style.display = "none";
                        x1.style.display = "none";
                        x2.style.display = "block";
                        x3.style.display = "none";
                        // alert(x + " adalah Filter 4");
                    } else if (x == "Area") {
                        x0.style.display = "none";
                        x1.style.display = "none";
                        x2.style.display = "none";
                        x3.style.display = "block";
                        // alert(x + " adalah Filter 4");
                    }
                }
            </script>
            <!-- Cakupan ========== -->
            <script>
                function displayResultVoucher(pilihvoucher) {
                    document.getElementById("voucherresult").value = pilihvoucher;
                    // var x=document.getElementById("result").value;  
                    // var x0 = document.getElementById("isian0");
                    // var x1 = document.getElementById("isian1");
                    // var x2 = document.getElementById("isian2");
                    // var x3 = document.getElementById("isian3");
                    // if (x=="Semua"){
                    //   x0.style.display = "block";
                    //   x1.style.display = "none";
                    //   x2.style.display = "none";
                    //   x3.style.display = "none";
                    //     // alert(x + " adalah Filter 2");
                    //   }else if(x=="Kota"){
                    //     x0.style.display = "none";
                    //     x1.style.display = "block";
                    //     x2.style.display = "none";
                    //     x3.style.display = "none";
                    //     // alert(x + " adalah Filter 3");
                    //   }
                    //   else if(x=="Outlet"){
                    //     x0.style.display = "none";
                    //     x1.style.display = "none";
                    //     x2.style.display = "block";
                    //     x3.style.display = "none";
                    //     // alert(x + " adalah Filter 4");
                    //   }
                    //   else if(x=="Area"){
                    //     x0.style.display = "none";
                    //     x1.style.display = "none";
                    //     x2.style.display = "none";
                    //     x3.style.display = "block";
                    //     // alert(x + " adalah Filter 4");
                    //   }
                }
            </script>
        <?php
            break;

        case "report";

            $tgl_awal = $_GET['tgl_awal'];
            $tgl_akhir = $_GET['tgl_akhir'];
            $filter = $_GET['filter'];
            $nilai = $_GET['nilai'];

            // echo "<br/>" . $tgl_awal;
            // echo "<br/>" . $tgl_akhir;
            // echo "<br/>" . $filter;
            // echo "<br/>" . $nilai;

            if ($login_hash == 8) {
                $judul_area = $area_nama;
            } else {
                $judul_area = "";
            }

            if ($filter == 'asuransi') {
                $kondisi = "AND transaksi.kd_asuransi='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama_perusahaan FROM perusahaan WHERE kd_perusahaan='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama_perusahaan'];
            } elseif ($filter == 'outlet') {
                $kondisi = "AND asuransi_perusahaan='$nilai'";
                $query = mysqli_query($koneksi, "SELECT asuransi_perusahaan FROM data_tagihan WHERE asuransi_perusahaan='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['asuransi_perusahaan'];
            } elseif ($filter == 'area') {
                $kondisi = "AND kotabaru.kd_area='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama FROM area WHERE kode='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama'];
            } else {
                $kondisi = "";
                $judul_nilai = '';
            }

            if ($login_hash == '6' or $login_hash == '7') {
                $filter = 'Outlet';
                $query = mysqli_query($koneksi, "SELECT cabang_e FROM employee WHERE employee_number='$en'");
                $q1 = mysqli_fetch_array($query);
                $nilai = $q1['cabang_e'];
                $kondisi = "AND penjualan.kd_cus='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE kd_cus='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama'];
            }

            $judul = 'Generate Qty To Order';
            $judul2 = $filter . " : " . $judul_nilai . $judul_area;
            $judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

        ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: white; max-height: 1400px!important;">
                <!-- <div style="padding:2px"></div> -->
                <!-- Content Header (Page header) -->
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
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Laporan</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                </ol>
                            </div>
                        </div>
                        <!-- button save  -->
                        <br>
                        <center>
                            <h4><?php echo $judul; ?>
                                <br><?php echo $judul2; ?>
                                <br /><?php echo $judul3; ?>
                                <br /><?php echo $filter; ?>
                            </h4>
                        </center>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".1s">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Main row -->
                                <div class="row">
                                    <!-- Left col -->
                                    <section class="col-lg-12 connectedSortable">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <div style="margin:10px"></div>
                                                    <?php if ($filter == 'asuransi') { ?>
                                                        <form id="invoiceForm" action="route/<?php echo $data; ?>/generate_invoice_perusahaan.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>" method="post"> <!-- Form untuk proses penyimpanan -->
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Generate Invoice Personal</button> <!-- Tombol Save di atas tabel -->
                                                            <table id="example" class="table table-bordered table-striped">
                                                                <thead style="background-color: lightgray;" class="elevation-2">
                                                                    <tr style="text-align: center;">
                                                                        <th><input type="checkbox" id="select-all" onclick="toggle(this);"></th>
                                                                        <th>No.</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Nama Pasien</th>
                                                                        <th>Nama Asuransi</th>
                                                                        <th>Tindakan</th>
                                                                        <th>Total Nilai</th>
                                                                        <th>Dibayar Kasir</th>
                                                                        <th>Tagihan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $sql1 = mysqli_query($koneksi, "SELECT p.reff, p.tanggal, p.kode_asuransi, p.kode_pasien, pasien.nama_pasien, perusahaan.nama_perusahaan,p.no_card, 
                                                                    GROUP_CONCAT(DISTINCT transaksi_detail.`group` SEPARATOR ', ') AS groups, 
                                                                    GROUP_CONCAT(DISTINCT transaksi_detail.`nilai` SEPARATOR ', ') AS nilai_items, 
                                                                    SUM(transaksi_detail.nilai) AS total_nilai,transaksi_detail.tindakan,p.bayar_kasir 
                                                                    FROM $tabel p 
                                                                    JOIN pasien ON pasien.kd_pasien=p.kode_pasien 
                                                                    JOIN perusahaan ON perusahaan.kd_perusahaan=p.kode_asuransi
                                                                    JOIN transaksi_detail ON transaksi_detail.kode_pasien=p.kode_pasien AND transaksi_detail.tanggal = p.tanggal
                                                                    WHERE p.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                                                    AND p.kode_asuransi = '$nilai' 
                                                                    AND transaksi_detail.kode_asuransi = '$nilai'
                                                                    AND status_print=0
                                                                    GROUP BY p.tanggal, p.kode_pasien
                                                                    ORDER BY p.tanggal, pasien.nama_pasien ASC");
                                                                    if (!$sql1) {
                                                                        die("Query gagal: " . mysqli_error($koneksi));
                                                                    }
                                                                    $no = 1;
                                                                    while ($s1 = mysqli_fetch_array($sql1)) {
                                                                        $sisa = $s1['total_nilai'] - $s1['bayar_kasir']
                                                                    ?>
                                                                        <tr align="left">
                                                                            <td><input type="checkbox" name="selected_patient[]" value="<?php echo $s1['kode_pasien'] . '|' . $s1['tanggal']; ?>" class="largeCheckbox"></td> <!-- Checkbox dengan kode_pasien dan tanggal -->
                                                                            <td><?php echo $no; ?></td>
                                                                            <td><?php echo $s1['tanggal']; ?></td>
                                                                            <td><?php echo $s1['nama_pasien']; ?></td>
                                                                            <td><?php echo $s1['nama_perusahaan']; ?></td>
                                                                            <td><?php echo $s1['tindakan']; ?></td>
                                                                            <td style="text-align:right;"><?php echo number_format($s1['total_nilai']); ?></td>
                                                                            <td style="text-align:right;"><?php echo number_format($s1['bayar_kasir']); ?></td>
                                                                            <td style="text-align:right;"><?php echo number_format($sisa); ?></td>
                                                                        </tr>
                                                                    <?php
                                                                        $no++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    <?php } elseif ($filter == 'Outlet') { ?>
                                                        <form id="invoiceForm" action="route/<?php echo $data; ?>/generate_invoice_semua.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&filter=<?php echo $filter; ?>&nilai=<?php echo $nilai; ?>&judul=<?php echo $judul; ?>" method="post"> <!-- Form untuk proses penyimpanan -->
                                                            <button type="submit" class="btn btn-success mb-3"><i class="fas fa-save"></i> Generate Invoice Personal</button> <!-- Tombol Save di atas tabel -->
                                                            <table id="example" class="table table-bordered table-striped">
                                                                <thead style="background-color: lightgray;" class="elevation-2">
                                                                    <tr style="text-align: center;">
                                                                        <th><input type="checkbox" id="select-all" onclick="toggle(this);"></th>
                                                                        <th>No.</th>
                                                                        <th>Kode Barang</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Stok</th>
                                                                        <th>Rata Rata Jual</th>
                                                                        <th>Qty Tertinggi</th>
                                                                        <th>Waktu Kirim Supplier</th>
                                                                        <th>Qty Order</th>
                                                                        <th>Qty Order Max Jual</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query_kd_brg = "SELECT DISTINCT kd_brg FROM barang";
                                                                    $result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

                                                                    if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
                                                                        $no = 1;
                                                                        while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
                                                                            $kd_brg = $row_kd_brg['kd_brg'];

                                                                            // Query untuk menghitung rata-rata 7 hari qty_jual dan qty_jual_tertinggi berdasarkan kd_brg tertentu
                                                                            $query_rata_rata_dan_tertinggi = "
                                                                            SELECT 
                                                                                AVG(banyak) as rata_rata_7_hari,
                                                                                MAX(banyak) as qty_jual_tertinggi
                                                                            FROM jualdetil 
                                                                            WHERE kd_brg = '$kd_brg' 
                                                                            AND DATE(tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'";

                                                                            $result_rata_rata_dan_tertinggi = mysqli_query($koneksi, $query_rata_rata_dan_tertinggi);
                                                                            $row_rata_rata_dan_tertinggi = $result_rata_rata_dan_tertinggi ? mysqli_fetch_assoc($result_rata_rata_dan_tertinggi) : [];

                                                                            $rata_rata_7_hari = isset($row_rata_rata_dan_tertinggi['rata_rata_7_hari']) ? $row_rata_rata_dan_tertinggi['rata_rata_7_hari'] : 0;
                                                                            $qty_jual_tertinggi = isset($row_rata_rata_dan_tertinggi['qty_jual_tertinggi']) ? $row_rata_rata_dan_tertinggi['qty_jual_tertinggi'] : 0;

                                                                            // Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
                                                                            $query_kd_supp = "SELECT kd_supp FROM supplier_barang WHERE kd_brg = '$kd_brg'";
                                                                            $result_kd_supp = mysqli_query($koneksi, $query_kd_supp);
                                                                            $row_kd_supp = $result_kd_supp ? mysqli_fetch_assoc($result_kd_supp) : [];
                                                                            $kd_supp = isset($row_kd_supp['kd_supp']) ? $row_kd_supp['kd_supp'] : '';

                                                                            // Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
                                                                            $query_durasi_waktu = "SELECT term FROM supplier WHERE kd_supp = '$kd_supp'";
                                                                            $result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);
                                                                            $row_durasi_waktu = $result_durasi_waktu ? mysqli_fetch_assoc($result_durasi_waktu) : [];
                                                                            $waktu_kirim_supplier = isset($row_durasi_waktu['term']) ? $row_durasi_waktu['term'] : 0;

                                                                            // Hitung Qty Order dan Qty Order Max Jual
                                                                            $qty_order = $rata_rata_7_hari * $waktu_kirim_supplier;
                                                                            $qty_order_max_jual = $qty_jual_tertinggi * $waktu_kirim_supplier;

                                                                            // Ambil stok akhir dari tabel barang
                                                                            $query_stok_akhir = "SELECT Quantity , nama FROM barang WHERE kd_brg = '$kd_brg'";
                                                                            $result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);
                                                                            $row_stok_akhir = $result_stok_akhir ? mysqli_fetch_assoc($result_stok_akhir) : [];
                                                                            $stok_akhir = isset($row_stok_akhir['Quantity']) ? $row_stok_akhir['Quantity'] : 0;
                                                                            $nama_barang = $row_stok_akhir['nama'];


                                                                            // Tentukan Status
                                                                            if ($stok_akhir < $qty_order) {
                                                                                $status = '<span class="badge bg-danger" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Pesan</span>';
                                                                            } else {
                                                                                $status = '<span class="badge bg-success" style="padding: 8px 16px; font-size: 14px; border-radius: 8px; cursor: not-allowed;">Aman</span>';
                                                                            }
                                                                            

                                                                    ?>
                                                                            <tr align="left">
                                                                                <td><input type="checkbox" name="selected_patient[]" value="<?php echo $kd_brg . '|' . $tgl_terbaru; ?>" class="largeCheckbox"></td>
                                                                                <td><?php echo $no; ?></td>
                                                                                <td><?php echo $kd_brg; ?></td>
                                                                                <td><?php echo $nama_barang; ?></td>
                                                                                <td><?php echo $stok_akhir; ?></td>
                                                                                <td><?php echo number_format($rata_rata_7_hari, 2); ?></td>
                                                                                <td><?php echo number_format($qty_jual_tertinggi); ?></td>
                                                                                <td><?php echo $waktu_kirim_supplier . " Hari"; ?></td>
                                                                                <td><?php echo number_format($qty_order); ?></td>
                                                                                <td><?php echo number_format($qty_order_max_jual); ?></td>
                                                                                <td><?php echo $status; ?></td>
                                                                            </tr>
                                                                    <?php
                                                                            $no++;
                                                                        }
                                                                    } else {
                                                                        echo "<tr><td colspan='9' align='center'>Data tidak ditemukan</td></tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>


                                                        </form>
                                                        <!-- Save button -->
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </section><!-- /.Left col -->
                                </div><!-- /.row (main row) -->
                            </div>
                        </div>
                    </div>
                    <br />
                </section><!-- /.content -->
            </div>

            <!-- Include jQuery and Bootstrap JS for check all functionality -->
            <script>
                // Fungsi untuk mengatur checkbox "Select All"
                function toggle(source) {
                    checkboxes = document.getElementsByName('selected_patient[]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = source.checked;
                    }
                }

                // Fungsi untuk menghapus centangan pada saat halaman dimuat
                window.onload = function() {
                    document.getElementById('select-all').checked = false;
                    checkboxes = document.getElementsByName('selected_patient[]');
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                    }
                };
            </script>
            <!-- /.content-wrapper -->
            <style>
                .modal-dialog {
                    max-width: 90%;
                    margin: 1.75rem auto;
                }

                .modal-content {
                    overflow-y: auto;
                    max-height: 90vh;
                }

                .modal-body {
                    max-height: calc(100vh - 200px);
                    overflow-y: auto;
                }

                .largeCheckbox {
                    width: 20px;
                    height: 20px;
                    text-align: center;
                    vertical-align: middle;
                }

                .centerCheckbox {
                    text-align: center;
                    vertical-align: middle;
                }

                .modal {
                    display: none;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgb(0, 0, 0);
                    background-color: rgba(0, 0, 0, 0.4);
                    padding-top: 60px;
                }

                .modal-content {
                    background-color: #fefefe;
                    margin: 5% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%;
                }

                .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                }

                .close:hover,
                .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                }

                /* Styling tabel untuk cetakan */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                table,
                th,
                td {
                    border: 1px solid black;
                }

                th,
                td {
                    padding: 8px;
                    text-align: left;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        lengthMenu: [
                            [50, 100, 500, -1],
                            [50, 100, 500, 'All'],
                        ],

                    });
                });
            </script>
<?php
            break;
    }
}
?>