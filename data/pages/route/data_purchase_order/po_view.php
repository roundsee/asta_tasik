<?php

$judulform = 'Purchase Order ';

$data = 'data_purchase_order';
$rute = 'purchase_order';
$aksi = 'aksi_purchase_order';

$rute_detail = 'purchase_order_view';


$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';
$f8 = 'status_pembelian';
$f9 = 'kd_po';
$f10 = 'tgl_po';
$f11 = 'tgl_rilis';
$f12 = 'durasi_kirim';
$f13 = 'term_payment';
$f14 = 'user_input';
$f15 = 'tujuan_kirim';
$f16 = 'statuts_invoice';
$f17 = 'tenggat_waktu';
$f18 = 'user_input_terbit';
$f19 = 'user_input_rilis';
$f20 = 'tarif_ppn';



$j1 = 'Kode Purchase Request';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';
$j9 = 'KD Po';
$J10 = 'Tgl Po';
$j11 = 'Tgl Rilis';
$j12 = 'Durasi Kirim';
$j13 = 'Term Of Payment';
$j14 = 'User Input';
$j15 = 'Tujuan Kirim';
$j16 = 'Status Invoice';
$j17 = 'Tenggat Waktu';

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
$ff9 = 'satuan';
$ff10 = 'jumlah_pcs';
$ff11 = 'kd_po';
$ff12 = 'status_terima';


