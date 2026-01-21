<?php

$judulform = 'Catat Invoice ';

$data = 'data_purchase_order';
$rute = 'purchase_order';
$aksi = 'generate_invoice';

$rute_detail = 'purchase_order_view';

$rute_detail2 = 'invoice_tambah_po';



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

$j1 = 'Kode Purchase Request';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';
$j8 = 'Status Pembelian';
$j9 = 'Kode Purchase Order';
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
$jj3 = 'Jumlah';
$jj4 = 'Harga';
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

            $query = mysqli_query($koneksi, "SELECT $tabel.* , supplier.nama, penerimaan_barang.tgl_terima, pelanggan.nama AS nama_pelanggan
            from $tabel 
            JOIN supplier ON supplier.kd_supp = $tabel.kd_supp 
            JOIN penerimaan_barang ON penerimaan_barang.kd_po = $tabel.kd_po
            JOIN pelanggan ON pelanggan.kd_cus = $tabel.tujuan_kirim
              where $f1='$_GET[id]'");
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
            $kd_po = $q1['kd_po'];
            $tgl_terima = $q1['tgl_terima'];
            $tujuan_kirim = $q1['nama_pelanggan'];

            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);

            if ($q1['ppn'] == 1) {
                $ppn = 'PPN';
            } else {
                $ppn = 'Non PPN';
            }
            $input_oleh = $q1['user_input_rilis'];
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$input_oleh' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan = $s3['name_e'];
            } else {
                $nama_karyawan = '-';
            }

            $stotal = 0;



            $dir = '../../';
