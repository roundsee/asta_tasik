<?php
include '../../config/koneksi.php'; // Sertakan file koneksi
$judulform = 'Detail Pembayaran';
$rute = 'payment_invoice';
$no_invoice = $_GET['no_invoice'];
$kode_pasien = $_GET['kode_pasien'];
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

// Query untuk mendapatkan detail pembayaran
$query_payment_detail = "SELECT p.no_payment,p.tanggal_payment,p.jumlah_payment, p.insert_oleh,pasien.nama_pasien
                         FROM payment p
                         JOIN pasien ON pasien.kd_pasien = p.kode_pasien
                         WHERE p.no_invoice = '$no_invoice' AND p.kode_pasien = '$kode_pasien'
                         AND p.tanggal = '$tanggal'";
$sql_payment_detail = mysqli_query($koneksi, $query_payment_detail);
if (!$sql_payment_detail) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<div class="content-wrapper" style="background-color: ghostwhite;">
    <section class="content-header wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="list-gds">
                        <b><?php echo $judulform; ?></b> <small>report</small>
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
        </div>
    </section>
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
                            <div class="box">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <div style="margin:10px"></div>

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead style="background-color: lightgray;" class="elevation-2">
                                                <tr>
                                                    <th>No Payment</th>
                                                    <th>Tanggal Payment</th>
                                                    <th>Jumlah Pembayaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($payment = mysqli_fetch_assoc($sql_payment_detail)) { ?>
                                                    <tr>
                                                        <td><?php echo $payment['no_payment']; ?></td>
                                                        <td><?php echo $payment['tanggal_payment']; ?></td>
                                                        <td style="text-align: right;"><?php echo number_format($payment['jumlah_payment']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->
                    </div><!-- /.row (main row) -->
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>
<div class="container mt-5">
    <h2>Detail Pembayaran</h2>

    <!-- <a href="" class="btn btn-primary">Kembali</a> Ganti dengan halaman sebelumnya -->
</div>