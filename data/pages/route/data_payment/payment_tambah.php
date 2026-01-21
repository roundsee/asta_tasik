<?php

$judulform = 'Payment Tambah ';

$data = 'data_payment';
$rute = 'payment_add';
$aksi = 'aksi_payment';

$rute_detail = 'purchase_order_view';

$rute_detail2 = 'invoice_tambah_po';


$tabel = 'pembelian_invoice';
$f1 = 'no_invoice';
$f2 = 'tanggal_invoice';
$f3 = 'kd_po';
$f4 = 'kd_supp';
$f5 = 'status_payment';
$f6 = 'status_print';
$f7 = 'status_invoice';

$j1 = 'no_invoice';
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
$jj4 = 'Nilai';
$jj5 = 'Disc';
$jj6 = 'Jumlah Pcs';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
        default:


            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT $tabel.* , supplier.nama from $tabel JOIN supplier ON supplier.kd_supp = $tabel.kd_supp where $f1='$_GET[id]'");
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
            $ongkir = $q1['ongkir'];

            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);

            if ($q1['ppn'] == 1) {
                $ppn = 'PPN';
            } else {
                $ppn = 'Non PPN';
            }


            $query3 = mysqli_query($koneksi, "SELECT SUM(payment.jumlah_payment) as jumlah_payment FROM payment WHERE no_invoice='$_GET[id]'");

            if ($query3) {
                $q3 = mysqli_fetch_array($query3);

                // Pastikan $q3 valid dan memiliki data
                $sudah_dibayar = isset($q3['jumlah_payment']) ? $q3['jumlah_payment'] : 0;
            } else {
                // Jika query gagal
                echo "Error: " . mysqli_error($koneksi);
                $sudah_dibayar = 0; // Tetapkan nilai default
            }

            // Menampilkan hasil dengan number_format
            $sudah_dibayar_formatted = number_format((float)$sudah_dibayar, 0, ',', '.');




            // $input_oleh = $q1['user_input'];
            // $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$input_oleh' ";
            // $result3 = mysqli_query($koneksi, $sql3);

            // if ($s3 = mysqli_fetch_array($result3)) {
            //     $nama_karyawan = $s3['name_e'];
            // } else {
            //     $nama_karyawan = '-';
            // }



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
                                                    <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input&id=<?php echo $q1[$f1]; ?>">

                                                        <div class="row">

                                                            <!-- Kolom Kiri - Informasi Utama -->
                                                            <div class="col-lg-7">
                                                                <div class="card shadow-sm p-4">
                                                                    <h5 class="mb-4">Informasi Invoice</h5>
                                                                    <div class="row">
                                                                        <!-- Tanggal -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <label for="tanggal" class="form-label"><?php echo $j2; ?> INVOICE Dibuat</label>
                                                                            <input type="date" id="tanggal" name="tgl_invoice" class="form-control" value="<?php echo $q1['tanggal_invoice']; ?>" readonly />
                                                                        </div>

                                                                        <!-- No Invoice -->

                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>Nomor Invoice</label>
                                                                                <input type="text" name="nomor_invoice" class="form-control" value="<?php echo $id ?>" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Kode PO -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>Kode PO</label>
                                                                                <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Kode Supplier -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>Kode Supplier</label>
                                                                                <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $kdSupp; ?>" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <!-- Nama Supplier -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>Nama Supplier</label>
                                                                                <input type="text" name="nama_supplier" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <!-- PPN -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label>PPN</label>
                                                                                <input type="text" class="form-control" value="<?php echo ($q1['ppn'] == 1) ? 'PPN' : 'Non PPN'; ?>" readonly />
                                                                                <input type="hidden" name="ppn" value="<?php echo $q1['ppn']; ?>" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Kolom Kanan - Total dan Pembayaran -->
                                                            <div class="col-lg-5">
                                                                <div class="card shadow-sm p-4">
                                                                    <h5 class="mb-4">Pembayaran Invoice</h5>
                                                                    <div class="row">

                                                                        <!-- Tanggal Pembayaran -->
                                                                        <div class="col-lg-4 mb-3">
                                                                            <div class="form-group">
                                                                                <label for="tanggal_payment" style="font-weight: bold;">Tanggal Pembayaran</label>
                                                                                <input type="date" class="form-control" id="tanggal_payment" name="tanggal_payment" required value="<?php echo date('Y-m-d');  ?>" ">
                                                                            </div>
                                                                        </div>



                                                                    </div>
                                                                    <div class=" row">

                                                                                <div class="col-lg-4 mb-3">
                                                                                    <div class="form-group">
                                                                                        <label for="metode_payment" style="font-weight: bold;">Jenis Transaksi</label>
                                                                                        <select class="form-control" id="metode_payment" name="metode_payment" required ">
                                                                                    <option value="">Pilih Jenis Transaksi</option>
                                                                                    <?php
                                                                                    // Ambil data dari tabel jenis_transaksi
                                                                                    $query = mysqli_query($koneksi, "SELECT * FROM jenis_transaksi");
                                                                                    while ($x = mysqli_fetch_array($query)) {
                                                                                        echo "<option value='$x[kd_jenis]'>$x[kd_jenis] - $x[nama]</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                        <!-- Akun -->
                                                                        <div class=" col-lg-4 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label for="akun" style="font-weight: bold;">Akun</label>
                                                                                                <select class="form-control" id="akun" name="akun" required ">
                                                                                    <option value="">Pilih Akun</option>
                                                                                    <!-- Options akan diisi melalui AJAX -->
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Referensi -->
                                                                        <div class=" col-lg-4 mb-3">
                                                                                                    <div class="form-group">
                                                                                                        <label for="reff" style="font-weight: bold;">Referensi (opsional)</label>
                                                                                                        <input type="text" class="form-control" id="reff" name="reff" ">
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class=" row">
                                                                                                        <input type="hidden" id="ongkir" name="" class="form-control" value="<?php echo $ongkir ?>" readonly />


                                                                                                        <div class="col-lg-4 mb-3">
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Tagihan yang harus dibayarkan</label>
                                                                                                                <input type="text" id="ttg" name="" class="form-control" value="" readonly />
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-lg-4 mb-3">
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Yang sudah dibayar</label>
                                                                                                                <input type="text" id="sudah_dibayar" name="" class="form-control" value="<?php echo $sudah_dibayar_formatted; ?>" readonly />

                                                                                                                <!-- <input type="text" id="sudah_dibayar" name="" class="form-control" value="<?php echo number_format($sudah_dibayar, 0, ',', '.'); ?>" readonly /> -->
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-lg-4 mb-3">
                                                                                                            <div class="form-group">
                                                                                                                <label>Sisa Tagihan</label>
                                                                                                                <input type="text" id="sisa_tagihan" name="" class="form-control" value="" readonly />
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-4 mb-3">
                                                                                                            <div class="form-group">
                                                                                                                <label for="jumlah_payment" style="font-weight: bold;">Jumlah Pembayaran</label>
                                                                                                                <input type="text" class="form-control" id="jumlah_payment" name="jumlah_payment" required ">
                                                                                                          </div>
                                                                                                    </div>

                                                                        <div class=" col-lg-4 mb-3">
                                                                                                                <div class="form-group">
                                                                                                                    <label for="status_lunas" style="font-weight: bold;">Status</label>
                                                                                                                    <input type="text" class="form-control" id="status_lunas" name="status_lunas" readonly ">
                                                                            </div>
                                                                        </div>
                                                                         <div class=" col-lg-4 mb-3">
                                                                                                                    <div class="form-group">
                                                                                                                        <label for="retur" style="font-weight: bold;">Retur Beli</label>
                                                                                                                        <select class="form-control" id="retur" name="retur" required ">
                                                                                    <option value=0>Pilih Nota Retur</option>
                                                                                    <?php
                                                                                    $sql = "SELECT sum(total_retur) as total, nota_retur FROM `retur_pembelian` WHERE status_retur = 0 AND kd_supp = '$kdSupp' GROUP BY nota_retur;";
                                                                                    $result = mysqli_query($koneksi, $sql);

                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                    ?>
                                                                                    <option value='<?php echo $row['total'] ?>'><?php echo $row['nota_retur'] ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                             <div class=" form-group">
                                                                                                                            <input type="hidden" class="form-control" id="nama_nota_retur" name="nama_nota_retur" value="" ">
                                                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div> <!-- row -->

                                                        <!-- Table for item details -->
                                                        <table id='hide' width='100%' border='1' cellspacing='0' cellpadding='0' class='table table-bordered table-striped'>

                                                                                                                        <thead style=" background-color: #ddd;">
                                                                                                                            <tr style="font-weight:600">
                                                                                                                                <td align="center" width="40px">No</td>
                                                                                                                                <td align="left" width="120px"><?php echo $jj2; ?></td>
                                                                                                                                <td>Kode Barang</td>
                                                                                                                                <td>Nama Barang</td>
                                                                                                                                <td align="left">Jumlah Barang datang</td>
                                                                                                                                <td align="left" width="140px"><?php echo $jj3; ?> Berdasarkan PO</td>
                                                                                                                                <td align="left" width="140px"><?php echo $jj4; ?></td>
                                                                                                                                <td align="right" width="100px">Diskon</td>
                                                                                                                                <td align="right" width="100px">PPN</td>
                                                                                                                                <td align="right" width="100px">Total</td>
                                                                                                                                <!-- <td align="center" style="min-width:60px;width: 80px;">Aksi</td> -->
                                                                                                                            </tr>
                                                                                                                            </thead>
                                                                                                                            <tbody>
                                                                                                                                <?php
                                                                                                                                $no = 1;
                                                                                                                                $subtotal = 0;
                                                                                                                                $stotal = 0;
                                                                                                                                $sql1 = mysqli_query($koneksi, "SELECT pd.*, barang.nama, SUM(pd.disc) as tot_disc, pembelian.ppn, pd.jml as jumlah_barang_datang, pembelian.tarif_ppn
                                                                        FROM $tabel2 pd
                                                                        JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                        JOIN pembelian ON pembelian.kd_po = pd.kd_po
                                                                        WHERE pd.no_invoice = '$_GET[id]'
                                                                        GROUP BY pd.kd_po, pd.urut;
                                                                        ");

                                                                                                                                if (!$sql1) {
                                                                                                                                    die("query error" . mysqli_error($koneksi));
                                                                                                                                }


                                                                                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                                                                                    $total_price = $s1['jumlah_barang_datang'] * $s1[$ff4];
                                                                                                                                    $grand_total = $total_price - $s1['tot_disc'];



                                                                                                                                    $nilai_pjk = ($s1['ppn'] == 1) ? $grand_total * $s1['tarif_ppn'] / 100 : 0;
                                                                                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                                                                                    $stotal += $subtotal;
                                                                                                                                ?>
                                                                                                                                    <tr>
                                                                                                                                        <td align="right">
                                                                                                                                            <?php echo $no; ?>
                                                                                                                                            <input type="hidden" name="id[<?php echo $no; ?>]" value="<?php echo $s1[$ff1]; ?>">
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="kd_po[<?php echo $no; ?>]" value="<?php echo $s1[$ff2]; ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="kd_brg[<?php echo $no; ?>]" value="<?php echo $s1[$ff3]; ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="left"><?php echo $s1['nama']; ?></td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="jumlah_datang[<?php echo $no; ?>]" value="<?php echo $s1['jumlah_barang_datang']; ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="jumlah[<?php echo $no; ?>]" value="<?php echo $s1['jml_pcs']; ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="harga[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff4]); ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="diskon[<?php echo $no; ?>]" value="<?php echo number_format($s1['tot_disc']); ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="" value="<?php echo number_format($nilai_pjk); ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <td align="right">
                                                                                                                                            <input type="text" name="subtotal[<?php echo $no; ?>]" value="<?php echo number_format($subtotal); ?>" class="form-control" readonly>
                                                                                                                                        </td>
                                                                                                                                        <!-- <td align="center">
                                                                            <a href="main.php?route=<?php echo $rute_detail; ?>&act=edit-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>&id3=<?php echo $s1[$ff8]; ?>" title="edit">
                                                                                <button class="btn btn-xs btn-primary elevation-1" style="opacity: .7"><i class="fa fa-edit"></i></button>
                                                                            </a>
                                                                            <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus-detail&id=<?php echo $s1[$ff1]; ?>&id2=<?php echo $s1[$ff2]; ?>" title="Hapus Data Ini" onclick="return confirm('Anda yakin akan menghapus data ini?')">
                                                                                <button class="btn btn-xs btn-danger elevation-1" style="opacity: .7"><i class="fa fa-trash"></i></button>
                                                                            </a>
                                                                        </td> -->
                                                                                                                                    </tr>
                                                                                                                                <?php
                                                                                                                                    $no++;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </tbody>
                                                                                                                            <tfoot>
                                                                                                                                <tr style="font-weight:600">
                                                                                                                                    <td colspan="9" align="right">Total</td>
                                                                                                                                    <td id="stotal" align="left"><?php echo number_format($stotal); ?></td>
                                                                                                                                    <td></td>
                                                                                                                                </tr>
                                                                                                                            </tfoot>
                                                                                                                            </table>




                                                                                                                    </div> <!-- row -->

                                                                                                                    <hr>


                                                                                                                    <!-- Submit Button -->
                                                                                                                    <div class="form-group">
                                                                                                                        <!-- <input type="submit" value="Kirim" id="submitButton"> -->
                                                                                                                        <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Bayar</button>
                                                                                                                    </div>
                                                    </form>


                                                    <!-- end tambah keterngan utk Proses .....-->

                                                    <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->



                                                </div>
                                                <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
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
                        </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <script>
                $(document).ready(function() {

                    // Saat jenis transaksi berubah
                    $('#metode_payment').change(function() {
                        var kd_jenis = $(this).val();

                        // Kosongkan dulu pilihan akun
                        $('#akun').empty();
                        $('#akun').append('<option value="">Pilih Akun</option>');

                        if (kd_jenis !== '') {
                            // Panggil AJAX untuk mengambil data akun
                            $.ajax({
                                url: 'route/<?php echo $data ?>/get_akun.php',
                                method: 'POST',
                                data: {
                                    kd_jenis: kd_jenis
                                },
                                dataType: 'json',
                                success: function(response) {
                                    // Tambahkan opsi akun ke dropdown
                                    $.each(response, function(index, akun) {
                                        $('#akun').append('<option value="' + akun.no_account + '">' + akun.no_account + ' - ' + akun.deskripsi + '</option>');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error: ' + error);
                                }
                            });
                        }
                    });
                });
            </script>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Format nilai menjadi Rupiah
                    function formatRupiah(angka) {
                        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }

                    function unformatRupiah(rupiah) {
                        return parseFloat(rupiah.replace(/[^-,\d]/g, '').replace(',', '.')) || 0;
                    }


                    // Set nilai default dengan format Rupiah pada input Total Tagihan dan Sisa Tagihan
                    let subtotalText = document.getElementById('stotal').textContent.trim();
                    let ongkirValue = parseFloat(document.getElementById('ongkir').value) || 0;
                    let subtotalValue = parseFloat(subtotalText.replace(/,/g, '')) || 0;
                    let totalTagihan = subtotalValue + ongkirValue;

                    document.getElementById('ttg').value = formatRupiah(totalTagihan.toFixed(0));

                    function updateSisaTagihan() {
                        var totalTagihan = unformatRupiah(document.getElementById('ttg').value) || 0;
                        var sudahDibayar = unformatRupiah(document.getElementById('sudah_dibayar').value) || 0;
                        var sisaTagihan = totalTagihan - sudahDibayar;

                        // Memastikan sisa tagihan tetap terformat dengan benar, apakah negatif atau positif
                        document.getElementById('sisa_tagihan').value = formatRupiah(sisaTagihan.toFixed(0));

                        // Jika totalTagihan dan sisaTagihan negatif, maka jumlah pembayaran harus negatif
                        if (totalTagihan < 0 && sisaTagihan < 0) {
                            // Memastikan input jumlah pembayaran juga negatif
                            var jumlahPayment = unformatRupiah(document.getElementById('jumlah_payment').value) || 0;
                            if (jumlahPayment > 0) {
                                document.getElementById('jumlah_payment').value = formatRupiah('-' + Math.abs(jumlahPayment).toString());
                            }
                        }
                    }
                    updateSisaTagihan();

                    function checkStatus() {
                        var sisaTagihan = unformatRupiah(document.getElementById('sisa_tagihan').value) || 0;
                        var jumlahPayment = unformatRupiah(document.getElementById('jumlah_payment').value) || 0;

                        // Jika jumlah pembayaran melebihi sisa tagihan positif, tampilkan peringatan
                        if (jumlahPayment > 0 && jumlahPayment > sisaTagihan) {
                            alert('Jumlah pembayaran melebihi sisa tagihan!');
                            document.getElementById('jumlah_payment').value = '';
                            return;
                        }

                        document.getElementById('status_lunas').value = jumlahPayment === sisaTagihan ? 'LUNAS' : 'BELUM LUNAS';
                    }


                    // Event listener untuk format Rupiah pada jumlah_payment
                    // document.getElementById('jumlah_payment').addEventListener('input', function(event) {
                    //     let inputVal = this.value.replace(/[^0-9]/g, '');
                    //     this.value = formatRupiah(inputVal);
                    //     checkStatus();
                    // });
                    document.getElementById('jumlah_payment').addEventListener('input', function() {
                        let inputVal = this.value.replace(/[^0-9-]/g, ''); // Izinkan angka dan simbol minus di awal
                        if (inputVal.startsWith('-')) {
                            inputVal = '-' + inputVal.replace(/-/g, ''); // Hapus semua minus kecuali yang di awal
                        } else {
                            inputVal = inputVal.replace(/-/g, ''); // Hapus minus jika tidak di awal
                        }

                        this.value = formatRupiah(inputVal); // Format input menjadi Rupiah
                        checkStatus();
                    });

                    document.querySelector('form').addEventListener('submit', function(event) {
                        let jumlahPaymentInput = document.getElementById('jumlah_payment');
                        jumlahPaymentInput.value = unformatRupiah(jumlahPaymentInput.value); // Pastikan formatnya bersih sebelum masuk database
                    });
                    $('#retur').on('change', function() {
                        const selected = $(this).val();
                        const selectedText = $(this).find("option:selected").text();
                        document.getElementById('jumlah_payment').value = '';
                        document.getElementById('sisa_tagihan').value = formatRupiah(unformatRupiah(document.getElementById('ttg').value) - unformatRupiah(document.getElementById('sudah_dibayar').value));


                        const sisaTagihan = unformatRupiah(document.getElementById('sisa_tagihan').value) || 0;
                        const newharga = sisaTagihan - selected;
                        if (selected > 0 && selected > sisaTagihan) {
                            alert('Nota retur pembelian melebihi sisa tagihan!');
                            $(this).val($(this).find('option:first').val());
                            return;
                        } else {
                            document.getElementById('sisa_tagihan').value = formatRupiah(newharga);
                            document.getElementById('nama_nota_retur').value = selectedText;
                        }
                    });
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