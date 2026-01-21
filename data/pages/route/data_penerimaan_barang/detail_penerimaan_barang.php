<?php

$judulform = "Goods Receiving";

$data = 'data_penerimaan_barang';
$rute = 'good_receiving';
$aksi = 'aksi_penerimaan_barang';

$rute_detail = '';

$view = 'purchase_order_view';

// $tabel = 'pembelian';

// $f1 = 'kd_beli';
// $f2 = 'tgl_beli';
// $f3 = 'kd_supp';
// $f4 = 'ket_payment';
// $f5 = 'status_payment';
// $f6 = 'jenis_po';
// $f7 = 'ppn';
// $f8 = 'status_pembelian';
// $f9 = 'tgl_po';
// $f10 = 'tgl_rilis';


// $j1 = 'Kode Pembelian';
// $j2 = 'Tanggal';
// $j3 = 'Kode Supplier';
// $j4 = 'Ket Payment';
// $j5 = 'Status';
// $j6 = 'Jenis';
// $j7 = 'PB1';
// $j8 = 'Status Pembelian';
// $j9 = 'Tanggal PO';
// $j10 = 'Tangagl Rilis';

$tabel = 'penerimaan_barang';

$f1 = 'kd_po';
$f2 = 'surat_jalan';
$f3 = 'tgl_terima';
$f4 = 'kd_brg';
$f5 = 'jumlah';
$f6 = 'jumlah_datang';
$f7 = 'status';
$f8 = 'penerima';
// $f9 = 'tgl_po';

$j1 = 'Kode PO';
$j2 = 'Surat Jalan';
$j3 = 'Tanggal Terima';
$j4 = 'Kode Barang';
$j5 = 'Jumlah';
$j6 = 'jumlah_datang';
$j7 = 'Status';
$j8 = 'penerima';
// $j9 = 'Tanggal PO';
// $j10 = 'Tangagl Rilis';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
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
        default:


            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT p.*, pembelian.kd_supp , employee.name_e,supplier.nama as nama_supplier
            FROM penerimaan_barang p
            JOIN employee ON employee.employee_number = p.penerima
            JOIN pembelian ON pembelian.kd_po = p.kd_po
            JOIN supplier ON supplier.kd_supp = pembelian.kd_supp
            WHERE p.surat_jalan = '$_GET[id]'");

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

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j1; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $q1[$f1]; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?></label>
                                                                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $q1[$f2]; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j3; ?></label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1['tgl_terima']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Penerima</label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1['name_e']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Kode Supplier</label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1['kd_supp']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1['nama_supplier']; ?>" readonly />
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
                                                            <th>Qty Barang Sesuai PO</th>
                                                            <th>Qty Barang Datang</th>
                                                            <th>Satuan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total_jumlah = 0;
                                                        $total_jumlah_datang = 0;

                                                        $sql_items = "SELECT penerimaan_barang.*, barang.nama AS nama_barang, pembelian.status_invoice
                                                        FROM penerimaan_barang
                                                        INNER JOIN barang ON barang.kd_brg = penerimaan_barang.kd_brg
                                                        JOIN pembelian ON pembelian.kd_po = penerimaan_barang.kd_po 
                                                        WHERE surat_jalan = '$_GET[id]'";
                                                        $result_items = mysqli_query($koneksi, $sql_items);
                                                        if (!$result_items) {
                                                            die("Query error: " . mysqli_error($koneksi));
                                                        }


                                                        while ($item = mysqli_fetch_assoc($result_items)) {
                                                            // Tambahkan jumlah ke total
                                                            $total_jumlah += $item['jumlah'];
                                                            $total_jumlah_datang += $item['jumlah_datang'];

                                                            $row_style = ($item['jumlah'] == 0) ? 'background-color: #ADD8E6;' : ''; // Warna biru muda
                                                            $is_disabled = ($item['status_invoice'] == 1) ? 'disabled' : ''; // Disable input dan tombol jika status_barang = 2

                                                        ?>
                                                            <tr style="<?php echo $row_style; ?>">
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                                                <td><?php echo ucwords(strtolower($item['nama_barang'])); ?></td>
                                                                <td class="text-end" style="text-align: right;"><?php echo number_format($item['jumlah']); ?></td>
                                                                <!-- <td class="text-end" style="text-align: right;"><?php echo number_format($item['jumlah_datang']); ?></td> -->

                                                                <td align="right">
                                                                    <input type="text" id="jumlah_datang_ubah_<?php echo $no; ?>"
                                                                        value="<?php echo number_format($item['jumlah_datang']); ?>"
                                                                        class="form-control"
                                                                        style="display: inline-block; width: 120px;"
                                                                        <?php echo $is_disabled; ?>>
                                                                    <?php if ($item['status_invoice'] != 1) { ?>
                                                                        <span class="btn btn-success" style="display: inline-block; margin-left: 5px;"
                                                                            onclick="updateJumlahDatang('<?php echo $item['kd_brg']; ?>', '<?php echo $item['kd_po']; ?>', '<?php echo $item['urut']; ?>', '<?php echo $no; ?>')">Simpan</span>
                                                                    <?php } ?>
                                                                </td>

                                                                <td><?php echo $item['satuan'] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" style="text-align:right;"><strong>T O T A L:</strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_jumlah); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_jumlah_datang); ?></strong></td>
                                                        </tr>
                                                    </tfoot>


                                                </table>

                                                <script>
                                                    function updateJumlahDatang(kd_brg, kd_po, urut, no) {
                                                        var jumlahDatangBaru = document.getElementById('jumlah_datang_ubah_' + no).value;

                                                        if (jumlahDatangBaru === '') {
                                                            alert('Qty Barang Datang baru harus diisi!');
                                                            return;
                                                        }

                                                        console.log("Mengirim data ke server:", kd_brg, kd_po, urut, jumlahDatangBaru);

                                                        var xhr = new XMLHttpRequest();
                                                        xhr.open("POST", "route/<?php echo $data ?>/update_jumlah_datang.php", true);
                                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                        xhr.onreadystatechange = function() {
                                                            if (xhr.readyState === 4) {
                                                                if (xhr.status === 200) {
                                                                    alert('Qty Barang Datang berhasil diubah!');
                                                                    location.reload();
                                                                } else {
                                                                    console.error("Error: " + xhr.statusText);
                                                                    alert('Terjadi kesalahan saat mengubah Qty Barang Datang!');
                                                                }
                                                            }
                                                        };
                                                        xhr.send("kd_brg=" + encodeURIComponent(kd_brg) + "&kd_po=" + encodeURIComponent(kd_po) + "&urut=" + encodeURIComponent(urut) + "&jumlah_datang_baru=" + encodeURIComponent(jumlahDatangBaru));
                                                    }
                                                </script>




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