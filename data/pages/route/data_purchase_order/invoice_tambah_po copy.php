<?php

$judulform = 'Invoice Tambah ';

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

$tabel2 = 'pembelian_detail';
$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
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

            $query2 = mysqli_query($koneksi, "SELECT * from $tabel2 where $ff1='$_GET[id]' ");
            $q2 = mysqli_fetch_array($query2);

            if ($q1['ppn'] == 1) {
                $ppn = 'PPN';
            } else {
                $ppn = 'Non PPN';
            }
            $input_oleh = $q1['user_input'];
            $sql3 = "SELECT name_e FROM employee WHERE employee_number = '$input_oleh' ";
            $result3 = mysqli_query($koneksi, $sql3);

            if ($s3 = mysqli_fetch_array($result3)) {
                $nama_karyawan = $s3['name_e'];
            } else {
                $nama_karyawan = '-';
            }



            $dir = '../../';
?>

<style>
    *{
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
                                                            <!-- kiri -->
                                                            <div class="col-lg-7">
                                                                <div class="row">
                                                                    <!-- ID -->
                                                                    <!-- <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j1; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                        </div>
                                                                    </div> -->
                                                                    <!-- ID -->
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j9; ?></label>
                                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $kd_po; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Kode Supplier -->
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j3; ?></label>
                                                                            <input type="text" name="<?php echo $f3; ?>" class="form-control" value="<?php echo $kdSupp; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Nama Supplier -->
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Nama Supplier</label>
                                                                            <input type="text" name="nama_supplier" class="form-control" value="<?php echo $namaSupp; ?>" readonly />
                                                                        </div>
                                                                    </div>

                                                                    <!-- Tanggal -->
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label><?php echo $j2; ?></label>
                                                                            <input type="date" class="form-control" name="<?php echo $f2; ?>" onclick="displayHasil(this.value)" placeholder="Masukan <?php echo $j2; ?> (Wajib)" value="<?php echo date('Y-m-d') ?>" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Diinput Oleh -->
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label>Diinput Oleh</label>
                                                                            <input type="text" name="<?php echo $f14; ?>" class="form-control" value="<?php echo $nama_karyawan; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label>PPN</label>
                                                                            <!-- Input untuk menampilkan PPN atau Non PPN -->
                                                                            <input type="text" class="form-control" value="<?php echo ($q1['ppn'] == 1) ? 'PPN' : 'Non PPN'; ?>" readonly />

                                                                            <!-- Input hidden untuk mengirimkan nilai 0 atau 1 saat form disubmit -->
                                                                            <input type="hidden" name="ppn" value="<?php echo $q1['ppn']; ?>" />
                                                                        </div>
                                                                    </div>




                                                                    <!-- <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label>PPN</label>
                                                                            <input type="text" name="<?php echo $ppn; ?>"class="form-control" value="<?php echo $ppn; ?>" readonly />
                                                                        </div>
                                                                    </div> -->

                                                                    <!-- Tujuan Kirim -->
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group">
                                                                            <label>Tujuan Kirim</label>
                                                                            <input type="text" name="<?php echo $f15; ?>" class="form-control" value="<?php echo $q1['tujuan_kirim']; ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- row -->
                                                            </div> <!-- col-lg-7 -->

                                                            <!-- kanan -->
                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label><?php echo $j13; ?></label>
                                                                    <input type="number" name="<?php echo $f13; ?>" class="form-control" value="<?php echo $q1[$f13]; ?>" readonly>
                                                                </div>
                                                            </div> <!-- col-lg-5 -->
                                                        </div> <!-- row -->

                                                        <hr>

                                                        <!-- Table for item details -->
                                                        <table id="example1" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
                                                            <thead style="background-color: #ddd;">
                                                                <tr style="font-weight:600">
                                                                    <td align="center" width="40px">No</td>
                                                                    <td align="left" width="120px"><?php echo $jj2; ?></td>
                                                                    <td>Nama Barang</td>
                                                                    <td align="left">Jumlah Barang datang</td>
                                                                    <td align="left" width="240px"><?php echo $jj3; ?> Berdasarkan PO</td>
                                                                    <td align="left" width="240px"><?php echo $jj4; ?></td>
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
                                                                $sql1 = mysqli_query($koneksi, "SELECT pd.*, pembelian.ppn, barang.nama, 
                                                                pb.jumlah_datang as jumlah_barang_datang
                                                                FROM $tabel2 pd
                                                                JOIN barang ON barang.kd_brg = pd.kd_brg
                                                                JOIN pembelian ON pembelian.kd_beli = pd.kd_beli
                                                                LEFT JOIN penerimaan_barang pb ON pb.kd_po = pd.kd_po AND pb.kd_brg = pd.kd_brg
                                                                WHERE pd.kd_beli = '$_GET[id]'");



                                                                while ($s1 = mysqli_fetch_array($sql1)) {
                                                                    $total_price = $s1['jumlah_barang_datang'] * $s1[$ff4];
                                                                    $grand_total = $total_price - $s1[$ff7];

                                                                    $nilai_pjk = ($s1[$f7] == 1) ? $grand_total * 11 / 100 : 0;
                                                                    $subtotal = $grand_total + $nilai_pjk;
                                                                    $stotal += $subtotal;
                                                                ?>
                                                                    <tr>
                                                                        <td align="right">
                                                                            <?php echo $no; ?>
                                                                            <input type="hidden" name="id[<?php echo $no; ?>]" value="<?php echo $s1[$ff1]; ?>">
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="kd_brg[<?php echo $no; ?>]" value="<?php echo $s1[$ff2]; ?>" class="form-control" readonly>
                                                                        </td>
                                                                        <td align="left"><?php echo $s1['nama']; ?></td>
                                                                        <td align="right    "><?php echo $s1['jumlah_barang_datang']; ?></td>
                                                                        <td align="right">
                                                                            <input type="text" name="jumlah[<?php echo $no; ?>]" value="<?php echo $s1[$ff3]; ?>" class="form-control" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="harga[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff4]); ?>" class="form-control" readonly>
                                                                        </td>
                                                                        <td align="right">
                                                                            <input type="text" name="diskon[<?php echo $no; ?>]" value="<?php echo number_format($s1[$ff7]); ?>" class="form-control" readonly>
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
                                                                    <td colspan="8" align="right">Total</td>
                                                                    <td align="left"><?php echo number_format($stotal); ?></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                        <!-- Submit Button -->
                                                        <div class="form-group">
                                                        <input type="submit" value="Kirim" id="submitButton">
                                                            <!-- <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Generate Invoice</button> -->
                                                        </div>
                                                    </form>


                                                    <!-- end tambah keterngan utk Proses .....-->

                                                    <!-- <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a> -->

                                                    <a onclick="history.go(-1)"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>


                                                </div>
                                                <hr>
                                                <script>
                                                    // Mengecek jika ada status   <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Hapus status setelah halaman dimuat
                                                        localStorage.removeItem('invoiceReady');

                                                        // Simulasikan tombol submit saat halaman dimuat
                                                        document.getElementById('submitButton').click();
                                                    });
                                                </script>


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