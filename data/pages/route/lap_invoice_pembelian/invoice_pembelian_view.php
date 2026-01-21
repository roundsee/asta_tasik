<?php

$judulform = 'Invoice Pembelian ';

$data = 'lap_invoice_pembelian';
$aksi = 'aksi_invoice_pembelian';
$rute = 'invoice_pembelian';

$view = 'invoice_pembelian_view';

$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';

$j1 = 'No invoice';
$j2 = 'Tanggal Invoice';
$j3 = 'Kode Po';
$j4 = 'Kode Supp';
$j5 = 'Status Payment';
$j6 = 'Status Print';
$j7 = 'Status Invoice';

$tabel2 = 'pembelian_invoice_detail';
$ff1 = 'no_invoice';
$ff2 = 'kd_po';
$ff3 = 'kd_brg';
$ff4 = 'nilai';
$ff5 = 'disc';
$ff6 = 'jml_pcs';


$jj1 = 'no invoice';
$jj2 = 'Kode Po';
$jj3 = 'Kode Barang';
$jj4 = 'Harga';
$jj5 = 'Disc';
$jj6 = 'Jumlah Pcs';

if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:



            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT *,supplier.nama AS nama_supplier FROM $tabel 
        JOIN supplier ON supplier.kd_supp = $tabel.kd_supp  where $tabel.$f1='$_GET[id]'");




            $q1 = mysqli_fetch_array($query);


            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);


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
                                                    <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $q1[$f1]; ?>">

                                                        <div class="row">
                                                            <!-- kiri -->
                                                            <div class="col-lg-7">

                                                                <div class="row">

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j1; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $id; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?></label>
                                                                            <input type="date" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $q1[$f2]; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j4; ?></label>
                                                                            <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $q1[$f4]; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <input type="text" name="" class="form-control" value="<?php echo $q1['nama_supplier']; ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Kode PO</label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1[$f3]; ?>" readonly />
                                                                        </div>
                                                                    </div>


                                                                    <!-- </div> row  -->

                                                                    <!-- <div class="row"> -->

                                                                </div> <!-- row  -->

                                                            </div> <!-- col-lg-7  -->

                                                            <!-- kanan -->
                                                            <div class="col-lg-5">
                                                                <!-- <div class="form-group">
                                                                    <label><?php echo $j4; ?></label>
                                                                    <textarea name="<?php echo $f4; ?>" rows="6" cols="70" class="form-control"><?php echo $q1[$f4]; ?></textarea>
                                                                </div> -->
                                                                <!-- <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                                </div> -->
                                                            </div> <!-- col-lg-5  -->
                                                        </div>
                                                    </form>
                                                </div>
                                                <hr>

                                                <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                    <thead style="background-color: #ddd;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah Pcs</th>
                                                            <th>Harga</th>
                                                            <th>Sub Total</th>
                                                            <th>Discount</th>
                                                            <th>Ppn</th>
                                                            <th>ongkir</th>
                                                            <th>TOtal Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total_jumlah = 0;
                                                        $total_jumlah_datang = 0;

                                                        $sql_items = " SELECT t.*, barang.nama As nama_barang, pembelian_invoice.status_invoice as pajak, pembelian.tarif_ppn as tarif, 
                                                                        pembelian_invoice.ongkir as hargaongkir
                                                                        FROM $tabel2 t
                                                                        JOIN barang ON barang.kd_brg = t.kd_brg
                                                                        JOIN pembelian_invoice ON pembelian_invoice.no_invoice = t.no_invoice
                                                                        JOIN pembelian ON pembelian.kd_po = pembelian_invoice.kd_po
                                                                        WHERE t.no_invoice = '$_GET[id]'";
                                                        $result_items = mysqli_query($koneksi, $sql_items);
                                                        if (!$result_items) {
                                                            die("Query error: " . mysqli_error($koneksi));
                                                        }

                                                        while ($item = mysqli_fetch_assoc($result_items)) {
                                                            // Tambahkan jumlah ke total
                                                            $subtotal12 = ($item['jml_pcs'] * $item['nilai']) - $item['disc'];
                                                            if ($item['pajak'] == 1) {
                                                                $nilai_pjk = $subtotal12 * $item['tarif'] / 100;
                                                            } else {
                                                                $nilai_pjk = 0;
                                                            }
                                                            $total2 = $subtotal12 + $nilai_pjk - $item['hargaongkir'];

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $item['kd_brg']; ?></td>
                                                                <td><?php echo $item['nama_barang']; ?></td>
                                                                <td><?php echo $item['jml_pcs']; ?></td>
                                                                <td style="text-align: end;"><?php echo number_format($item['nilai']); ?></td>
                                                                <td style="text-align: end;"><?php echo number_format($item['jml_pcs'] * $item['nilai']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['disc']); ?></td>
                                                                <td align="right"><?php echo number_format($nilai_pjk); ?></td>
                                                                <td style="text-align: end;"><?php echo number_format($item['hargaongkir']); ?></td>
                                                                <td style="text-align: end;"><?php echo number_format($total2); ?></td>


                                                            <?php } ?>
                                                    </tbody>


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