<?php


$judulform = "Purchase Return";

$data = 'data_pembelian_retur';
$rute = 'pembelian_retur';
$aksi = 'aksi_pembelian_retur';

$rute_detail = 'beli_detail';

$tabel = 'pembelian_retur';

// Field untuk tabel pembelian
$f1 = 'id_transaksi';       // $j1 = 'id_transaksi'
$f2 = 'tgl';               // $j2 = 'tgl'
$f3 = 'no_bukti';          // $j3 = 'no_bukti'
$f4 = 'vendor';            // $j4 = 'vendor'
$f5 = 'kode_barang';       // $j5 = 'kode_barang'
$f6 = 'nama_barang';       // $j6 = 'nama_barang'
$f7 = 'satuan';            // $j7 = 'satuan'
$f8 = 'akun_persediaan';   // $j8 = 'akun_persediaan'
$f9 = 'jumlah';            // $j9 = 'jumlah'
$f10 = 'harga';            // $j10 = 'harga'
$f11 = 'sub_total';        // $j11 = 'sub_total'
$f12 = 'ppn';              // $j12 = 'ppn'
$f13 = 'akun_ppn';         // $j13 = 'akun_ppn'
$f14 = 'total';            // $j14 = 'total'
$f15 = 'metode_pembayaran'; // $j15 = 'metode_pembayaran'
$f16 = 'akun';             // $j16 = 'akun'

// Judul untuk form
$j1 = 'id_transaksi';
$j2 = 'tgl';
$j3 = 'no_bukti';
$j4 = 'vendor';
$j5 = 'kode_barang';
$j6 = 'nama_barang';
$j7 = 'satuan';
$j8 = 'akun_persediaan';
$j9 = 'jumlah';
$j10 = 'harga';
$j11 = 'sub_total';
$j12 = 'ppn';
$j13 = 'akun_ppn';
$j14 = 'total';
$j15 = 'metode_pembayaran';
$j16 = 'akun';

$data2 = 'import_barang';