?>

            <style>
                /* *{
        display: none;
    } */
                #hide {
                    display: none;
                }
            </style>
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
                                                            <!-- Kolom Kiri - Informasi Utama -->
                                                            <div class="col-lg-7">
                                                                <div class="card shadow-sm p-4">
                                                                    <h5 class="mb-4">Informasi Utama Purchase Order</h5>
                                                                    <div class="row">


                                                                        <!-- Tgl Rilis PO -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="tgl_rilis_po" class="form-label">Tanggal Rilis PO</label>
                                                                            <input type="date" id="tgl_rilis_po" name="" class="form-control" value="<?php echo $q1['tgl_rilis']; ?>" readonly />
                                                                        </div>
                                                                        <!-- Tgl Rilis PO -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="tgl_terima_barang" class="form-label">Tanggal Terima Barang</label>
                                                                            <input type="date" id="tgl_terima_barang" name="" class="form-control" value="<?php echo $q1['tgl_terima']; ?>" readonly />
                                                                        </div>
                                                                        <!-- ID -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="id_po" class="form-label"><?php echo $j9; ?></label>
                                                                            <input type="text" id="id_po" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                        </div>

                                                                        <!-- Kode Supplier -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="kode_supplier" class="form-label"><?php echo $j3; ?></label>
                                                                            <input type="text" id="kode_supplier" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $kdSupp; ?>" readonly />
                                                                        </div>

                                                                        <!-- Nama Supplier -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                                                                            <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
                                                                        </div>
                                                                        <!-- Detail Total Tagihan -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="detail_total" class="form-label"><?php echo $j13; ?></label>
                                                                            <input type="number" id="detail_total" name="<?php echo $f13; ?>" class="form-control" value="<?php echo $q1[$f13]; ?>" readonly>
                                                                        </div>



                                                                        <!-- Diinput Oleh -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="diinput_oleh" class="form-label">Dirilis Oleh</label>
                                                                            <input type="text" id="diinput_oleh" name="<?php echo $f14; ?>" class="form-control" value="<?php echo $nama_karyawan; ?>" readonly />
                                                                        </div>

                                                                        <!-- PPN Status -->
                                                                        <div class="col-lg-3 mb-3">
                                                                            <label for="ppn_status" class="form-label">PPN</label>
                                                                            <input type="text" id="ppn_status" class="form-control" value="<?php echo ($q1['ppn'] == 1) ? 'PPN' : 'Non PPN'; ?>" readonly />
                                                                            <input type="hidden" name="ppn" value="<?php echo $q1['ppn']; ?>" />
                                                                        </div>

                                                                        <!-- Tarif PPN -->
                                                                        <?php if ($q1['ppn'] == 1): ?>
                                                                            <div class="col-lg-4 mb-3">
                                                                                <label for="tarif_ppn" class="form-label">Tarif PPN</label>
                                                                                <input type="text" id="tarif_ppn" name="tarif_ppn" class="form-control" value="<?php echo $q1['tarif_ppn']; ?> %" readonly />
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <!-- Tujuan Kirim -->
                                                                        <div class="col-lg-3 mb-3">
                                                                            <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                                                                            <input type="text" id="tujuan_kirim" name="" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?> - <?php echo $tujuan_kirim; ?>" readonly />
                                                                            <input type="hidden" id="tujuan_kirim" name="<?php echo $f15; ?>" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?>" readonly />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Kolom Kanan - Total dan Pembayaran -->
                                                            <div class="col-lg-5">
                                                                <div class="card shadow-sm p-4">
                                                                    <h5 class="mb-4">Pembuatan Invoice</h5>
                                                                    <div class="row">
                                                                        <!-- No Invoice -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="no_invoice" class="form-label">Nomor Invoice</label>
                                                                            <input type="text" id="no_invoice" name="no_invoice" class="form-control" required />
                                                                        </div>
                                                                        <!-- Tanggal -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="tanggal" class="form-label"><?php echo $j2; ?> INVOICE Dibuat</label>
                                                                            <input type="date" id="tanggal" name="tgl_invoice" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <!-- Total Tagihan -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="total_tagihan" class="form-label">Total Tagihan</label>
                                                                            <input type="text" id="ttg" name="total_tagihan" class="form-control" disabled value="<?php echo number_format($stotal, 0, ',', '.'); ?>">
                                                                        </div>

                                                                        <!-- Ongkos Kirim -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="ongkos_kirim" class="form-label">Selisih</label>
                                                                            <input type="text" id="ongkos_kirim" name="ongkos_kirim_display" class="form-control" value="0" placeholder="Masukkan ongkos kirim">
                                                                            <input type="hidden" id="ongkos_kirim_asli" name="ongkos_kirim" value="0">
                                                                        </div>
                                                                        <!-- Submit Button -->
                                                                        <div class="col-lg-6 mb-3">
                                                                            <!-- <input type="submit" value="Kirim" id="submitButton"> -->
                                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7" onclick="this.disabled=true; this.form.submit();">Catat Invoice</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <hr>



                                                        <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                            <thead style="background-color: #ddd;">
                                                                <tr style="font-weight:600">
                                                                    <td align="center">No</td>
                                                                    <td align="left" width="120px"><?php echo $jj2; ?></td>
                                                                    <td>Nama Barang</td>
                                                                    <td align="left">Qty Barang datang</td>
                                                                    <td>Satuan</td>
                                                                    <td>ISI (Satuan Terkecil)</td>
                                                                    <td align="center" width="150px" colspan="2"><?php echo $jj4; ?></td>
                                                                    <td align="left" width="150px">Sub Total</td>
                                                                    <td align="center" width="100px " colspan="2">Diskon</td>
                                                                    <td align="right" width="100px">PPN</td>
                                                                    <td align="right" width="100px">Total</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                $subtotal = 0;
                                                                $stotal = 0;
                                                                $sql1 = mysqli_query($koneksi, "SELECT pd.*, pembelian.ppn, barang.nama, pembelian.tarif_ppn, 
                                                                (SELECT pb.jumlah_datang FROM penerimaan_barang pb WHERE pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg AND pd.urut = pb.urut LIMIT 1) as jumlah_datang
                                                                FROM $tabel2 pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_beli = pd.kd_beli
                                                                LEFT JOIN penerimaan_barang pb ON pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg
                                                                WHERE pd.kd_beli = '$_GET[id]'
                                                                GROUP BY pd.urut
                                                                ORDER BY pd.urut ASC
                                                                
                                                                ");

                                                                if (!$sql1) {
                                                                    die("Query Error" . mysqli_error($koneksi));
                                                                }

                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $sql2 = mysqli_query($koneksi, "SELECT kd_po, kd_brg, SUM(disc) as tot_disc, SUM(price) as tot_price FROM pembelian_detail WHERE kd_po='$s1[kd_po]' GROUP BY kd_brg ");
                                                                    if (!$sql2) {
                                                                        die('Query error: ' . mysqli_error($koneksi));
                                                                    }
                                                                    $s2 = mysqli_fetch_array($sql2);
                                                                    $grand_total = ($s1['jumlah_datang'] * $s1['price']) - $s1['disc'];
                                                                    $substotal = $s1['jumlah_datang'] * $s1['price'];
                                                                    $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                    $stotal += $subtotal;


                                                                    // Tentukan jika status_barang bernilai 
                                                                    $row_style = ($s1['status_barang'] == 1) ? 'background-color: #ADD8E6;' : ''; // Warna biru muda
                                                                    $is_disabled = ($s1['status_barang'] == 1) ? 'disabled' : ''; // Disable input dan tombol jika status_barang = 2
                                                                ?>
                                                                    <tr style="<?php echo $row_style; ?>">
                                                                        <td align="right"><?php echo $no; ?>
                                                                            <input type="hidden" name="id[<?php echo $no; ?>]" value="<?php echo $s1[$ff1]; ?>">
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="kd_brg[<?php echo $no; ?>]" value="<?php echo $s1[$ff2]; ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: left;" readonly>
                                                                        </td>

                                                                        <td align="left"><?php echo $s1['nama']; ?></td>
                                                                        <td align="right"><?php echo $s1['jumlah_datang']; ?></td>
                                                                        <td align="center"><?php echo $s1['satuan']; ?></td>
                                                                        <td align="center"><?php echo $s1['jumlah_pcs']; ?></td>
                                                                        <input type="hidden" name="jumlah[<?php echo $no; ?>]" value="<?php echo $s1['jumlah_datang'] ?>" class="form-control" readonly>
                                                                        <input type="hidden" name="jml_pcs[<?php echo $no; ?>]" value="<?php echo $s1['jumlah_pcs'] ?>" class="form-control" readonly>
                                                                        <input type="hidden" name="satuan[<?php echo $no; ?>]" value="<?php echo $s1['satuan'] ?>" class="form-control" readonly>
                                                                        <input type="hidden" name="urut[<?php echo $no; ?>]" value="<?php echo $s1['urut'] ?>" class="form-control" readonly>
                                                                        <input type="hidden" name="harga[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff4]); ?>" class="form-control" readonly>
                                                                        <input type="hidden" name="diskon[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff7]); ?>" class="form-control" readonly>
                                                                        <td align="center" colspan="2">
                                                                            <input type="text" id="harga_ubah_<?php echo $no; ?>" value="<?php echo number_format($s1[$ff4]); ?>"
                                                                                placeholder="Ubah Harga" class="form-control" style="display: inline-block; width: 120px;" <?php echo $is_disabled; ?>>
                                                                            <span class="btn btn-success" style="display: inline-block; margin-left: 5px;"
                                                                                onclick="updateHarga('<?php echo $s1['kd_brg']; ?>', '<?php echo $s1['kd_po']; ?>', '<?php echo $s1['urut']; ?>', '<?php echo $no; ?>')" <?php echo $is_disabled; ?>>Simpan</span>
                                                                        </td>

                                                                        <td align="center" colspan="2">
                                                                            <input type="text" name="sub_total[<?php echo $no; ?>]" value="<?php echo number_format($substotal); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="center">
                                                                            <input type="text" id="diskon_ubah_<?php echo $no; ?>" value="<?php echo number_format($s1[$ff7]); ?>"
                                                                                placeholder="Ubah Diskon" class="form-control" style="display: inline-block; width: 120px;" <?php echo $is_disabled; ?>>
                                                                            <span class="btn btn-success" style="display: inline-block; margin-left: 5px;"
                                                                                onclick="updateDiskon('<?php echo $s1['kd_brg']; ?>', '<?php echo $s1['kd_po']; ?>', '<?php echo $s1['urut']; ?>', '<?php echo $no; ?>')" <?php echo $is_disabled; ?>>Simpan</span>
                                                                        </td>

                                                                        <td align="right">
                                                                            <input type="text" name="" value="<?php echo number_format($nilai_pjk); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="subtotal[<?php echo $no; ?>]" value="<?php echo number_format($subtotal); ?>" class="form-control"
                                                                                style="border: none; background-color: transparent; padding: 0; text-align: right;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                <?php $no++;
                                                                } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr style="font-weight:600">
                                                                    <td colspan="12" align="right">Total</td>
                                                                    <td align="right" id="stotal"><?php echo number_format($stotal, 0, ',', '.'); ?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>


                                                    </form>


                                                    <!-- end tambah keterngan utk Proses .....-->

                                                    <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->

                                                    <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>


                                                </div>
                                                <hr>
                                                <!-- <script>
                                                    // Mengecek jika ada status   <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Hapus status setelah halaman dimuat
                                                        localStorage.removeItem('invoiceReady');

                                                        // Simulasikan tombol submit saat halaman dimuat
                                                        document.getElementById('submitButton').click();
                                                    });
                                                </script> -->


                                            </div><!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                    </div><!--/.col (right) -->
                                </div> <!-- /.row -->
                            </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->'


            <script>
                window.onload = function() {
                    alert("Pastikan Seluruh Harga Sudah tepat sebelum mengisi NOMOR INVOICE!");
                };
            </script>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let subtotalText = document.getElementById('stotal').textContent.trim();
                    let subtotalValue = parseInt(subtotalText.replace(/\./g, ''));

                    function formatRupiah(angka, prefix) {
                        // Hapus semua karakter kecuali angka, tanda koma, dan tanda minus
                        angka = angka.toString().replace(/[^-\d,]/g, '');

                        // Periksa apakah angka negatif
                        let negatif = angka.startsWith('-');
                        angka = angka.replace('-', ''); // Hapus tanda minus untuk formatting

                        let number_string = angka.split(','), // Pisahkan angka sebelum dan setelah koma
                            sisa = number_string[0].length % 3,
                            rupiah = number_string[0].substr(0, sisa),
                            ribuan = number_string[0].substr(sisa).match(/\d{3}/gi);

                        if (ribuan) {
                            let separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }

                        // Gabungkan kembali bagian desimal jika ada
                        rupiah = number_string[1] != undefined ? rupiah + ',' + number_string[1] : rupiah;

                        // Tambahkan kembali tanda minus jika negatif
                        rupiah = (negatif ? '-' : '') + rupiah;

                        // Tambahkan prefix jika diberikan
                        return prefix == undefined ? rupiah : (rupiah ? prefix + ' ' + rupiah : '');
                    }



                    function updateTotalTagihan() {
                        let ongkosKirimText = document.getElementById('ongkos_kirim_asli').value; // Ambil nilai asli dari hidden input
                        let ongkosKirim = parseInt(ongkosKirimText) || 0; // Konversi ke angka
                        let totalTagihan = subtotalValue + ongkosKirim;

                        document.getElementById('ttg').value = formatRupiah(totalTagihan.toString(), 'Rp');
                    }


                    document.getElementById('ongkos_kirim').addEventListener('input', function(e) {
                        let input = e.target.value;

                        // Simpan nilai asli untuk hidden input (tanpa format)
                        let ongkosKirimAsli = input.replace(/[^0-9-]/g, ''); // Hapus semua kecuali angka dan tanda minus
                        document.getElementById('ongkos_kirim_asli').value = ongkosKirimAsli;

                        // Format tampilan dengan format rupiah
                        e.target.value = formatRupiah(input, '');
                        updateTotalTagihan();
                    });


                    // Event listener untuk input pada field Total Tagihan (id: ttg)
                    document.getElementById('ttg').addEventListener('input', function(e) {
                        let input = e.target.value;
                        e.target.value = formatRupiah(input.replace(/[^,\d]/g, ''));
                    });

                    document.getElementById('ttg').value = formatRupiah(subtotalValue.toString(), 'Rp');
                });
            </script>


            <script>
                function updateHarga(kd_brg, kd_po, urut, no) {
                    var hargaBaru = document.getElementById('harga_ubah_' + no).value;

                    if (hargaBaru === '') {
                        alert('Harga baru harus diisi!');
                        return;
                    }

                    console.log("Mengirim data ke server:", kd_brg, kd_po, urut, hargaBaru);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "route/<?php echo $data ?>/update_harga.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                alert('Harga berhasil diubah!');
                                location.reload();
                            } else {
                                console.error("Error: " + xhr.statusText);
                                alert('Terjadi kesalahan saat mengubah harga!');
                            }
                        }
                    };
                    xhr.send("kd_brg=" + encodeURIComponent(kd_brg) + "&kd_po=" + encodeURIComponent(kd_po) + "&urut=" + encodeURIComponent(urut) + "&harga_baru=" + encodeURIComponent(hargaBaru));
                }

                function updateDiskon(kd_brg, kd_po, urut, no) {
                    var diskonBaru = document.getElementById('diskon_ubah_' + no).value;

                    if (diskonBaru === '') {
                        alert('diskon baru harus diisi!');
                        return;
                    }

                    console.log("Mengirim data ke server:", kd_brg, kd_po, urut, diskonBaru);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "route/<?php echo $data ?>/update_diskon.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                alert('Diskon berhasil diubah!');
                                location.reload();
                            } else {
                                console.error("Error: " + xhr.statusText);
                                alert('Terjadi kesalahan saat mengubah diskon!');
                            }
                        }
                    };
                    xhr.send("kd_brg=" + encodeURIComponent(kd_brg) + "&kd_po=" + encodeURIComponent(kd_po) + "&urut=" + encodeURIComponent(urut) + "&diskon_baru=" + encodeURIComponent(diskonBaru));
                }
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
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" readonly />
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label><?php echo $jj3; ?></label>
                                                                    <input type="text" name="<?php echo $ff3; ?>" class="form-control" value="<?php echo $s1[$ff3]; ?>" autofocus="" />
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
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
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