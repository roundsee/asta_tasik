<?php

$judulform = "Penjualan Detail";

$data = 'lap_pb1';
$rute = 'pb1';
$aksi = 'aksi_pb1';

$tabel = 'retur_penjualan';
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



if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];
            if (isset($_GET['info']) && !empty($_GET['info'])) {
                $info = $_GET['info'];
            } else {
                $query = mysqli_query($koneksi, "SELECT  
                faktur,tanggal,kd_aplikasi,subjumlah,ppn,penjualan.jumlah,
                penjualan.ongkir,penjualan.voucher_nilai_diskon,penjualan.byr_pocer,(penjualan.jumlah+penjualan.ongkir-penjualan.voucher_nilai_diskon - penjualan.byr_pocer) as semua_total,
                ket_aplikasi,oleh,
                subalat_bayar.nama as sb_nama
                FROM penjualan 
                join subalat_bayar on subalat_bayar.kdsub_alat=penjualan.kdsub_alatbayar
                WHERE penjualan.faktur = '$_GET[id]'
                ");

                $s1 = mysqli_fetch_array($query);

                // Create manual info array from query results
                if ($s1 != null && !empty($s1)) {
                    $info = [
                        $s1['tanggal'],
                        $s1['oleh'],
                        $s1['sb_nama'],
                        number_format($s1['jumlah']),
                        number_format($s1['ongkir']),
                        number_format($s1['voucher_nilai_diskon'] + $s1['byr_pocer']),
                        number_format($s1['semua_total'])
                    ];
                } else {
                    // Query also returned null, use default values
                    $info = [
                        'N/A',           // Default text for missing data
                        'Unknown',       // Default for 'oleh' field
                        'No Data',       // Default for 'sb_nama' field
                        number_format(0), // Default numeric values
                        number_format(0),
                        number_format(0),
                        number_format(0)
                    ];
                }
            }
            // $query = mysqli_query($koneksi, "SELECT p.*,pelanggan.kd_cus,pelanggan.nama AS nama_gudang,penjualan.tanggal AS tanggal_penjualan
            // FROM $tabel p
            // LEFT JOIN pelanggan ON p.kd_cus=pelanggan.kd_cus
            // LEFT JOIN penjualan ON p.faktur=penjualan.faktur
            // WHERE p.kd_retur = '$_GET[id]'");

            // $q1 = mysqli_fetch_array($query);


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
                                    <li class="breadcrumb-item active"> Detail</li>
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
                                                            <div class="col-lg-9">
                                                                <?php
                                                                $sql_member = "SELECT COALESCE(
                                                                                (SELECT member.nama
                                                                                FROM member 
                                                                                WHERE penjualan.no_meja = member.kd_member LIMIT 1), 
                                                                                '-'
                                                                            ) AS namamember
                                                                            FROM penjualan
                                                                            WHERE faktur = '{$_GET['id']}'";

                                                                $result_member = mysqli_query($koneksi, $sql_member);

                                                                if (!$result_member) {
                                                                    die("Query error: " . mysqli_error($koneksi));
                                                                }

                                                                // fetch only one row
                                                                $data_member = mysqli_fetch_assoc($result_member); ?>
                                                                <div class="row">

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Penjualan </label>
                                                                            <input type="text" name="tanggal_penjualan" class="form-control" value="<?php echo $info[0]; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Faktur </label>
                                                                            <input type="text" name="faktur" class="form-control" value="<?php echo $id; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Kasir </label>
                                                                            <input type="text" name="nama" class="form-control" value="<?php echo $info[1]; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Nama Member</label>
                                                                            <input type="text" name="alat_bayar" class="form-control" value="<?php echo $data_member['namamember']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Sub Alat Bayar</label>
                                                                            <input type="text" name="alat_bayar" class="form-control" value="<?php echo $info[2]; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Sub Jumlah </label>
                                                                            <input type="text" name="sub_jumlah" class="form-control" value="<?php echo $info[3]; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Ongkir </label>
                                                                            <input type="text" name="Ongkir" class="form-control" value="<?php echo $info[4]; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Voucher </label>
                                                                            <input type="text" name="Voucher" class="form-control" value="<?php echo $info[5]; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Jumlah </label>
                                                                            <input type="text" name="jumlah" class="form-control" value="<?php echo $info[6]; ?>" readonly />
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
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan</th>
                                                            <th>Banyak</th>
                                                            <th>Harga</th>
                                                            <th>Harga Total</th>
                                                            <th>Diskon</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total_penjualan = 0;
                                                        $total_retur = 0;
                                                        $seluruhsisa = 0;
                                                        $total_harga = 0;
                                                        $total_harga_total = 0;

                                                        $sql_items = "SELECT jualdetil.kd_brg,barang.nama,jualdetil.satuan,jualdetil.banyak,jualdetil.harga,jualdetil.diskon,jualdetil.jumlah FROM `jualdetil` JOIN barang on jualdetil.kd_brg = barang.kd_brg
                                                        WHERE `faktur` = '$_GET[id]'";
                                                        $result_items = mysqli_query($koneksi, $sql_items);
                                                        if (!$result_items) {
                                                            die("Query error: " . mysqli_error($koneksi));
                                                        }


                                                        while ($item = mysqli_fetch_assoc($result_items)) {
                                                            $total_penjualan += $item['banyak'];
                                                            $total_harga += $item['harga'];
                                                            $total_harga_total += $item['harga'] * $item['banyak'];
                                                            $total_retur += $item['diskon'];
                                                            $seluruhsisa += $item['jumlah'];

                                                        ?>
                                                            <tr style="<?php echo $row_style; ?>">
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                                                <td><?php echo ucwords(strtolower($item['nama'])); ?></td>
                                                                <td><?php echo $item['satuan']; ?></td>
                                                                <td style="text-align: right;"><?php echo $item['banyak']; ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['harga']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['harga'] * $item['banyak']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['diskon']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['jumlah']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;"><strong>T O T A L:</strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_penjualan); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_harga); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_harga_total); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_retur); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($seluruhsisa); ?></strong></< /td>
                                                        </tr>
                                                    </tfoot>


                                                </table>
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