//session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    switch ($_GET['act']) {
            //Tampil Data 
        default:
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;"></small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
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
                            <div class="card-body">
                                <!-- Main row -->
                                <div class="row">
                                    <!-- Left col -->
                                    <section class="col-lg-12 connectedSortable">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="box">
                                            <div class="box-body">
                                                <div class="table-responsive">

                                                    <button class="btn btn-primary btn-sm elevation-2 mb-3" style="opacity: .7;" onclick="window.location='main.php?route=pembelian_retur_tambah'">
                                                        <i class="fa fa-plus"></i> Tambah
                                                    </button>

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color: lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <th><?php echo $j3; ?></th>
                                                                <th><?php echo $j4; ?></th>
                                                                <th><?php echo $j5; ?></th>
                                                                <th><?php echo $j6; ?></th>
                                                                <th><?php echo $j7; ?></th>
                                                                <th><?php echo $j8; ?></th>
                                                                <th><?php echo $j9; ?></th>
                                                                <th><?php echo $j10; ?></th>
                                                                <th><?php echo $j11; ?></th>
                                                                <th><?php echo $j12; ?></th>
                                                                <th><?php echo $j13; ?></th>
                                                                <th><?php echo $j14; ?></th>
                                                                <th><?php echo $j15; ?></th>
                                                                <th width="140px">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql1 = mysqli_query($koneksi, "SELECT * from $tabel");
                                                            $no = 1;

                                                            if (!$sql1) {
                                                                die("error: " . mysqli_error($koneksi));
                                                            }

                                                            while ($s1 = mysqli_fetch_array($sql1)) {
                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><?php echo $s1[$f1]; ?></td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <td><?php echo $s1[$f3]; ?></td>
                                                                    <td><?php echo $s1[$f4]; ?></td>
                                                                    <td><?php echo $s1[$f5]; ?></td>
                                                                    <td><?php echo $s1[$f6]; ?></td>
                                                                    <td><?php echo $s1[$f7]; ?></td>
                                                                    <td><?php echo $s1[$f8]; ?></td>
                                                                    <td><?php echo $s1[$f9]; ?></td>
                                                                    <td><?php echo $s1[$f10]; ?></td>
                                                                    <td><?php echo $s1[$f11]; ?></td>
                                                                    <td><?php echo $s1[$f12]; ?></td>
                                                                    <td><?php echo $s1[$f13]; ?></td>
                                                                    <td><?php echo $s1[$f14]; ?></td>
                                                                    <td><?php echo $s1[$f15]; ?></td>
                                                                    <td>
                                                                        <!-- <a href="main.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit"><button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a> -->

                                                                        <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus&id=<?php echo $s1[$f1]; ?>" title="Hapus" type="button" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                                                                            <button class="btn btn-danger btn-sm elevation-2" type="button" style="opacity: .7;width:80px">
                                                                                <i class="fa fa-trash"></i> Hapus
                                                                            </button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $no++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </section><!-- /.Left col -->
                                </div><!-- /.row (main row) -->
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

        <?php
            break;

            //Form Tambah area
        case "tambah":

        ?>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds wow slideInUp" data-wow-duration=".5s" data-wow-delay="1.1s">
                                    <b><?php echo $judulform; ?> <small style="font-weight: 100;">tambah</small></b>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                    <li class="breadcrumb-item active">tambah</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">
                                                <form method="POST" action="route/data_alat_bayar/aksi_alat_bayar.php?route=alat_bayar&act=input" enctype="multipart/form-data">

                                                    <!-- <form method="post" enctype="multipart/form-data" action="<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=input"> -->

                                                    <div class="form-group">
                                                        <label><?php echo $j1; ?></label>
                                                        <input type="text" onkeyup="isi_otomatis()" name="<?php echo $f1; ?>" id="<?php echo $f1; ?>" required="required" class="form-control" style="width: 100px;" />
                                                        <input type="text" id="<?php echo $f2; ?>" class="form-control" style="width: 300px;" disabled />
                                                        <input type="text" id="nama" class="form-control" style="width: 300px;" />

                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j2; ?></label>
                                                        <input type="text" name="<?php echo $f2; ?>" class="form-control" placeholder="Masukan <?php echo $j2; ?> ..." required="required" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j4; ?></label>
                                                        <select name="<?php echo $f4; ?>" class="form-control" style="width:200px;height: 40px;">
                                                            <option value="Non Tunai">Non Tunai</option>
                                                            <option value="Tunai">Tunaii</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo $j5; ?></label>
                                                        <select name="<?php echo $f5; ?>" class="form-control" style="width:200px;height: 40px;">
                                                            <option></option>
                                                            <?php

                                                            $produk = mysqli_query($koneksi, "SELECT * from jenis_transaksi order by kd_jenis asc");
                                                            while ($pro = mysqli_fetch_array($produk)) {
                                                                echo "<option value='$pro[kd_jenis]'>$pro[kd_jenis] - $pro[nama]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div id="msg"></div>
                                                                <input type="file" name="photo" class="file">
                                                                <div class="input-group my-3">
                                                                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                                                    <div class="input-group-append">
                                                                        <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                                                    </div>
                                                                </div>

                                                                <img src="route/data_alat_bayar/gambar/images.jpeg" id="preview" class="img-thumbnail">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <hr />
                                                        <input type="submit" class="btn btn-primary" value="Simpan" />
                                                    </div>

                                                </form>
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
                // Fungsi untuk mereset form saat halaman di-refresh
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('searchForm').reset();
                });

                // Fungsi untuk menangani pengiriman form dan menampilkan hasil pencarian
                document.getElementById('searchForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah pengiriman formulir secara default

                    var formData = new FormData(this);

                    fetch('route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=search', {
                            method: 'GET',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('searchResultsBody').innerHTML = data;
                            var myModal = new bootstrap.Modal(document.getElementById('searchResultsModal'));
                            myModal.show();
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>


            <script>
                function isi_otomatis() {
                    var <?php echo $f1; ?> = $("#<?php echo $f1; ?>").val();
                    $.ajax({
                        url: 'route/data_alat_bayar/ajax.php',
                        data: "<?php echo $f1; ?>=" + <?php echo $f1; ?>,
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $('#<?php echo $f2; ?>').val(obj.<?php echo $f2; ?>);

                    });
                }
            </script>

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

            //Form Edit
        case "edit":
            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            // $sql=mysqli_query($koneksi,"SELECT * from $tabel2 where $ff1='$e[$f5]'");
            // $s1=mysqli_fetch_array($sql);

        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header  wow fadeInDown" data-wow-duration=".3s" data-wow-delay=".3s">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="list-gds">
                                    <b><?php echo $judulform; ?></b> <small style="font-weight: 100;">edit</small>
                                </h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="main.php?route=home">Beranda</a></li>
                                    <li class="breadcrumb-item active">Data</li>
                                    <li class="breadcrumb-item active"><?php echo $judulform; ?></li>
                                    <li class="breadcrumb-item active">edit</li>
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
                            <div class="card-body">
                                <div class="row">
                                    <!-- right column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-body">


                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['id_transaksi']; ?>" enctype="multipart/form-data">
                                                    <section>
                                                        <div class="box">
                                                            <div class="box-body">
                                                                <div class="wrapper">
                                                                    <div class="row">
                                                                        <!-- Kolom Pertama -->
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j1; ?></label>
                                                                                <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j2; ?></label>
                                                                                <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <!-- <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j4; ?></label>
                                                                                <input type="text" name="<?php echo $f4; ?>" class="form-control" value="<?php echo $e[$f4]; ?>" required="required" />
                                                                            </div>
                                                                        </div> -->

                                                                        <div class="col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j4; ?></label>
                                                                                <select name="<?php echo $f4; ?>" class="form-control select2" required="required">
                                                                                    <?php
                                                                                    // Query untuk mengambil data supplier dari tabel supplier
                                                                                    $query = mysqli_query($koneksi, "SELECT kd_supp, nama FROM supplier");
                                                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                                                        // Cek jika nilai dari $e[$f4] cocok dengan opsi dari query
                                                                                        $selected = ($row['kd_supp'] == $e[$f4]) ? 'selected' : '';
                                                                                        echo "<option value='" . $row['kd_supp'] . "' " . $selected . ">" . $row['nama'] . "</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j5; ?></label>
                                                                                <select id="kode_barang" name="<?php echo $f5; ?>" class="form-control select2" required="required">
                                                                                    <option value="">Pilih Kode Barang</option>
                                                                                    <?php
                                                                                    // Query untuk mengambil data barang dari tabel barang
                                                                                    $query = mysqli_query($koneksi, "SELECT kd_brg, nama FROM barang");
                                                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                                                        // Cek jika nilai dari $e[$f5] cocok dengan opsi dari query
                                                                                        $selected = ($row['kd_brg'] == $e[$f5]) ? 'selected' : '';
                                                                                        echo "<option value='" . $row['kd_brg'] . "' data-nama='" . $row['nama'] . "' " . $selected . ">" . $row['kd_brg'] . "</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j6; ?></label>
                                                                                <input type="text" name="<?php echo $f6; ?>" id="nama_barang" class="form-control" value="<?php echo $e[$f6]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j7; ?></label>
                                                                                <input type="text" name="<?php echo $f7; ?>" class="form-control" value="<?php echo $e[$f7]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j8; ?></label>
                                                                                <select name="<?php echo $f8; ?>" class="form-control select2" required="required">
                                                                                    <option value="">Pilih Akun Persediaan</option>
                                                                                    <?php
                                                                                    // Query untuk mengambil data akun dari tabel akun
                                                                                    $query = mysqli_query($koneksi, "SELECT no_account, deskripsi FROM account");
                                                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                                                        // Cek jika nilai dari $e[$f8] cocok dengan opsi dari query
                                                                                        $selected = ($row['no_account'] == $e[$f8]) ? 'selected' : '';
                                                                                        echo "<option value='" . $row['no_account'] . "' " . $selected . ">" . $row['deskripsi'] . "</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j9; ?></label>
                                                                                <input type="number" name="<?php echo $f9; ?>" id="jumlah" class="form-control" value="<?php echo $e[$f9]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j10; ?></label>
                                                                                <input type="number" name="<?php echo $f10; ?>" id="harga" class="form-control" value="<?php echo $e[$f10]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j11; ?></label>
                                                                                <input type="number" name="<?php echo $f11; ?>" id="sub_total" readonly class="form-control" value="<?php echo $e[$f11]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j12; ?></label>
                                                                                <input type="number" name="<?php echo $f12; ?>" id="ppn" class="form-control" value="<?php echo $e[$f12]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j13; ?></label>
                                                                                <select name="<?php echo $f13; ?>" class="form-control select2" required="required">
                                                                                    <option value="">Pilih Akun PPN</option>
                                                                                    <?php
                                                                                    // Query untuk mengambil data akun dari tabel akun
                                                                                    $query = mysqli_query($koneksi, "SELECT no_account, deskripsi FROM account");
                                                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                                                        // Cek jika nilai dari $e[$f13] cocok dengan opsi dari query
                                                                                        $selected = ($row['no_account'] == $e[$f13]) ? 'selected' : '';
                                                                                        echo "<option value='" . $row['no_account'] . "' " . $selected . ">" . $row['deskripsi'] . "</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j14; ?></label>
                                                                                <input type="number" name="<?php echo $f14; ?>" id="total" readonly class="form-control" value="<?php echo $e[$f14]; ?>" required="required" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j15; ?></label>
                                                                                <select name="<?php echo $f15; ?>" class="form-control select2" required="required">
                                                                                    <option value="">Pilih Metode Pembayaran</option>
                                                                                    <option value="Tunai" <?php echo ($e[$f15] == 'Tunai') ? 'selected' : ''; ?>>Tunai</option>
                                                                                    <option value="Kredit" <?php echo ($e[$f15] == 'Kredit') ? 'selected' : ''; ?>>Kredit</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label><?php echo $j16; ?></label>
                                                                                <select name="<?php echo $f16; ?>" class="form-control select2" required="required">
                                                                                    <option value="">Pilih Akun Pembayaran</option>
                                                                                    <?php
                                                                                    // Query untuk mengambil data akun dari tabel akun
                                                                                    $query = mysqli_query($koneksi, "SELECT no_account, deskripsi FROM account");
                                                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                                                        // Menentukan apakah opsi ini dipilih
                                                                                        $selected = ($e[$f16] == $row['no_account']) ? 'selected' : '';
                                                                                        echo "<option value='" . $row['no_account'] . "' $selected>" . $row['deskripsi'] . "</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                    <input type="submit" class="btn btn-primary btn-sm elevation-2" style="opacity: .7" value="Simpan" />
                                                                    <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>">
                                                                        <button type="button" class="btn btn-primary btn-sm elevation-2" style="opacity: .7">Back</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </form>
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
                $(document).ready(function() {
                    $('.select2').select2();

                    $('#kode_barang').change(function() {
                        var selectedOption = $(this).find('option:selected');
                        var namaBarang = selectedOption.data('nama');
                        $('#nama_barang').val(namaBarang);
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Ambil elemen input
                    var jumlahInput = document.getElementById('jumlah');
                    var hargaInput = document.getElementById('harga');
                    var subTotalInput = document.getElementById('sub_total');
                    var ppnInput = document.getElementById('ppn');
                    var totalInput = document.getElementById('total');

                    // Fungsi untuk menghitung subtotal
                    function calculateSubtotal() {
                        var jumlah = parseFloat(jumlahInput.value) || 0;
                        var harga = parseFloat(hargaInput.value) || 0;
                        var subtotal = jumlah * harga;
                        subTotalInput.value = subtotal.toFixed(2); // Dua tempat desimal
                        calculateTotal(); // Hitung total setiap kali subtotal dihitung
                    }

                    // Fungsi untuk menghitung total
                    function calculateTotal() {
                        var subtotal = parseFloat(subTotalInput.value) || 0;
                        var ppn = parseFloat(ppnInput.value) || 0;
                        // var total = subtotal + (subtotal * (ppn / 100));
                        var total = subtotal + ppn;
                        totalInput.value = total.toFixed(2); // Dua tempat desimal
                    }

                    // Tambahkan event listener untuk perubahan pada jumlah, harga, dan PPN
                    jumlahInput.addEventListener('input', calculateSubtotal);
                    hargaInput.addEventListener('input', calculateSubtotal);
                    ppnInput.addEventListener('input', calculateTotal);
                });
            </script>

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