$jj1 = 'Kd Beli';
$jj2 = 'kd Barang';
$jj3 = 'Banyak';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Disc';
$jj8 = 'Urut';
$jj9 = 'Satuan';
$jj10 = 'Jumlah Pcs';
$jj11 = 'Kd Po';
$jj12 = 'Status Terima';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];


            $query = mysqli_query($koneksi, "SELECT $tabel.* , supplier.nama, supplier.term_of_payment  from $tabel JOIN supplier ON supplier.kd_supp = $tabel.kd_supp where $f1='$_GET[id]'");
            // 	if (!$query) {
            // 		$error_message = mysqli_error($koneksi);
            // 		echo "<script>alert('Query gagal: " . addslashes($error_message) . "');</script>";
            // }

            if (!$query) {
                $querry_message = mysqli_error($koneksi);
                echo "<script>alert('Querry gagal '.$querry_message )</script>";
            }

            $q1 = mysqli_fetch_array($query);
            $kdSupp = $q1['kd_supp'];
            $namaSupp = $q1['nama'];
            $term_of_payment = $q1['term_of_payment'];
            $kd_po = $q1['kd_po'];


            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);

            if ($q1['ppn'] == 1) {
                $ppn = 'PPN';
            } else {
                $ppn = 'Non PPN';
            }
            $input_oleh = $q1['user_input'];
            $user_input_terbit = $q1['user_input_terbit'];
            $user_input_rilis = $q1['user_input_rilis'];
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$input_oleh' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan = $s3['name_e'];
            } else {
                $nama_karyawan = '-';
            }
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$user_input_terbit' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan_penerbit = $s3['name_e'];
            } else {
                $nama_karyawan_penerbit = '-';
            }
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$user_input_rilis' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan_rilis = $s3['name_e'];
            } else {
                $nama_karyawan_rilis = '-';
            }

            $kd_brg_from_table = ''; // Inisialisasi variabel kosong

            $sql1 = mysqli_query($koneksi, "SELECT pd.*,pembelian.ppn,pembelian.tarif_ppn, barang.nama 
            FROM $tabel2 pd
            JOIN barang ON barang.kd_brg=pd.kd_brg
            JOIN pembelian ON pembelian.kd_beli = pd.kd_beli
            WHERE pd.kd_beli='$_GET[id]' ");

            if ($s1 = mysqli_fetch_array($sql1)) {
                // Simpan kd_brg dari table yang diambil
                $kd_brg_from_table = $s1[$ff2];
            }

            // Query untuk mendapatkan kd_cus dan nama_pelanggan berdasarkan tujuan_kirim
            $query = "SELECT pelanggan.kd_cus, pelanggan.nama AS nama_pelanggan 
            FROM pelanggan 
            WHERE pelanggan.kd_cus = '" . $q1['tujuan_kirim'] . "'";
            $result = mysqli_query($koneksi, $query);

            // Tambahkan pengecekan error pada query
            if (!$result) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            // Cek apakah ada hasil
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $kd_cus = $row['kd_cus'];
                $nama_cus = $row['nama_pelanggan'];
                // echo "kd_cus untuk tujuan kirim {$q1['tujuan_kirim']} adalah: $kd_cus, Nama Pelanggan: $nama_cus";
            } else {
                // echo "Data tidak ditemukan untuk tujuan kirim {$q1['tujuan_kirim']}";
            }



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
                                    <b><?php echo $judulform; ?></b> <small>Detail</small>
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
                                                                            <label><?php echo $j1; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <select name="<?php echo $f3; ?>" id="kd_supp_select" class="form-control" disabled>
                                                                                <option value="">Pilih Supplier</option>
                                                                                <?php
                                                                                // Query untuk mendapatkan seluruh supplier
                                                                                $sqlSupplier = mysqli_query($koneksi, "SELECT kd_supp, nama FROM supplier");

                                                                                // Periksa jika query gagal
                                                                                if (!$sqlSupplier) {
                                                                                    $supplier_query_message = mysqli_error($koneksi);
                                                                                    echo "<script>alert('Query daftar supplier gagal: " . addslashes($supplier_query_message) . "');</script>";
                                                                                    exit; // Menghentikan eksekusi jika query gagal
                                                                                }

                                                                                // Loop untuk menampilkan opsi supplier
                                                                                while ($supplier = mysqli_fetch_array($sqlSupplier)) {
                                                                                    // Tentukan supplier yang terpilih
                                                                                    $selected = ($supplier['kd_supp'] == $kdSupp) ? 'selected' : '';
                                                                                    // Gabungkan kd_supp dan nama untuk ditampilkan dalam dropdown
                                                                                    echo "<option value='{$supplier['kd_supp']}' $selected>{$supplier['kd_supp']} - {$supplier['nama']}</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <input type="text" id="nama_supp_input" name="nama_supplier" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j13; ?> (Day)</label>
                                                                            <input type="number" name="<?php echo $f13; ?>" rows="6" cols="70" class="form-control" value="<?php echo $term_of_payment; ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <script type="text/javascript">
                                                                        $(document).ready(function() {
                                                                            $('#kd_supp_select').change(function() {
                                                                                var kd_supp = $(this).val();
                                                                                if (kd_supp != '') {
                                                                                    $.ajax({
                                                                                        url: 'route/data_purchase_order/get_supplier.php', // File PHP untuk memproses permintaan AJAX
                                                                                        type: 'POST',
                                                                                        data: {
                                                                                            kd_supp: kd_supp
                                                                                        },
                                                                                        success: function(response) {
                                                                                            $('#nama_supp_input').val(response); // Update input nama supplier
                                                                                        }
                                                                                    });
                                                                                } else {
                                                                                    $('#nama_supp_input').val('');
                                                                                }
                                                                            });
                                                                        });
                                                                    </script>


                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?> Purchase Request</label>
                                                                            <input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-2">
                                                                        <label>Pembuat PR</label>
                                                                        <input type="text" name="<?php echo $f14; ?>" class="form-control" value="<?php echo $nama_karyawan; ?>" readonly />
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <label>Penerbit PO</label>
                                                                        <input type="text" name="<?php echo $f18; ?>" class="form-control" value="<?php echo $nama_karyawan_penerbit; ?>" readonly />
                                                                    </div>
                                                                    <?php
                                                                    // Ambil nilai $ppn dari database atau set default ke 0 jika tidak ada
                                                                    $ppn = isset($q1['ppn']) ? $q1['ppn'] : 0;
                                                                    $tarif_ppn = isset($q1['tarif_ppn']) ? $q1['tarif_ppn'] : 0;
                                                                    ?>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label>PPN</label>
                                                                            <select name="ppn" id="pilihan" class="form-control" disabled>
                                                                                <?php
                                                                                $pilihan_ppn = [
                                                                                    '0' => 'Non PPN',
                                                                                    '1' => 'PPN'
                                                                                ];
                                                                                echo implode('', array_map(function ($key, $value) use ($ppn) {
                                                                                    $selected = ($key == $ppn) ? 'selected' : '';
                                                                                    return "<option value='$key' $selected>$value</option>";
                                                                                }, array_keys($pilihan_ppn), $pilihan_ppn));
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2" id="ppn-options" style="display: <?= ($ppn == 1) ? 'block' : 'none'; ?>;">
                                                                        <div class="form-group">
                                                                            <label>Tarif PPN</label>
                                                                            <select name="tarif_ppn" id="tarif_ppn" class="form-control" disabled>
                                                                                <option value="11" <?= ($tarif_ppn == 11) ? 'selected' : ''; ?>>PPN 11%</option>
                                                                                <option value="12" <?= ($tarif_ppn == 12) ? 'selected' : ''; ?>>PPN 12%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-lg-2" id="ppn-options" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Tarif PPN</label>
                                                                            <select name="tarif_ppn" id="tarif_ppn" class="form-control">
                                                                                <option value="11">PPN 11%</option>
                                                                                <option value="12">PPN 12%</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="col-lg-4">
                                                                        <label>Tujuan Kirim</label>
                                                                        <input type="text" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?> - <?php echo $nama_cus; ?> " readonly />
                                                                        <input type="hidden" name="<?= $f15; ?>" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?>" readonly />
                                                                    </div>

                                                                    <!-- <div class="col-lg-4">
                                                                        <label>Tujuan Kirim</label>
                                                                        <select class="form-control" name="<?= $f15; ?>" id="" disabled>
                                                                            <option value="">Pilih tujuan kirim</option>
                                                                            <?php
                                                                            // Ambil nilai tujuan kirim yang sudah ada di database
                                                                            $tujuan_terpilih = $q1['tujuan_kirim'] ?? '';

                                                                            // Ambil data gudang dari database dan buat opsi dropdown
                                                                            $query = mysqli_query($koneksi, "SELECT id_gudang, nama, alamat FROM gudang");
                                                                            while ($x = mysqli_fetch_assoc($query)) {
                                                                                // Tentukan apakah opsi ini yang terpilih
                                                                                $selected = ($x['id_gudang'] == $tujuan_terpilih) ? 'selected' : '';
                                                                                // Cetak opsi dropdown dengan nilai dan nama gudang
                                                                                echo "<option value='{$x['id_gudang']}' $selected>{$x['nama']} - {$x['alamat']}</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div> -->
                                                                </div> <!-- row -->
                                                            </div> <!-- col-lg-7  -->

                                                            <!-- kanan -->
                                                            <!-- col-lg-5  -->
                                                            <!-- <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $j17; ?></label>
                                                                    <input type="number" name="<?php echo $f17; ?>" rows="6" cols="70" class="form-control" value="<?php echo $q1[$f17]; ?>">
                                                                </div>
                                                            </div> col-lg-5  -->
                                                            <div class="form-group mx-2 mt-3">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <hr>

                                                <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                    <thead style="background-color: #ddd;">
                                                        <tr style="font-weight:600">
                                                            <td align="center" width="40px">No</td>
                                                            <td align="left" width="120px"><?php echo $jj2; ?></td>
                                                            <td>Nama Barang</td>
                                                            <td align="left"><?php echo $jj3; ?></td>
                                                            <td align="center">Satuan</td>
                                                            <td align="left"><?php echo $jj4; ?></td>
                                                            <td align="right">Sub Total</td>
                                                            <td align="right">Diskon</td>
                                                            <td align="right">Ppn</td>
                                                            <td align="right">Total</td>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $subtotal = 0;
                                                        $stotal = 0;
                                                        $sql1 = mysqli_query($koneksi, "SELECT pd.*,pembelian.ppn,pembelian.tarif_ppn, barang.nama from $tabel2 pd
														JOIN barang ON barang.kd_brg=pd.kd_brg
														JOIN pembelian ON pembelian.kd_beli = pd.kd_beli
														where pd.kd_beli='$_GET[id]' 
                                                        ORDER BY pd.urut asc");

                                                        while ($s1 = mysqli_fetch_array($sql1)) {

                                                            $total_price = $s1[$ff3]  * $s1[$ff4];

                                                            $grand_total = $total_price - $s1[$ff7];

                                                            if ($s1[$f7] == 1) {
                                                                $nilai_pjk = $grand_total * $s1['tarif_ppn'] / 100;
                                                            } else {
                                                                $nilai_pjk = 0;
                                                            }
                                                            $subtotal =  $grand_total + $nilai_pjk;
                                                            $stotal = $stotal + $subtotal;

                                                            $row_style = ($s1['status_barang'] == 1) ? 'background-color: #ADD8E6;' : ''; // Warna biru muda
                                                            $is_disabled = ($s1['status_barang'] == 1) ? 'disabled' : ''; // Disable input dan tombol jika status_barang = 2


                                                        ?>
                                                            <tr style="<?php echo $row_style; ?>">
                                                                <td align="right"><?php echo $no;
                                                                                    echo "<input type='hidden' name='id[$no]' value='$s1[$ff1]'"; ?></td>
                                                                <td align="left"><?php echo $s1[$ff2]; ?></td>
                                                                <td align="left"><?php echo $s1['nama']; ?></td>
                                                                <td align="right"><?php echo number_format($s1[$ff3]); ?></td>
                                                                <td align="right"><?php echo $s1['satuan'] ?></td>
                                                                <td align="right"><?php echo number_format($s1[$ff4]); ?></td>
                                                                <td align="right"><?php echo number_format($total_price); ?></td>
                                                                <td align="right"><?php echo number_format($s1[$ff7]); ?></td>
                                                                <td align="right"><?php echo number_format($nilai_pjk); ?></td>
                                                                <td align="right"><?php echo number_format($subtotal); ?></td>


                                                            </tr>

                                                        <?php
                                                            $no++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr style="font-weight:600">
                                                            <td colspan="9" align="right">T o t a l</td>
                                                            <td align="right"><?php echo number_format($stotal); ?></td>
                                                        </tr>
                                                    </tfoot>


                                                </table>




                                                <!-- end tambah keterngan utk Proses .....-->

                                                <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->

                                                <?php
                                                $temp = $_GET['temp'] ?? '';
                                                if (!empty($temp)) {
                                                ?>
                                                    <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
                                                <?php } else { ?>
                                                    <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location=`main.php?route=po&act&ide=<?php echo $_SESSION['employee_number']; ?>`"> Back</button>
                                                <?php } ?>

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
            <script>
                document.getElementById('pilihan').addEventListener('change', function() {
                    var ppnValue = this.value;
                    var ppnOptions = document.getElementById('ppn-options');

                    if (ppnValue === '1') {
                        // Tampilkan dropdown jenis PPN jika opsi PPN dipilih
                        ppnOptions.style.display = 'block';
                    } else {
                        // Sembunyikan dropdown jenis PPN jika opsi Non PPN dipilih
                        ppnOptions.style.display = 'none';
                    }
                });
            </script>

        <?php
            break;

        //Form Edit detail 
        case "edit-detail":

            // echo '<br>'.$_GET['id'];
            // echo '<br>'.$_GET['idp'];
            // echo '<br>'.$_GET['idb'];

            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            $sql = mysqli_query($koneksi, "SELECT * from $tabel2 
						where $ff1='$_GET[id]' AND $ff2='$_GET[id2]'  ");
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
                                    <b><?php echo $judulform; ?></b> <small> Detail edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>

                                    <li class="breadcrumb-item active"><a href="main.php?route=<?php echo $rute; ?>&act"><?php echo $judulform; ?></a></li>
                                    <li class="breadcrumb-item active">edit detail</li>
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

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" enctype="multipart/form-data">

                                                    <section class="base">
                                                        <div class="row">

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj2; ?></label>
                                                                    <input type="text" name="<?php echo $ff2; ?>" class="form-control" value="<?php echo $s1[$ff2]; ?>" readonly />
                                                                </div>

                                                            </div>


                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3] * $s1[$ff_31]; ?>" readonly />
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3] * $s1[$ff_31]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj4; ?></label>
                                                                    <input type="text" name="<?php echo $ff4; ?>" class="form-control" value="<?php echo $s1[$ff4]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj7; ?></label>
                                                                    <input type="text" name="<?php echo $ff7; ?>" class="form-control" value="<?php echo $s1[$ff7]; ?>" autofocus="" />
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <hr />

                                                        <div class="form-group">
                                                        </div>

                                                    </section>
                                                </form>
                                                <a href="main.php?route=<?php echo $rute_detail; ?>&act&id=<?php echo $s1[$f1]; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>

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
                function konfirmasi() {
                    konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
                    document.writeln(konfirmasi)
                }

                $(document).on("click", "#pilih_gambar", function() {
                    var file = $(this).parents().find(".file");
                    file.trigger("click");
                });

                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#file").val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("preview").src = e.target.result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });
            </script>

            <!-- Page script -->
            <script type="text/javascript">
                $(function() {
                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("dd/mm/yyyy", {
                        "placeholder": "dd/mm/yyyy"
                    });
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("mm/dd/yyyy", {
                        "placeholder": "mm/dd/yyyy"
                    });
                    //Money Euro
                    $("[data-mask]").inputmask();

                    //Date range picker
                    $('#reservation').daterangepicker();
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY h:mm A'
                    });
                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                        function(start, end) {
                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        }
                    );

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                    //Red color scheme for iCheck
                    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                        checkboxClass: 'icheckbox_minimal-red',
                        radioClass: 'iradio_minimal-red'
                    });
                    //Flat red color scheme for iCheck
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });

                    //Colorpicker
                    $(".my-colorpicker1").colorpicker();
                    //color picker with addon
                    $(".my-colorpicker2").colorpicker();

                    //Timepicker
                    $(".timepicker").timepicker({
                        showInputs: false
                    });
                });
            </script>

            <script>
                $(function() {
                    var dt = '';
                    $('#d1').datepicker();


                    $('#d2').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                    });

                    $('#d3').datepicker({
                        changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        changeYear: true,
                        onClose: function(date) {
                            dt = date;
                            $("#d4").datepicker("destroy");
                            showdate();

                        }
                    });

                    $('#d5').datepicker({
                        changeYear: true,
                    });

                    $("#d6").datepicker();
                    $("#hFormat").change(function() {
                        $("#d6").datepicker("option", "dateFormat", $(this).val());
                    });



                    function showdate() {
                        $('#d4').datepicker({
                            changeMonth: true,
                            dateFormat: 'yy-mm-dd',
                            changeYear: true,
                            minDate: new Date(dt),
                            hideIfNoPrevNext: true
                        });
                    }

                });
            </script>

<?php
            break;
    }
}
?>