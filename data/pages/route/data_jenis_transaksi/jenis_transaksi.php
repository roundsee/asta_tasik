<?php

$judulform = 'Jenis Transaksi';
$data = 'data_jenis_transaksi';
$aksi = 'aksi_jenis_transaksi';
$rute = 'jenis_transaksi';

$tabel = 'jenis_transaksi';
$f1 = 'kd_jenis';
$f2 = 'nama';
$f3 = 'photo';
$f4 = 'keterangan';

$j1 = 'Kode Aplikasi';
$j2 = 'Metode Pembayaran';
$j3 = 'Photo';
$j4 = 'Keterangan';

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
            <div class="content-wrapper" style="background-color: ghostwhite;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
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
                                                    <?php if ($login_hash != 15): ?>
                                                        <button class="btn btn-primary btn-sm elevation-2 " style="opacity: .7;" onclick="window.location='route/<?php echo $data; ?>/autocomplete.php'"><i class="fa fa-plus" ;></i> Tambah</button>
                                                    <?php endif; ?>
                                                    <div style="margin:10px"></div>


                                                    <!-- <button class="btn btn-primary btn-sm" onclick="window.location='main.php?route=<?php echo $rute; ?>&act=tambah'"><i class="fa fa-plus"></i> Tambah Data</button> -->

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead style="background-color:  lightgray;" class="elevation-2">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th><?php echo $j1; ?></th>
                                                                <th><?php echo $j2; ?></th>
                                                                <!-- <th style="text-align:center;"><?php echo $j3; ?></th> -->
                                                                <th><?php echo $j4; ?></th>
                                                                <?php if ($login_hash != 15): ?>
                                                                    <th width="60px">Aksi</th>
                                                                <?php endif; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                            // $sql1=mysqli_query($koneksi,"SELECT * from $tabel  order by $f1 desc");

                                                            $query = "SELECT * from jenis_transaksi  order by $f1 asc";

                                                            $sql1 = mysqli_query($koneksi, $query);
                                                            $no = 1;

                                                            while ($s1 = mysqli_fetch_array($sql1)) {

                                                                if ($s1[$f3] == "") {
                                                                    $datagambar = "images.jpeg";
                                                                } else {
                                                                    $datagambar = $s1[$f3];
                                                                }

                                                            ?>
                                                                <tr align="left">
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><?php echo $s1[$f1]; ?></td>
                                                                    <td><?php echo $s1[$f2]; ?></td>
                                                                    <!-- <td style="text-align: center;"><img src="../../images/jenis_transaksi/<?php echo $datagambar; ?>" class="brand-image elevation-3" style="opacity: 1;width: 60px;"></td> -->
                                                                    <td><?php echo $s1[$f4]; ?></td>
                                                                    <?php if ($login_hash != 15): ?>
                                                                        <td>
                                                                            <div style="margin: 10px"></div>
                                                                            <a href="main.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $s1[$f1]; ?>" title="Edit"> <button class="btn btn-primary btn-sm elevation-2" style="opacity: .7;width:80px"><i class="fa fa-edit"></i> Edit</button></a>
                                                                            <br />

                                                                            <a href="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=hapus&id=<?php echo $s1[$f1]; ?>" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                                                                                <button class="btn btn-danger btn-sm elevation-2" disabled style="opacity: .7;width:80px"><i class="fa fa-trash"></i> Hapus</button></a>
                                                                        </td>
                                                                    <?php endif; ?>
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
            <style>
                .file {
                    visibility: hidden;
                    position: absolute;
                }
            </style>
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
        <?php
            break;

            //Form Edit area
        case "edit":
            $edit = mysqli_query($koneksi, "SELECT * from $tabel where $f1='$_GET[id]'");
            $e = mysqli_fetch_array($edit);

            if ($e['keterangan'] == "BANK") {
                $dataf4 = "BANK";
            } else {
                $dataf4 = "TRANSFER";
            }

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
                                                <!-- <form method="POST" action="route/data_alat_bayar/proses_edit.php?id=<?php echo $e['kd_alat']; ?>" enctype="multipart/form-data" > -->

                                                <form method="POST" action="route/<?php echo $data; ?>/<?php echo $aksi; ?>.php?route=<?php echo $rute; ?>&act=edit&id=<?php echo $e['kd_jenis']; ?>" enctype="multipart/form-data">

                                                    <section class="base">

                                                        <!-- menampung nilai id produk yang akan di edit -->
                                                        <!-- <input name="<?php echo $f1; ?>" value="<?php echo $e[$f1]; ?>"  hidden /> -->
                                                        <div class="form-group">
                                                            <label><?php echo $j1; ?></label>
                                                            <input type="text" name="<?php echo $f1; ?>" class="form-control" value="<?php echo $e[$f1]; ?>" readonly />
                                                        </div>

                                                        <div class="form-group">
                                                            <label><?php echo $j2; ?></label>
                                                            <input type="text" name="<?php echo $f2; ?>" class="form-control" value="<?php echo $e[$f2]; ?>" autofocus="" require />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea name="pilihan" class="form-control" style="width:200px; height: 80px;"><?php echo $e['keterangan']; ?></textarea>
                                                        </div>


                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary elevation-2" style="opacity: .7">Simpan Perubahan</button>
                                                        </div>


                                                        <!-- <div class="form-group">
                                                                <label><?php echo $j5; ?></label>
                                                                <select name="<?php echo $f5; ?>" class="form-control" style="width:200px;height: 40px;">
                                                                <option value="<?php echo $e[$f5]; ?>"><?php echo $e[$f5] . ' ' . $s1['nama']; ?></option>
                                                                <?php

                                                                $produk = mysqli_query($koneksi, "SELECT * from $tabel2 order by $ff1 asc");
                                                                while ($pro = mysqli_fetch_array($produk)) {
                                                                    echo "<option value='$pro[$ff1]'>$pro[$ff1] - $pro[nama]</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            </div> -->

                                                        <!-- <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div id="msg"></div>
                                                                    <input type="file" name="photo" class="file">
                                                                    <div class="input-group my-3">
                                                                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                                                        <div class="input-group-append">
                                                                            <button type="button" id="pilih_gambar" class="browse btn btn-dark elevation-2">Pilih Gambar</button>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if ($e['photo'] == "") {
                                                                        $datagambar = "images.jpeg";
                                                                    } else {
                                                                        $datagambar = $e['photo'];
                                                                    } ?>

                                                                    <img src="../../images/<?php echo $rute; ?>/<?php echo $datagambar; ?>" id="preview" class="img-thumbnail elevation-3" style="width: 120px;float: left;margin-bottom: 5px;">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <hr />

                                                    </section>
                                                </form>

                                                <a href="main.php?route=<?php echo $rute; ?>&act&ide=<?php echo $_SESSION['employee_number']; ?>&asal=<?php echo $rute; ?>"><button class="btn btn-primary btn-sm elevation-1" style="opacity: .7">Back</button></a>
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