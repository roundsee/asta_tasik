<?php

$judulform = "Daftar Penjualan ";

$data = 'lap_pb1';
$rute = 'pb1';
$aksi = 'aksi_pb1';

$tabel = "penjualan";
$f1 = 'faktur';
$f2 = 'tanggal';
$f3 = 'kd_cus';
$f4 = 'kd_aplikasi';
$f5 = 'no_meja';
$f6 = 'oleh';
$f7 = 'subjumlah';
$f8 = 'ppn';
$f9 = 'jumlah';
$f10 = 'byr_pocer';
$f11 = 'byr_tunai';
$f12 = 'byr_non_tunai';
$f13 = 'kd_alatbayar';
$f14 = 'no_urut';
$f15 = 'tahun';
$f16 = 'bulan';
$f17 = 'jam';
$f18 = 'kdsub_alatbayar';
$f19 = 'subjumlah_offline';
$f20 = 'ket_aplikasi';
$f21 = 'dasar_fee';
$f22 = 'acuan_fee';
$f23 = 'tarif_fee';
$f24 = 'b_packing';
$f25 = 'no_online';
$f26 = 'no_ofline';
$f27 = 'tarif_pb1';
$f28 = 'faktur_refund';
$f29 = 'dasar_faktur';
$f30 = 'faktur_void';
$f31 = 'dibayar';
$f32 = 'no_ref';

$j1 = 'Faktur';
$j2 = 'Tanggal';
$j3 = 'Kode Outlet';
$j4 = 'kd_aplikasi';
$j5 = 'no_meja';
$j6 = 'oleh';
$j7 = 'Sub jumlah';
$j8 = 'PB1';
$j9 = 'Jumlah';
$j10 = 'byr_pocer';
$j11 = 'byr_tunai';
$j12 = 'byr_non_tunai';
$j13 = 'kd_alatbayar';
$j14 = 'no_urut';
$j15 = 'tahun';
$j16 = 'bulan';
$j17 = 'jam';
$j18 = 'kdsub_alatbayar';
$j19 = 'subjumlah_offline';
$j20 = 'ket_aplikasi';
$j21 = 'dasar_fee';
$j22 = 'acuan_fee';
$j23 = 'tarif_fee';
$j24 = 'b_packing';
$j25 = 'no_online';
$j26 = 'no_ofline';
$j27 = 'tarif_pb1';
$j28 = 'faktur_refund';
$j29 = 'dasar_faktur';
$j30 = 'faktur_void';
$j31 = 'dibayar';
$j32 = 'no_ref';

$tabel2 = 'kotabaru';
$ff1 = 'kode';
$tabel3 = 'pelanggan';
$gg1 = 'kd_cus';



