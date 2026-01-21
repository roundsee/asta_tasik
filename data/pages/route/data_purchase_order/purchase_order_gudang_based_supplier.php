<?php

$judulform = "Purchase Order";

$data = 'data_purchase_order';
$rute = 'purchase_order_gudang';
$aksi = 'aksi_purchase_order_gudang';

$rute_detail = 'purchase_order_view';
$rute_detail2 = 'invoice_tambah_po';

$view = 'purchase_order_view';

$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'tgl_po';
$f10 = 'tgl_rilis';


$j1 = 'Kode PO';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'Ppn';
$j8 = 'Status Pembelian';
$j9 = 'Tanggal PO';
$j10 = 'Tangagl Rilis';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff_31 = 'jumlah_pcs';

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
                                                        <?php if ($login_hash != '7') { ?>

                                                            <!-- Filter -->
                                                            <div class="col-lg-2">
                                                                <!-- <div class="col-lg-12"> -->
                                                                <div class="form-group">
                                                                    <label>Filter
                                                                    </label>

                                                                    <?php if ($login_hash != '8') { ?>
                                                                        <!-- <div>
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Semua"> Semua
                                                                        </div> -->
                                                                        <div>
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Supplier"> Supplier
                                                                        </div>
                                                                        <!-- <div>
                                                                            <input type="radio" name="cakup" onclick="displayResult(this.value)" value="Outlet"> Data Siap Print
                                                                        </div> -->
                                                                    <?php } ?>

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
                                                        <?php } ?>


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

                                                                                            <label>Kode Supplier</label>
                                                                                            <input type="text" class="form-control" required="required" id="tampil_asuransi_kode" placeholder="Isi Kode Supplier">
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariAsuransi">
                                                                                                <i class="fa fa-search"></i> Cari Supplier
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <label>Supplier<span id="status_asuransi"></span></label>
                                                                                    <input type="text" class="form-control" name="asuransi" value="" required="required" placeholder="Nama Supplier .." id="tampil_asuransi_nama" readonly>

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
                                                                                                            $data = mysqli_query($koneksi, "SELECT kd_supp,nama
                                                                                                                                            FROM supplier                                                                                                               
                                                                                                                                            ORDER BY kd_supp ASC;
                                                                                                                                            ");
                                                                                                            while ($d = mysqli_fetch_array($data)) {
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                                                                                                    <td width="1%" class="text-center"><?php echo $d['kd_supp']; ?></td>
                                                                                                                    <td width="3%"><?php echo $d['nama']; ?></td>
                                                                                                                    <td width="1%">
                                                                                                                        <button type="button" class="btn btn-success btn-sm modal-pilih-asuransi" id="<?php echo $d['kd_supp']; ?>" kode="<?php echo $d['kd_supp']; ?>" nama="<?php echo $d['nama']; ?>" data-dismiss="modal">Pilih</button>
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
                                                                    <input type="hidden" name="supplier" id="tampil_asuransi_id">
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
                    } else if (x == "Supplier") {
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

        <?php
            break;

        case "report";

            // $tgl_awal = $_GET['tgl_awal'];
            // $tgl_akhir = $_GET['tgl_akhir'];
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

            if ($filter == 'supplier') {
                $kondisi = "AND supplier.kd_supp='$nilai'";
                $query = mysqli_query($koneksi, "SELECT nama FROM supplier WHERE kd_supp='$nilai'");
                $q1 = mysqli_fetch_array($query);
                $judul_nilai = $q1['nama'];
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



            $judul = 'Data Data Pembelian';
            $judul2 = $filter . " : " . $judul_nilai . $judul_area;
            // $judul3 = 'Periode : ' . $tgl_awal . " s/d " . $tgl_akhir;

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
                                <!-- <br /><?php echo $judul3; ?> -->
                            </h4>
                            <!-- <?php
                                    echo "<br/>" . $filter;
                                    echo "<br/>" . $nilai;
                                    ?> -->
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
                                                    <?php if ($filter == 'supplier') { ?>
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead style="background-color:  lightgray;" class="elevation-2">
                                                                <tr>
                                                                    <?php if ($login_hash  != 21) { ?>
                                                                        <th><input type="checkbox" id="select-all" onclick="toggle(this);"></th>
                                                                    <?php } ?>
                                                                    <th>No.</th>
                                                                    <th><?php echo $j1; ?></th>
                                                                    <!-- <th>Status</th> -->
                                                                    <th><?php echo $j9; ?></th>
                                                                    <th><?php echo $j3; ?></th>
                                                                    <!-- <th>Total QTY</th>
                                                                    <th>Satuan</th> -->
                                                                    <th width="340px">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                $sql1 = mysqli_query($koneksi, "SELECT $tabel.* , b.nama AS nama_barang , pd.kd_brg as kd_brg , pd.jumlah_pcs as jumlah_pcs
                                                                from $tabel
                                                                JOIN pembelian_detail pd ON pd.kd_beli = $tabel.kd_beli
                                                                JOIN barang b ON b.kd_brg = pd.kd_brg
                                                                 WHERE status_pembelian >= 1 
                                                                 AND kd_supp='$nilai'
                                                                 GROUP BY kd_po
                                                                 ");

                                                                $no = 1;
                                                                $nilai_pjk = 0;
                                                                $subtotal = 0;
                                                                $jumlah_pcs = 0;

                                                                if (!$sql1) {
                                                                    die('query error' . mysqli_error($koneksi));
                                                                }

                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $sql2 = mysqli_query($koneksi, "SELECT *,sum(disc) as tot_disc, sum(jml*price) as tot_price , sum(jml*jumlah_pcs) as jumlah_pcs  from $tabel2 WHERE kd_beli='$s1[kd_beli]' ");
                                                                    $s2 = mysqli_fetch_array($sql2);

                                                                    $grand_total = $s2['tot_price'] - $s2['tot_disc'];

                                                                    if ($s1[$f7] == 1) {
                                                                        $nilai_pjk = $grand_total * 11 / 100;
                                                                    } else {
                                                                        $nilai_pjk = 0;
                                                                    }
                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                    $jumlah_pcs = $s2['jumlah_pcs'];

                                                                    // if ($s1[$f7] == 1) {
                                                                    //     $nilai_pjk = $s2['tot_price'] * 11 / 100;
                                                                    // } else {
                                                                    //     $nilai_pjk = 0;
                                                                    // }
                                                                    // $subtotal = $s2['tot_price'] + $nilai_pjk;

                                                                ?>
                                                                    <tr align="left">

                                                                        <?php if ($login_hash  != 21) { ?>
                                                                            <?php if ($s1[$f8] == 1) { ?>
                                                                                <td><input type="checkbox" name="selected_items[]" value="<?php echo $s1['kd_beli']  . '|' . $s1['kd_po'] . '|' . $s1['kd_supp']; ?>" class="largeCheckbox"></td>
                                                                            <?php } else { ?>
                                                                                <td></td>
                                                                            <?php } ?>
                                                                        <?php } ?>



                                                                        <td><?php echo $no; ?></td>

                                                                        <td><?php echo $s1['kd_po']; ?></td>
                                                                        <td><?php echo $s1[$f9]; ?></td>

                                                                        <td><?php echo $s1[$f3]; ?></td>
                                                                        <!-- <td><?php echo $s1[$f4]; ?></td> -->
                                                                        <!-- <td style="text-align:right;"><?php echo number_format($jumlah_pcs, 0, ',', '.'); ?></td>
                                                                        <td><?php echo "Pcs " ?></td> -->

                                                                        <?php if ($login_hash != 21) { ?>
                                                                            <td>
                                                                                <?php if ($s1[$f8] == 1) { ?>
                                                                                <?php } elseif ($s1[$f8] == 2) { ?>
                                                                                    <a href="route/<?php echo $data; ?>/cetak.php?kd_beli=<?php echo $s1['kd_beli']; ?>" target="_blank">
                                                                                        <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-print"></i> Cetak
                                                                                        </button>
                                                                                    </a>
                                                                                <?php } elseif ($s1[$f8] == 3) { ?>
                                                                                    <button class="btn btn-primary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-print"></i> Sudah Cetak
                                                                                        </a>
                                                                                    <?php } else { ?>
                                                                                        <a href="" title="Hapus">
                                                                                            <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                                <i class="fa fa-times-circle"></i> Terima Barang
                                                                                            </button>
                                                                                        </a>

                                                                                    <?php } ?>
                                                                            </td>
                                                                        <?php  } else { ?>
                                                                            <?php if ($s1['status_pembelian'] == 3) { ?>
                                                                                <td>
                                                                                    <button class="btn btn-success btn-sm elevation-2 btn-terima-barang"
                                                                                        data-kd_beli="<?php echo $s1['kd_beli']; ?>"
                                                                                        data-kd_po="<?php echo $s1['kd_po']; ?>"
                                                                                        data-tujuan_kirim="<?php echo $s1['tujuan_kirim']; ?>"
                                                                                        data-kd_brg="<?php echo $s1['kd_brg']; ?>"
                                                                                        data-nama_barang="<?php echo $s1['nama_barang']; ?>"
                                                                                        data-jumlah_pcs="<?php echo $s1['jumlah_pcs']; ?>"
                                                                                        type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-times-circle"></i> Terima Barang
                                                                                    </button>
                                                                                    <a href="route/<?php echo $data; ?>/cetak_bongkar.php?kd_beli=<?php echo $s1['kd_beli']; ?>" target="_blank">
                                                                                        <button class="btn btn-warning btn-sm elevation-2" type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-print"></i> Cetak
                                                                                        </button>
                                                                                    </a>
                                                                                </td>
                                                                            <?php } elseif ($s1['status_pembelian'] == 4) { ?>
                                                                                <td>
                                                                                    <a href="route/<?php echo $data; ?>/generate_terima_barang.php?kd_beli=<?php echo $s1['kd_beli']; ?>">
                                                                                        <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                            <i class="fa fa-times-circle"></i> Barang Diterima
                                                                                        </button>
                                                                                    </a>
                                                                                </td>
                                                                            <?php } else { ?>
                                                                                <td>
                                                                                    <button class="btn btn-secondary btn-sm elevation-2" disabled type="button" style="opacity: .7;">
                                                                                        <i class="fa fa-times-circle"></i> Belum Cetak PO
                                                                                    </button>
                                                                                </td>

                                                                            <?php } ?>

                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <!-- Save button -->
                                                    <?php } ?>
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
            <!-- Modal untuk detail invoice-->
            <!-- Modal Surat Jalan -->
            <div class="modal fade" id="modalSuratJalan" tabindex="-1" role="dialog" aria-labelledby="modalSuratJalanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);">
                        <form id="formSuratJalan" action="route/<?php echo $data ?>/generate_terima_barang.php" method="POST">
                            <div class="modal-header" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modalSuratJalanLabel" style="font-family: 'Montserrat', sans-serif; font-size: 1.25rem; font-weight: 600;">KODE PURCHASE ORDER : <span id="title"></span> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 1.5rem;">
                                <input type="hidden" name="kd_beli" id="modalKdBeli">

                                <input type="hidden" name="tujuan_kirim" id="tujuanKirim">

                                <!-- Input Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" style="font-weight: bold;">Tanggal Penerimaan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required value="<?php echo date('Y-m-d'); ?>" style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;">
                                </div>

                                <!-- Checkbox Surat Jalan Otomatis -->
                                <div class="form-group">
                                    <input type="checkbox" id="autoSuratJalan" name="autoSuratJalan">
                                    <label for="autoSuratJalan" style="font-weight: bold; margin-left: 5px;">Generate Surat Jalan Secara Otomatis</label>
                                </div>

                                <!-- Input Nomor Surat Jalan -->
                                <div class="form-group" id="suratJalanGroup">
                                    <label for="surat_jalan" style="font-weight: bold;">Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" id="surat_jalan" name="surat_jalan" required style="border-radius: 30px; border: 1px solid #007bff; padding: 0.75rem;">
                                </div>

                                <!-- Tabel Kode Barang -->
                                <div class="table-responsive">
                                    <table id="modalTable" class="table table-bordered table-striped">
                                        <thead style="background-color: lightgray;">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Qty Berdasarkan PO</th>
                                                <th>Satuan</th>
                                                <th>Qty Terima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Baris data akan ditambahkan di sini -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer" style="border-top: none;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Tutup</button>
                                <button type="submit" class="btn btn-success" style="border-radius: 30px; padding: 0.5rem 1.5rem;">Proses Penerimaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Tampilkan atau sembunyikan input Surat Jalan berdasarkan checkbox
                $('#autoSuratJalan').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#suratJalanGroup').hide(); // Sembunyikan input surat jalan
                        $('#surat_jalan').prop('required', false); // Hilangkan required
                    } else {
                        $('#suratJalanGroup').show(); // Tampilkan input surat jalan
                        $('#surat_jalan').prop('required', true); // Tambahkan required
                    }
                });

                // Set kondisi awal ketika halaman dimuat
                $(document).ready(function() {
                    if ($('#autoSuratJalan').is(':checked')) {
                        $('#suratJalanGroup').hide();
                        $('#surat_jalan').prop('required', false);
                    }
                });
            </script>


            <script>
                $(document).on('click', '.btn-terima-barang', function() {
                    var kd_beli = $(this).data('kd_beli');
                    var kd_po = $(this).data('kd_po');
                    var tujuan_kirim = $(this). data('tujuan_kirim');

                    $('#modalKdBeli').val(kd_beli); // Set nilai kd_beli di modal
                    $('#title').text(kd_po); // Set judul di modal
                    $('#tujuanKirim').val(tujuan_kirim)

                    // Kosongkan tabel sebelum menambahkan data baru
                    $('#modalTable tbody').empty();

                    $.ajax({
                        url: 'route/<?php echo $data ?>/get_barang_by_kd_beli.php', // Ganti dengan path yang sesuai
                        type: 'POST',
                        data: {
                            kd_beli: kd_beli
                        },
                        dataType: 'json',
                        success: function(response) {
                            $.each(response, function(index, item) {
                                // Format qty PO menjadi angka bulat
                                var qtyPO = Math.round(item.jumlah_pcs);

                                $('#modalTable tbody').append(
                                    '<tr>' +
                                    '<td><input type="text" class="form-control" value="' + item.kd_brg + '" readonly></td>' +
                                    '<td><input type="text" class="form-control" value="' + item.nama_barang + '" readonly></td>' +
                                    '<td><input type="text" class="form-control qty-po" value="' + formatRupiah(qtyPO) + '" readonly data-qty="' + qtyPO + '"></td>' +
                                    '<input type="hidden" name="jml[]" value="' + qtyPO + '">' +
                                    '<td><input type="text" name="satuan[]" class="form-control" value="' + item.satuan + '" readonly></td>' +
                                    '<input type="hidden" name="urut[]" value="' + item.urut + '">' +
                                    '<td><input type="hidden" name="kd_brg[]" value="' + item.kd_brg + '">' +
                                    '<input type="text" class="form-control qty-terima" name="qty_terima[]" placeholder="Masukan Qty Terima" required></td>' + // Tambahkan required
                                    '</tr>'
                                );
                            });

                            $('#modalSuratJalan').modal('show'); // Tampilkan modal
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Tampilkan error jika terjadi
                        }
                    });
                });

                // Fungsi untuk format angka ke format ribuan
                function formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Menambahkan pemisah ribuan
                }

                // Event input untuk qty terima
                $(document).on('input', '.qty-terima', function() {
                    var qtyTerimaInput = $(this);
                    var qtyPO = parseFloat(qtyTerimaInput.closest('tr').find('.qty-po').data('qty')); // Ambil qty PO asli
                    var qtyTerima = parseFloat(qtyTerimaInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Konversi ke angka

                    // Jika qty terima melebihi qty PO, tampilkan peringatan
                    if (qtyTerima > qtyPO) {
                        alert('Qty Terima melebihi Qty Berdasarkan PO');
                        qtyTerimaInput.val(formatRupiah(qtyPO)); // Set qty terima maksimal sesuai qty PO
                    } else {
                        qtyTerimaInput.val(formatRupiah(qtyTerima)); // Set format ribuan untuk tampilan
                    }
                });

                // Sebelum form disubmit, pastikan untuk mengubah nilai qty terima ke format numerik
                $(document).on('submit', 'form', function(event) {
                    // Pastikan untuk mengambil semua qty terima
                    $('.qty-terima').each(function() {
                        var qtyTerimaInput = $(this);
                        var qtyTerima = parseFloat(qtyTerimaInput.val().replace(/\./g, '').replace(',', '.')) || 0; // Ambil nilai numerik
                        qtyTerimaInput.val(qtyTerima); // Set nilai kembali tanpa pemisah ribuan
                    });
                });
            </script>



            <!-- Modal PUrchase detail -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Purchase Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Detail invoice akan dimuat di sini melalui Ajax -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#viewModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget); // Button yang memicu modal
                        var kd_po = button.data('kd_po'); // Ambil data-kd_po

                        $.ajax({
                            url: 'route/data_purchase_order/detail_purchase_order.php', // Ubah dengan path yang sesuai
                            type: 'GET',
                            data: {
                                kd_po: kd_po
                            },
                            success: function(response) {
                                $('#viewModal .modal-body').html(response);
                            },
                            error: function() {
                                alert('Gagal memuat data.');
                            }
                        });
                    });
                });
            </script>

            <style>
                .modal-backdrop {
                    z-index: 1040 !important;
                }

                .modal {
                    z-index: 1050 !important;
                }

                .modal-dialog {
                    max-width: 90%;
                    margin: 1.75rem auto;
                }

                .modal-content {
                    max-height: 90vh;
                    overflow-y: auto;
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
