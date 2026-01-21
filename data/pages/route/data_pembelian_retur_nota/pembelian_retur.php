<?php

$judulform = 'Retur Pembelian';
$data = 'data_pembelian_retur';
$aksi = 'aksi_pembelian_retur';
$rute = 'pembelian_retur';
$rute_detail = 'pembelian_retur_detail';
$view = 'pembelian_retur_view';


$tabel = 'retur_pembelian';
$f1 = 'tanggal_retur';
$f2 = 'nota_retur';
$f3 = 'status_retur';
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
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;"></small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                </ol>
                            </div>
                        </div>
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

                                                    <button class="btn btn-primary btn-sm elevation-2 mb-3" style="opacity: .7;" onclick="window.location='main.php?route=pembelian_retur_tambah_nota'">
                                                        <i class="fa fa-plus"></i> Tambah
                                                    </button>

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <!-- <th><?php echo $j2; ?></th> -->
                                                                <th>Kode Supplier</th>
                                                                <th>Nama Supplier</th>
                                                                <th>Nota retur</th>
                                                                <th>Nilai</th>
                                                                <th>Keterangan</th>
                                                                <!-- <th><?php echo $j3; ?></th> -->
                                                                <!-- <th><?php echo $j4; ?></th> -->
                                                                <!-- <th><?php echo $j5; ?></th> -->
                                                                <!-- <th><?php echo $j6; ?></th> -->
                                                                <!-- <th><?php echo $j7; ?></th> -->
                                                                <!-- <th><?php echo $j8; ?></th> -->
                                                                <!-- <th><?php echo $j9; ?></th> -->
                                                                <!-- <th><?php echo $j10; ?></th> -->
                                                                <!-- <th>No Voucher</th> -->
                                                                <!-- <th width="140px">Aksi</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "SELECT t.$f1,t.$f2,t.$f3,sum(total_retur) as nilai,supplier.nama as namasup,t.kd_supp from $tabel t
                                                            JOIN supplier ON supplier.kd_supp = t.kd_supp GROUP BY t.$f2");
                                                            $no = 1;

                                                            if (!$sql1) {
                                                                die("error: " . mysqli_error($koneksi));
                                                            }

                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><?php echo $s1[$f1]; ?></td>
                                                                    <td><?php echo $s1['kd_supp']; ?></td>
                                                                    <td><?php echo $s1['namasup']; ?></td>
                                                                    <td><a href="main.php?route=<?php echo $view; ?>&act&id=<?php echo $s1[$f2]; ?>&asal=<?php echo $rute; ?>" title="Detail"><?php echo $s1[$f2]; ?></td>
                                                                    <td>Rp <?php echo number_format($s1['nilai'], 0, ',', '.') ?></td>
                                                                    <?php if ($s1['status_retur'] == 0) { ?>
                                                                        <td style="background-color: #a6d8a8;">Dapat Digunakan</td> <!-- Darker green -->
                                                                    <?php } else { ?>
                                                                        <td style="background-color: #f1a6a6;">Sudah Digunakan</td> <!-- Darker red -->
                                                                    <?php } ?>

                                                                    <!-- <td><?php echo $s1['tanggal_pembelian']; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td> -->
                                                                    <!-- <td><?php echo $s1[$f4]; ?></td>
                                                                    <td><?php echo $s1[$f5]; ?></td>
                                                                    <td><?php echo $s1[$f6]; ?></td>
                                                                    <td><?php echo $s1[$f7]; ?></td>
                                                                    <td><?php echo $s1[$f8]; ?></td>
                                                                    <td><?php echo $s1[$f9]; ?></td>
                                                                    <td><?php echo $s1[$f10]; ?></td> -->
                                                                    <!-- <td><?php echo $s1['no_voucher']; ?></td> -->
                                                                    <!-- <td>
                                                                        <?php if ($s1['status_retur'] == 0) { ?>
                                                                            Jika status_voucher = 0, tombol Edit aktif
                                                                            <a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f2]; ?>&asal=<?php echo $rute; ?>" title="edit Detail">
                                                                                <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;">
                                                                                    <i class="fa fa-check"></i> Edit
                                                                                </button>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            Jika status_voucher = 1, tombol Edit dinonaktifkan
                                                                            <button class="btn btn-primary btn-sm elevation-2" style="opacity: 0.5; pointer-events: none;">
                                                                                <i class="fa fa-check"></i> Edit
                                                                            </button>
                                                                        <?php } ?>
                                                                    </td> -->
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </section><!-- /.Left col -->
                                </div><!-- /.row (main row) -->
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
<?php
            break;
    }
}
?>