if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT p.tanggal,p.faktur,p.oleh,subalat_bayar.nama as sb_nama
            FROM $tabel p 
            join subalat_bayar on subalat_bayar.kdsub_alat=p.kdsub_alatbayar
            WHERE p.faktur = '$_GET[id]'");

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
                                                            <div class="col-lg-7">

                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Penjualan</label>
                                                                            <input type="text" name="tanggal_penjualan" class="form-control" value="<?php echo $q1['tanggal']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j1; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $q1[$f1]; ?>" readonly />
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Nama Admin</label>
                                                                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $q1['oleh']; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Sub alat bayar</label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $q1['sb_nama']; ?>" readonly />
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
                                                            <th>Satuan</th>
                                                            <th>Qty</th>
                                                            <th>Harga</th>
                                                            <th>Diskon</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total_Qty = 0;
                                                        $total_harga = 0;
                                                        $total_jumlah = 0;
                                                        $total_diskon = 0;

                                                        $sql_items = "SELECT jd.kd_brg,b.nama AS nama_brg,jd.banyak,jd.harga,jd.jumlah,jd.satuan,jd.diskon FROM jualdetil jd
                                                        LEFT JOIN barang b ON jd.kd_brg = b.kd_brg 
                                                        WHERE jd.faktur='$_GET[id]'";
                                                        $result_items = mysqli_query($koneksi, $sql_items);
                                                        if (!$result_items) {
                                                            die("Query error: " . mysqli_error($koneksi));
                                                        }


                                                        while ($item = mysqli_fetch_assoc($result_items)) {
                                                            $total_Qty += $item['banyak'];
                                                            $total_harga += $item['harga'];
                                                            $total_jumlah += $item['jumlah'];
                                                            $total_diskon += $item['diskon'];


                                                        ?>
                                                            <tr style="<?php echo $row_style; ?>">
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo ucwords(strtolower($item['kd_brg'])); ?></td>
                                                                <td><?php echo ucwords(strtolower($item['nama_brg'])); ?></td>
                                                                <td><?php echo $item['satuan']; ?></td>
                                                                <td style="text-align: right;"><?php echo $item['banyak']; ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['harga']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['diskon']); ?></td>
                                                                <td style="text-align: right;"><?php echo number_format($item['jumlah']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4" style="text-align:right;"><strong>T O T A L:</strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_Qty); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_harga); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_diskon); ?></strong></td>
                                                            <td style="text-align: right;"><strong><?php echo number_format($total_jumlah); ?></strong></td>
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

            //Form Edit detail 
        case "edit-detail":

            // echo '<br>'.$_GET['id'];
            // echo '<br>'.$_GET['idp'];
            // echo '<br>'.$_GET['idb'];

            $edit = mysqli_query($koneksi, "SELECT $tabel.*,barang.nama AS nama_barang from $tabel LEFT JOIN barang ON $tabel.kd_brg = barang.kd_brg where $tabel.faktur = '$_GET[id]' AND $tabel.kd_brg='$_GET[id2]' AND $tabel.kd_retur='$_GET[id3]' AND $tabel.kd_cus='$_GET[id4]'");
            $e = mysqli_fetch_array($edit);

            $sql = mysqli_query($koneksi, "SELECT * from jualdetil 
						where faktur = '$_GET[id]' AND kd_brg='$_GET[id2]'  AND kd_cus='$_GET[id4]' ");
            $s1 = mysqli_fetch_array($sql);



        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header ">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div style="margin:10px;"></div>
                                <h1 class="list-gds animated tdFadeInDown">
                                    <b><?php echo $judulform; ?></b> <small> edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active">edit </li>
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
                            <div class="card-body animated tdFadeIn">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit-detail&id=<?php echo $e['faktur']; ?>&id2=<?php echo $e['kd_brg']; ?>&id3=<?php echo $e['kd_retur']; ?>&id4=<?php echo $e['kd_cus']; ?>" enctype="multipart/form-data">

                                                    <section class="base">
                                                        <div class="row">

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j1; ?></label>
                                                                    <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j2; ?></label>
                                                                    <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j3; ?></label>
                                                                    <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $e[$f3]; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Kode Barang</label>
                                                                    <input type="text" name="kd_brg" class="form-control" value="<?php echo $e['kd_brg']; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Nama Barang</label>
                                                                    <input type="text" name="nama_brg" class="form-control" value="<?php echo $e['nama_barang']; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Banyak Penjualan</label>
                                                                    <input type="text" name="banyak" class="form-control" value="<?php echo $e['banyak']; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Sisa Penjualan</label>
                                                                    <input type="text" name="sisa_penjualan" class="form-control" value="<?php echo $s1['banyak']; ?>" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label>Jumlah Retur</label>
                                                                    <input type="text" name="total_retur" class="form-control" value="<?php echo $e['total_retur']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                        </div>

                                                    </section>
                                                </form>
                                                <a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $e[$f2]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <style>
                .file {
                    visibility: hidden;
                    position: absolute;
                }
            </style>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let banyakPenjualanInput = document.querySelector("input[name='banyak']");
                    let sisaPenjualanInput = document.querySelector("input[name='sisa_penjualan']");
                    let totalReturInput = document.querySelector("input[name='total_retur']");

                    let returSebelumnya = parseInt(totalReturInput.value) || 0; // Simpan retur sebelum diubah

                    totalReturInput.addEventListener("input", function() {
                        let banyakPenjualan = parseInt(banyakPenjualanInput.value) || 0; // Ambil Banyak Penjualan
                        let totalReturBaru = parseInt(this.value) || 0; // Ambil input retur baru

                        let sisaPenjualanBaru = banyakPenjualan - totalReturBaru; // Hitung sisa baru

                        if (totalReturBaru > banyakPenjualan) {
                            alert("Jumlah retur tidak boleh melebihi banyak penjualan!");
                            this.value = returSebelumnya; // Kembalikan ke retur sebelumnya
                        } else {
                            sisaPenjualanInput.value = sisaPenjualanBaru; // Perbarui sisa penjualan
                            returSebelumnya = totalReturBaru; // Simpan perubahan
                        }
                    });
                });
            </script>

<?php
            break;
    }
}
?>