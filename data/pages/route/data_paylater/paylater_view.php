<?php

$judulform = 'Paylater ';
$data = 'data_paylater';
$aksi = 'aksi_paylater';
$rute = 'paylater';

$tabel = 'payment';
$f1 = 'no_invoice';
$f2 = 'jumlah_payment';
$f3 = 'no_payment';
$f4 = 'tanggal_Payment';
$f5 = 'insert_oleh';
$f6 = 'tanggal';
$f7 = 'metode_payment';
$f8 = 'reff';
$f9 = 'akun';
$f10 = 'status';
$f11 = 'ppn';

$j1 = 'No Invoice';
$j2 = 'Jumlah Payment';
$j3 = 'No Payment';
$j4 = 'Tanggal Payment';
$j5 = 'Insert Oleh';
$j6 = 'Tanggal';
$j7 = 'Metode Payment';
$j8 = 'Reff';
$j9 = 'Akun';
$j10 = 'Status';
$j11 = 'Ppn';

$tabel2 = 'pembelian_invoice';
$ff1 = 'no_invoice';
$ff2 = 'tanggal_invoice';
$ff3 = 'kd_po';
$ff4 = 'kd_supp';
$ff5 = 'status_payment';
$ff6 = 'status_print';
$ff7 = 'status_invoice';
$ff8 = 'ppn';

$jj1 = 'No Invoice';
$jj2 = 'Tanggal Invoice';
$jj3 = 'Kode PO';
$jj4 = 'Kode Supplier';
$jj5 = 'Status Payment';
$jj6 = 'Status Print';
$jj7 = 'Status Invoice';
$jj8 = 'Ppn';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "
            SELECT 
                penjualan.faktur,
                date(penjualan.tanggal) as tanggal,
                (penjualan.jumlah + penjualan.ongkir - penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as jumlah,
                member.nama
            FROM penjualan
            JOIN member 
                ON penjualan.no_meja = member.kd_member
            WHERE penjualan.faktur ='$_GET[id]'
        ");


            $q1 = mysqli_fetch_array($query);
            $dir = '../../';
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="height:70%">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay=".1s">
                                    <b><?php echo $judulform; ?></b> <small>view</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active"> view</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content" style="height:90%">
                    <div class="container-fluid table-responsive" style="height:100%">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body" style="height:70%">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">
                                                <div class="row" style="background-color:ghostwhite;">
                                                    <!-- baris 1 -->
                                                    <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $q1['faktur']; ?>">

                                                        <div class="row">
                                                            <!-- kiri -->
                                                            <div class="col-lg-12">

                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Transaksi</label>
                                                                            <input type="date" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $q1['tanggal']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Faktur</label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Member</label>
                                                                            <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $q1['nama']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Jumlah Transaksi</label>
                                                                            <input type="text" class="form-control" value="Rp <?php echo number_format($q1['jumlah']); ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- row  -->

                                                            </div> <!-- col-lg-7  -->
                                                        </div>
                                                    </form>
                                                </div>
                                                <hr>

                                                <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                    <thead style="background-color: #ddd;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Payment</th>
                                                            <th>Tanggal Payment</th>
                                                            <th>Insert Oleh</th>
                                                            <th>Reff</th>
                                                            <th>Metode Payment</th>
                                                            <th>Akun</th>
                                                            <th>Jumlah Payment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $subtotal = 0;
                                                        $sql_items = "SELECT t.faktur, t.tanggal_payment,t.insert_oleh,t.reff, jt.nama as nama_metode, a.deskripsi as nama_account,t.faktur,t.jumlah_payment
                                                        FROM paylater t
                                                        JOIN jenis_transaksi jt ON jt.kd_jenis = t.metode_payment
                                                        JOIN account a ON a.no_account = t.akun
                                                        WHERE t.faktur = '$_GET[id]'";

                                                        $result_items = mysqli_query($koneksi, $sql_items);
                                                        if (!$result_items) {
                                                            die("Query error: " . mysqli_error($koneksi));
                                                        }

                                                        while ($item = mysqli_fetch_assoc($result_items)) {
                                                            // Tambahkan jumlah ke total
                                                            $subtotal += $item['jumlah_payment'];

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $item['faktur']; ?></td>
                                                                <td><?php echo $item['tanggal_payment']; ?></td>
                                                                <td><?php echo $item['insert_oleh']; ?></td>
                                                                <td><?php echo $item['reff']; ?></td>
                                                                <td><?php echo $item['nama_metode']; ?></td>
                                                                <td><?php echo $item['nama_account']; ?></td>
                                                                <td class="text-end" style="text-align: right;"><?php echo number_format($item['jumlah_payment']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <td colspan="7" style="text-align: right;"><strong>TOTAL : </strong></td>
                                                        <td style="text-align: right;"><strong><?php echo number_format($subtotal); ?></strong></td>
                                                    </tfoot>


                                                </table>




                                                <!-- end tambah keterngan utk Proses .....-->

                                                <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->

                                                <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>


                                            </div>
                                            <hr>



                                        </div><!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                </div><!--/.col (right) -->
                            </div> <!-- /.row -->
                        </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
<?php
            break;
    }
}
?>